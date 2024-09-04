<?php
session_start();

if (!isset($_SESSION['noic'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

include 'condb.php';

if(isset($_POST['cancel'])){
    header("Location: Schedule.php");
    exit();
}

if(isset($_POST['add_event'])){
    add_event();
}

function add_event(){
    global $con, $title, $datetime, $petid;

    $title = $_POST['title'];
    $datetime = $_POST['datetime'];
    $petid = $_POST['petid'];

    if(!empty($title) && !empty($datetime) && !empty($petid)){
        $currentDateTime = date('Y-m-d H:i:s');

        if ($datetime >= $currentDateTime) {
            $sql = "INSERT into event(title, datetime, petid) value (?, ?, ?)";
            $statement = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($statement, 'sss', $title, $datetime, $petid);
            $result = mysqli_stmt_execute($statement);
            if ($result){
                echo '<script>alert("Event uploaded!");</script>';
                echo '<script>window.location.href = "Schedule.php";</script>';
            }else{
                echo '<script>alert("Event failed to upload");</script>';
                echo '<script>window.location.href = "addevent.php";</script>';
            }
        }else{
            echo '<script>alert("Please select a datetime after the current date!");</script>';
        }
    }else{
        echo '<script>alert("Please insert all the event details!");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add event</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <style>
    .form-container{
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-wrapper{
        position: relative;
        max-width: 750px;
        width: 100%;
        background-color: #f5f5f5;
        padding: 25px;
        border-radius: 20px;
        box-shadow: 0 0 15px rgba(0,0,0,0.6);
        margin: 10px 20px;
    }
    .form-wrapper header{
        font-size: 2.5rem;
        color: #333;
        font-weight: 700;
        margin-left: 20px;
        font-family: "Open Sans", sans-serif;
        margin-bottom: 40px;
    }
    .form-wrapper .form{
        margin-top: 10px;
    }
    .form .form-input-details{
        width: 100%;
        margin-top: 20px;
    }
    .form-input-details label{
        color: #333;
        font-size: 16px;
        font-weight: 600;
    }
    .form-input-details input{
        position: relative;
        height: 50px;
        width: 100%;
        font-size: 1rem;
        outline: none;
        margin-top: 8px;
        border: 1px solid #b3d7ff;
        border-radius: 6px;
        padding: 0 15px;
        color: black;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.604);

    }
    .form-input-details input:hover{
        transform: scale(1.01);
        transition: all 0.5s ease;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
        padding: 0 20px;

    }

    .form :where(.form-input-details input, .select-box){
        position: relative;
        height: 50px;
        width: 100%;
        font-size: 1rem;
        outline: none;
        margin-top: 8px;
        border: 1px solid #b3d7ff;
        border-radius: 6px;
        padding: 0 15px;
        color: black;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.604);
    }

    .form-input-details input:focus {
        box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
        border-color: #007bff;
        outline: none;
    }
    .form-btn-details button{
        height: 55px;
        width: 100%;
        color: white;
        background-color:#1E90FF ;
        font-size: 18px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        margin-top: 30px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.9);
    }

    .form-btn-details button:hover {
        background-color: #20B2AA;
        transform: scaleX(1.01);
        transition: all 0.3s ease;
    }
    .top-right-button {
        position: absolute;
        top: 28px;
        right: 40px;
        width: 150px;
        height: 40px;
        background:  #1c8dd8;
        color: white;
        font-size: 18px;
        text-align: center;
        box-shadow: 1px 1px 10px #0345be;
    }
    
    .top-right-button option{
        background-color: #1c8dd8;
        text-align: center;
    }
    .top-right-button select:hover option{
        background: #00c6ff;
    }
    @media (max-width: 584px){
        .top-right-button{
            position: absolute;
            font-size: 15px;
            width: 100px;
            top: 20px;
        }
        .form-wrapper header{
        font-size: 1.8rem;
        color: #333;
        font-weight: 700;
        margin-left: 20px;
        font-family: "Open Sans", sans-serif;
        margin-bottom: 40px;
        }
    }
    </style>
</head>
<body>
    <?php include 'homenav.php'; ?>

    <section class="form-container">
        <div class="form-wrapper">
            <header>Add Your Event</header>
            <select class="top-right-button" id="myDropdown" required onchange="selectPet(); if (this.value === 'addpet') window.location.href = 'pet_register.php';">
                <?php 
                    $sql = "SELECT * from pet where noic = '".$_SESSION['noic']."'";
                    $result = mysqli_query($con, $sql);
                    $num = mysqli_num_rows($result);
                    if($num == 0){
                        echo '<option value="">Click Here</option>';
                        echo ' <option value="addpet">+ Add Pet +</option>';
                    }else{
                        echo '<option selected disabled >Click Here</option>';
                            while($row = mysqli_fetch_assoc($result)){
                            $petname = $row['petname'];
                            $petid = $row['petid'];
                            echo '<option value="'.$petid.'">'.$petname.'</option>';
                        }
                    }
                    
                ?>
                <script>
                    function selectPet(){
                        var petSelect = document.getElementById("myDropdown");
                        var petId =petSelect.value;
                        var petName = petSelect.options[petSelect.selectedIndex].text;
                        document.getElementById("petId").value = petId;
                        document.getElementById("petName").value = petName;
                    }

                    function validateForm() {
                        var title = document.getElementsByName("title")[0].value;  
                        
                        if(title.length > 30){
                            alert("Number of words in the title cannot exceed 30 characters!");
                            return false;
                        }
                    }
                </script>
            </select>
            <form action="addevent.php" method="post" onsubmit="return validateForm()">
                <div class="form-input-details">
                    <label for="">Event title</label>
                    <input type="text" name="title" placeholder="Title of your event">
                </div><br>
                <div class="form-input-details">
                    <label for="">Pet name</label>
                    <input type="hidden" name="petid" id="petId">
                    <input type="text" name="petname" id="petName" placeholder="Select your pet by clicking top-right button" readonly>
                </div><br>
                <div class="form-input-details">
                    <label for="">Date & Time</label>
                    <input type="datetime-local" style="font-family: sans-serif;" name="datetime">
                </div>
                <div class="form-btn-details">
                    <button style="float:left;width:45%;" name="cancel">Cancel</button>
                    <button type="submit" name="add_event" style="float:right;width:45%;">Submit</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>