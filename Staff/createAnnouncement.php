<?php
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_staff'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>
    
    <?php 
        if(isset($_POST['create'])){
            $Title = $_POST['Title'];
            $Description = $_POST['Description'];
            $date = date('Y-m-d H:i');

            $sql = "INSERT INTO `announcement` (`title`, `description`,`date`) VALUES (?, ?, ?)";
            $prepare = mysqli_prepare($con,$sql);
            mysqli_stmt_bind_param($prepare,"sss",$Title,$Description,$date);
            $result = mysqli_stmt_execute($prepare);
            if($result){
                echo '<section><div class="success">
                <strong>Create Successfull!</strong>
            </div></section>';
            }
        }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
    <style>
        .form-input-details textarea{
            position: relative;
            height: 200px;
            width: 100%;
            font-size: 1rem;
            outline: none;
            margin-top: 8px;
            border: 1px solid #b3d7ff;
            border-radius: 6px;
            padding: 0 15px;
            color: black;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.604);
            font-family: "Open Sans", sans-serif;
        }
        .form-input-details textarea:hover{
            transform: scale(1.01);
            transition: all 0.5s ease;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
            padding: 0 20px;
        }
        .form :where(.form-input-details textarea, .select-box){
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

        .form-input-details textarea:focus {
            box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
            border-color: #007bff;
            outline: none;
        }
    </style>
</head>
<body>
    <?php 
        include 'sidebar.php';
    ?>
      <script>
        function validateForm() {
            var Title = document.form.Title.value;  
            var Description = document.form.Description.value;  
           
            
            if(Title.length < 10){
                alert("Title is too short!");
                return false;
            }else if(Title.length > 100){ 
                alert("Title is too long!"); 
                return false;
            }else if(Description.length < 10){  
                window.alert("Description is too short!"); 
                return false;  
            }
        };
        function goBack() {
            window.location.href = "Announcement.php";
        };
    </script>  
    <section class="form-container">
        <div class="form-wrapper">
            <header>Create Announcement Details</header>
            <form action="createAnnouncement.php" name="form" class="form" method="post" onsubmit="return validateForm()">
                <div class="form-input-details">
                    <label for="">Title</label>
                    <input type="text" name="Title" placeholder="Title" required>
                </div>
                <div class="form-input-details">
                    <label for="">Description</label>
                    <!-- <input type="text" name="Description" placeholder="Description" required> -->
                    <textarea name="Description" placeholder="Description"></textarea>
                </div>
                    <div class="form-btn-details">
                        <button style="float:left; width:45%" onclick="goBack()">Back</button>
                        
                        <button type="submit" style="float:right;width:45%" name="create">Create</button>
                    </div>
            </form>
        </div>
    </section>
</body>
</html>