<?php
include '../Customer/condb.php';
session_start();

$knowledgeid = $_REQUEST['knowledgeid'];
$sql = "SELECT * FROM knowledge where knowledgeid='".$knowledgeid."'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Knowledge Base</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <style>
        .top{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }
        .rad{
            min-height: 98vh;
            position: relative;
            max-width: 750px;
            width: 100%;
            background-color: #f5f5f5;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.6);
            margin: 10px 20px;
        }
        .title {
            height: 145px;
            display: flex;
            color: white;
            justify-content: center;
            text-align: center;
            align-items: center;
            background-color: darkblue;
        }
        .title h1{
            font-size: 40px;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .content {
            padding: 20px;
            font-size: 22px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: calc(98vh - 145px - 25px - 20px - 40px);
            overflow-y: auto;
        }

        .left-bottom-button {
            display: flex;
            justify-content: flex-end;
        }

        .left-bottom-button button {
            height: 55px;
            width: 100px;
            color: white;
            background-color:#1E90FF ;
            font-size: 18px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.9);
            margin: 10px;
        }

        .left-bottom-button button:hover {
            background-color: #20B2AA;
            transform: scaleX(1.01);
            transition: all 0.3s ease;
        }
    </style>
    <script>
        function goBack() {
            window.location.href = "knowledgebase.php";
        }
    </script>
</head>
<body>
    <?php 
    if(isset($_SESSION['noic'])){
        include 'homenav.php';
    }else{
        include 'guest_nav.php';
    }
    ?>
    <section class="top">
        <div class="rad">
            <div class="title">
                <h1><?php echo $row['title']; ?></h1>
            </div>
            <div class="content">
                <h5><?php echo $row['content']; ?></h5>
            </div>

            <div class="btn">
                <div class="left-bottom-button" style="float:left;">
                    <button id="back-btn" name="back-btn" onclick="goBack()">Back</button>
                </div>
            </div>
        </div>
    </section>
</body>
</html>