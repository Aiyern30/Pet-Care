<?php
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_staff'])){
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
    <title>View Knowledge Base</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <style>
        body{
            padding-left: 80px;
        }
        .section{
            margin: 10px;
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
        <div class="home-title">
            <h1>View Knowledge Base</h1>
        </div>

        <?php
        include 'sidebar.php';

        $sql = "SELECT * from knowledge order by knowledgeid asc";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="article-container">
            <div class="title"><?php echo $row['title']; ?></div>
            <button><?php echo $row['type']; ?></button>
            <a href="view_knowledgebase.php?knowledgeid=<?php echo $row['knowledgeid']; ?>" class="view-btn">View</a>
        </div>
    <?php } ?>
</body>
</html>