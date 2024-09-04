<?php
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
<link rel="stylesheet" href="../assets/css/staff/staffstyle.css">

    <title>Home Page</title>
</head>
<body>
    <?php 
    include 'sidebar.php';
    ?>

<section>
    <div class="home-title">
        <h1>Knowledge Base</h1>
    </div>
        <div class="home-container">
            <div class="home-row">
                <a href="add_knowledgebase.php">
                    <div class="card card1">
                        <i class="fas fa-plus"></i>
                        <h4>Create Knowledge Base</h4>
                    </div>
                </a>
                <a href="knowledgebase.php">
                    <div class="card card2">
                        <i class="fas fa-search"></i>
                        <h4>View Knowledge Base</h4>
                    </div>
                </a>
            </div>
        </div>
        
</section>


 

</body>
</html>