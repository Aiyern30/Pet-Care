<?php
include 'condb.php';
session_start();
if (!isset($_SESSION['noic'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <title>Community</title>
    <style>
        .article-container {
            display: flex;
            position: relative;
            justify-content: space-between;
            align-items: center;
            margin: 0 auto 10px auto;
            padding: 10px;
            border: 1.7px solid black;
            border-radius: 10px;
            background-color: #f7f7f7;
            max-width: 1300px;
            height: 130px;
        }
        .view-btn {
            position: absolute; /* set the position of the button as absolute */
            right: 0;
            width: 100px;
            height: 50px;
            margin-right: 10px;
            background-color: #1E90FF;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            border: 1.7px solid black;
            text-align: center;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .view-btn:hover {
            background-color: #009879;
        }
        .title {
            font-size: 1.3em;
            font-weight: bold;
        }
        .type {
            font-size: 0.9em;
            color: #666;
        }
        .forum-title {
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            padding: 20px;
            margin-bottom: 20px;
        }
        .forum-title h1 {
            color: #333;
            font-size: 30px;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-container{
            height: 100px;
            width: 100%;
        }
        .right-top-button{
            float: right;
            margin: 10px 10px 0px 0px;
        }
        .right-top-button button{
            width: 200px;
            height: 55px;
            background-color: aquamarine;
            font-size: 20px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .right-top-button button:hover{
            background-color: antiquewhite;
        }    
        @media only screen and (max-width: 800px) {
            
            
            .right-top-button button{
                
                width: 150px;
                height: 45px;
                font-size: 16px;
            }
        }
        @media only screen and (max-width: 600px) {
            .btn-container{
                height: 150px;
                width: 100%;
            }
            .right-top-button button{
                width: 100px;
                height: 45px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <?php include 'homenav.php'; ?>
    <div class="forum-title">
        <h1>Community</h1>
    </div>

    <div class="btn-container">
        <div class="right-top-button">
            <a href="startconversation.php"><button>Ask a question</button></a>
        </div>
    </div>

    <?php 
    $sql = "SELECT post.*, customer.fullname from post join customer on customer.customerid = post.customerid order by datetime desc";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)){
    ?>
    <div class="article-container">
        <div>
            <div class="title"><?php echo $row['content']; ?></div>
            <div class="type"><p>Posted by <strong><?php echo $row['fullname']; ?></strong></p></div>
            <div class="type"><p>Create on <strong><?php echo $row['datetime']; ?></strong></p></div>
        </div>
        <a href="viewconversation.php?postid=<?php echo $row['postid']; ?>" class="view-btn">View</a>
    </div>
    <?php 
    } 
    ?>
</body>
</html>
