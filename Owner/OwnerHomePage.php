<?php
include '../Customer/condb.php';
session_start();

if (!isset($_SESSION['noic_owner'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='../Staff/login.php';</script>";
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
        <h1>Home Page</h1>
    </div>
        <div class="home-container">
            <div class="home-row">
                <a href="StaffRegistration.php">
                    <div class="card card1">
                    <i class="fa-solid fa-registered"></i>
                        <h4>Staff Registration</h4>
                    </div>
                </a>
                <a href="Account.php">
                    <div class="card card2">
                    <i class="fa light fa-receipt"></i>
                        <h4>View Account</h4>
                    </div>
                </a>
                <a href="Finance.php">
                    <div class="card card3">
                    <i class="fa light fa-coins"></i>
                        <h4>Finance Report</h4>
                    </div>
                </a>
                <a href="Progression.php">
                    <div class="card card4">
                    <i class="fa fa-chart-line"></i>
                        <h4>Progression Report</h4>
                    </div>
                </a>
                <a href="Feedback.php">
                    <div class="card card5">
                    <i class="fa-solid fa-comment"></i>
                        <h4>Feedback Management</h4>
                    </div>
                </a>
                <a href="Schedule.php">
                    <div class="card card6">
                    <i class="fa-solid fa-calendar-days"></i>
                        <h4>Schedule Management</h4>
                    </div>
                </a>
                <a href="OwnerProfile.php">
                    <div class="card card7">
                    <i class="fa-solid fa-user"></i>
                        <h4>My Profile</h4>
                    </div>
                </a>
            </div>
        </div>
        
</section>


 

</body>
</html>