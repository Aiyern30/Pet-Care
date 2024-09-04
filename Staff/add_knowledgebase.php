<?php
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_staff'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$type = "";
$title = "";
$content = "";

if (isset($_POST['create'])){
    create();
}

function create(){
    global $con, $title, $type, $content;

    $title = $_POST['Title'];
    $type = $_POST['pet_type'];
    $content = $_POST['Content'];

    $sql = "INSERT into knowledge (title, type, content) values (?, ?, ?)";
    $statement = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($statement, "sss", $title, $type, $content);
    $result = mysqli_stmt_execute($statement);
    if($result){
        echo '<script>alert("Insert successfully");</script>';
        echo '<script>window.location.href="knowledgebase.php";</script>';
    }else{
        echo '<script>alert("Insert unsuccessfully");</script>';
        echo '<script>window.location.href="add_knowledgebase.php";</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Knowledge Base</title>
    <link rel="stylesheet" href="staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <style>
        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-group label {
            display: inline-block;
            padding: 0.5em 1em;
            margin: 0.5em;
            border: 1px solid #ccc;
            background-color: #fff;
            cursor: pointer;
        }

        .radio-group input[type="radio"]:checked + label {
            background-color: #00bcd4;
            color: #fff;
        }
        textarea {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
            font-size: 1rem;
            margin-bottom: 20px;
            font-family: "Open Sans", sans-serif;
            color: black;
            height: auto;
            min-height: 100px;
        }
        textarea:hover{
            transform: scale(1.01);
            transition: all 0.5s ease;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
            padding: 0 20px;
        }
        .form-input-details label[type='browse']{
            background-color: #1E90FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            padding: 8px 20px;
            border: 2px solid black;
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
           
            
            if(Title.length < 5){
                alert("Title is too short!");
                return false;
            }else if(Title.length > 50){ 
                alert("Title is too long!"); 
                return false;
            }
        };

        var loadFile = function(event) {
                var image = document.getElementById('output');
                image.src = URL.createObjectURL(event.target.files[0]);
                document.getElementById("browse").style.display = "none";
                document.getElementById("file").style.display = "none";
        };

        function goBack() {
            window.location.href = "knowledgebase.php";
        };
    </script>  
    <section class="form-container">
        <div class="form-wrapper">
            <header>Create Knowledge Base</header>
            <form action="add_knowledgebase.php" name="form" class="form" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                <div class="form-input-details">
                    <label for="">Title</label>
                    <input type="text" name="Title" placeholder="Please enter title of the article">
                </div>
                <div class="form-input-details">
                    <label for="">Pet Type</label>
                    <div class="radio-group">
                        <input type="radio" id="cat" name="pet_type" value="cat" required>
                        <label for="cat">Cat</label>&nbsp;&nbsp;
                        <input type="radio" id="dog" name="pet_type" value="dog" required>
                        <label for="dog">Dog</label>
                    </div>
                </div>
                <div class="form-input-details">
                    <label for="">Content</label>
                    <textarea type="text" name="Content" rows="10" placeholder="Please enter content of the article" onkeydown="if(event.keyCode==9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'   '+v.substring(e);this.selectionStart=this.selectionEnd=s+3;return false;}"></textarea>
                </div>
                    <div class="form-btn-details">
                        <button style="float:left; width:45%" onclick="goBack()">Cancel</button>
                        <button type="submit" style="float:right;width:45%" name="create">Create</button>
                    </div>
            </form>
        </div>
    </section>
</body>
</html>