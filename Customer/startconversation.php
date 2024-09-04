<?php
session_start();
include 'condb.php';

if (!isset($_SESSION['noic'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

date_default_timezone_set('Asia/Kuala_Lumpur');

if(isset($_POST['back'])){
    echo '<script>window.location.href="forum.php"</script>';
    exit();
}

$content = "";

if (isset($_POST['create'])){
    create();
}

function create(){
    global $con, $content;

    $content = $_POST['content'];

    if (!empty($content)){
        $customerid = $_SESSION['customerid'];
        $current_datetime =  date('Y-m-d H:i:s');
        $sql = "INSERT into post(content, customerid, datetime) value (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $content, $customerid, $current_datetime);
        $result = mysqli_stmt_execute($stmt);
        if($result){
            echo '<script>alert("Question uploaded!");</script>';
            echo '<script>window.location.href = "forum.php";</script>';
        }else{
            echo '<script>alert("Question failed to upload!");</script>';
            header("Refresh: 0");
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);
    } else {
        echo '<script>alert("Please insert your question!")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask a question</title>
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
        text-align: center;
        font-family: "Open Sans", sans-serif;

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
    </style>
</head>
<body>
    <?php include 'homenav.php'; ?>

    <section class="form-container">
        <div class="form-wrapper">
        <header>Ask a question</header>
            <form action="startconversation.php" method="post">
                <div class="form-input-details">
                    <label for="">Question: </label>
                    <textarea name="content" id="" cols="30" rows="10" placeholder="Please enter your question"></textarea>
                </div>
                <div class="form-btn-details">
                    <button style="float:left; width:45%" name="back">Back</button>
                    <button type="submit" style="float:right;width:45%" name="create">Create</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>