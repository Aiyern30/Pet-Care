<?php
include 'condb.php';
session_start();
if (!isset($_SESSION['noic'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>

<?php 
    if(isset($_POST['Reset'])){
        $noic = $_POST['noic'];
        $email = $_POST['email'];
        $noph=$_POST['noph'];
        $Password = $_POST['password'];
        $sql = "SELECT * FROM customer WHERE noic = '$noic' AND email = '$email' AND noph = '$noph'";
        $display = mysqli_query($con,$sql);

        if($num=mysqli_num_rows($display)>0){
        $sql = "UPDATE customer SET password = '$Password' where noic = '$noic';";
        $result = mysqli_query($con, $sql);
            if($result){
                echo'<script>alert("Successfully Resetd!");</script>';
            }else{
                echo'<script>alert("Something Error!");</script>';
            }
        }
        else{
            echo'<script>alert("No this account!");</script>';    
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
</head>
<body>
    <?php 
        include 'lsnav.php';
    ?>
    <script>
        function Validate(){
            var NoIC = document.Reset.noic.value;
            var NoPH = document.Reset.noph.value;
            var Email = document.Reset.email.value;
            var Password = document.Reset.password.value;
            var ConfirmPassword = document.Reset.confirmpassword.value;
            
                var icFormat = /^[0-9]{12}$/; 
                var phoneFormat = /^01\d{8,9}$/; 

                var emailFormat = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

            if (Password.length > 15) {
                alert("Password should not be longer than 15 characters!");
                return false;
            }
            else if(Password != ConfirmPassword){
                alert("Password must same as confirm password!");
                return false;
            }
            else if (!emailFormat.test(Email)) {
                alert("Invalid email format! Must be a Gmail email address.");
                return false;
            } else if (!phoneFormat.test(NoPH)) {
                alert("Invalid phone number format! Please enter a valid Malaysian phone number in the format of 01xxxxxxxx.");
                return false;
            } else if(!icFormat.test(NoIC)) {
                alert("Invalid IC number format! Please enter a valid Malaysian IC number in the format of xxxxxxxxxxxx.");
                return false;
            }
            return true;
        }
    </script>

    <section class="form-container">
        <div class="form-wrapper">
            <header>Reset Password</header>
            <form action="ResetPassword.php" class="form" method="post" name="Reset" onsubmit="return Validate();">
                <div class="form-split">
                    <div class="form-input-details">
                        <label for="">IC Number</label>
                        <input name="noic" type="text" placeholder="Your IC Number"  required>
                    </div>
                    <div class="form-input-details">
                        <label for="">Phone Number</label>
                        <input type="text" name="noph" placeholder="Your Phone Number 01xxxxxxxx."  required>
                    </div>
                </div>
                    <div class="form-input-details">
                        <label for="">Email</label>
                        <input type="email" name="email" placeholder="Your Email"  required>
                    </div>
                    <div class="form-input-details">
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="Your Password"  required>
                    </div>
                    <div class="form-input-details">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-btn-details">
                        <button style="float:left; width:45%" ><a href="login.php" style = "text-decoration:none; color:white">Back</a></button>
                        <button type="submit" style="float:right;width:45%" name="Reset">Reset</button>
                    </div>
            </form>
        </div>
    </section>
</body>
</html>