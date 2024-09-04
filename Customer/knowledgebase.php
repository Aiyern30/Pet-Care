<?php
include 'condb.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Base</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <style>
        .knowledgebase-title {
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            padding: 20px;
            margin-bottom: 20px;
        }
        .knowledgebase-title h1 {
            color: #333;
            font-size: 30px;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
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
            margin-top: 40px;
        }
        .view-btn {
            position: absolute; 
            right: 0;
            width: 100px;
            height: 50px;
            margin-right: 10px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            border: 1.7px solid black;
            text-align: center;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1e90ff;
        }
        .view-btn:hover {
            background-color: #009879;
        }
        .title {
            font-size: 1.2em;
            font-weight: bold;
        }
        button {
            position: absolute; 
            right: 0;
            width: 80px;
            height: 50px;
            margin-right: 10px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            border: 1.7px solid black;
            text-align: center;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e6a510;
            margin-right: 200px;
            position: relative; 
        }
        button::after {
            content: "";
            display: block;
            position: absolute;
            left: 130px; 
            top: 50%;
            transform: translateY(-50%);
            width: 2px;
            height: 130px;
            background-color: black;
        }
        @media screen and (max-width: 768px) {
            .article-container {
                flex-wrap: wrap;
                height: auto;
                margin-left: 20px;
                margin-right: 20px;
                justify-content: space-between;
            }
            .view-btn {
                position: static;
                margin-top: 10px;
            }
            button{
                position: static;
                margin-top: 10px;
                margin-right: 10px;
            }
            button::after{
                display: none;
            }
        }
    </style>
</head>
<body>
        <div class="knowledgebase-title">
            <h1>View Knowledge Base</h1>
        </div>

        <?php
        if(isset($_SESSION['noic'])){
            include 'homenav.php';
        }else{
            include 'guest_nav.php';
        }

        $sql = "SELECT * from knowledge order by knowledgeid asc";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="article-container">
            <div class="title"><?php echo $row['title']; ?></div>
            <button><?php echo $row['type']; ?></button>
            <a href="viewknowledgebase.php?knowledgeid=<?php echo $row['knowledgeid']; ?>" class="view-btn">View</a>
        </div>
    <?php } ?>
</body>
</html>