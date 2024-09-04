<?php
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_staff'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if (isset($_REQUEST['knowledgeid'])) {
    $knowledgeid = $_REQUEST['knowledgeid'];
    $sql = "SELECT * FROM knowledge WHERE knowledgeid='$knowledgeid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['edit'])){
    edit();
}

function edit(){
    global $con, $knowledgeid;

    $id = $_POST['id'];
    $title = $_POST['title'];
    $type = $_POST['pet_type'];
    $content = $_POST['content'];
    
    $sql = "UPDATE knowledge SET title=?, type=?, content=? WHERE knowledgeid=?";
    $statement = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($statement, "sssi", $title, $type, $content, $id);
    $result = mysqli_stmt_execute($statement);
    if($result){
        echo '<script>alert("Update successfully");</script>';
        echo "<script>window.location.href='knowledgebase.php';</script>";
    }else{
        echo '<script>alert("Update unsuccessfully");</script>';
        echo "<script>window.location.href='view_knowledgebase.php?knowledgeid=$knowledgeid';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Knowledge Base</title>
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
            var Title = document.form.title.value;  
           
            if(Title.length < 5){
                alert("Title is too short!");
                return false;
            }else if(Title.length > 50){ 
                alert("Title is too long!"); 
                return false;
            }
        }

        function goBack() {
            window.location.href='knowledgebase.php';
        }
    </script>  
    <section class="form-container">
        <div class="form-wrapper">
            <header>Update Knowledge Base</header>
            <form action="edit_knowledgebase.php" id="" name="form" class="form" method="post" onsubmit="return validateForm()">
                <div class="form-input-details">
                    <label for="">Title</label>
                    <input type="hidden" name="id" value="<?php echo $knowledgeid; ?>">
                    <input type="text" name="title" placeholder="Please enter title of the article" required value="<?php echo $row['title'] ?>">
                </div>
                <div class="form-input-details">
                    <label for="">Pet Type</label>
                    <div class="radio-group">
                        <input type="radio" id="cat" name="pet_type" value="cat"<?php if($row['type'] == 'cat') echo 'checked'?>>
                        <label for="cat">Cat</label>&nbsp;&nbsp;
                        <input type="radio" id="dog" name="pet_type" value="dog"<?php if($row['type'] == 'dog') echo 'checked'?>>
                        <label for="dog">Dog</label>
                    </div>
                </div>
                <div class="form-input-details">
                    <label for="">Content</label>
                    <textarea name="content" id="content" cols="30" rows="10"><?php echo $row['content']; ?></textarea>
                </div>
                    <div class="form-btn-details">
                        <button style="float:left; width:45%;" type="button" onclick="goBack()">Cancel</button>
                        <button type="submit" style="float:right;width:45%;" name="edit">Update</button>
                    </div>
            </form>
        </div>
    </section>
</body>
</html>