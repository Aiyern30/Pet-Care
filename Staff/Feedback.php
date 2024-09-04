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
        if(isset($_POST['Submit'])){
            $Fullname = $_POST['Fullname'];
            $Email = $_POST['Email'];
            $NoPH = $_POST['NoPH'];
            $Feedback = $_POST['Feedback'];

            $sql = "INSERT INTO `feedback` (`fullname`,`email`,`noph`,`feedback`) VALUES (?, ?, ?, ?)";
            $prepare = mysqli_prepare($con,$sql);
            mysqli_stmt_bind_param($prepare,"ssss",$Fullname,$Email,$NoPH, $Feedback);
            $result = mysqli_stmt_execute($prepare);
            if($result){
                echo '<section><div class="success">
                <strong>Thanks for sunmitting the feedback!</strong>
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
    <title>Give Your Feedback</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
</head>

<body>
    <?php 
        include 'sidebar.php';
    ?>
        <script>
            function Validation() {
                var Fullname = document.form.Fullname.value;
                var Email = document.form.Email.value;
                var NoPH = document.form.NoPH.value;
                var Feedback = document.form.Feedback.value;

                var emailFormat = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
                var phoneFormat = /^01\d{8,9}$/; 



                if (Fullname.length > 50) {
                    alert("Full name should not be longer than 50 characters!");
                    return false;
                } else if (!emailFormat.test(Email)) {
                    alert("Invalid email format! Must be a Gmail email address.");
                    return false;
                } else if (!phoneFormat.test(NoPH)) {
                    alert("Invalid phone number format! Please enter a valid Malaysian phone number in the format of 01x-xxxxxxx.");
                    return false;
                } else if (Feedback.length > 100) {
                    alert("Feedback should not be longer than 100 characters!");
                    return false;
                }
                return true;
            }

        </script>
    <section class="form-container">
        <div class="form-wrapper">
            <header>Give Your Feedback</header>
            <form action="Feedback.php" name="form" class="form" method="post" onsubmit="return Validation()">
                <div class="form-input-details">
                    <label for="">Fullname</label>
                    <input type="text" name="Fullname" placeholder="Your Name" required>
                </div>
                <div class="form-input-details">
                    <label for="">Email</label>
                    <input type="text" name="Email" placeholder="Your Email" required>
                </div>
                <div class="form-input-details">
                    <label for="">Phone Number</label>
                    <input type="text" name="NoPH" placeholder="Your Phone Number" required>
                </div>
                <div class="form-input-details">
                    <label for="">Feedback</label>
                    <input type="text" name="Feedback" placeholder="Your Feedback" required>
                </div>
            
                <div class="form-btn-details">
                    <button style="float:left; width:45%" type="button" onclick="window.location.href='Staffhomepage.php';">Back</button>
                    <button type="submit" style="float:right;width:45%" name="Submit">Submit</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>