<?php
include "condb.php";
session_start();
if (!isset($_SESSION['noic'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>
<?php 
if(isset($_POST['submit'])){
    $fullname = $_POST['Fullname'];
    $email = $_POST['Email'];
    $noph = $_POST['NoPH'];
    $enquiry = $_POST['Enquiry'];

    $query = "INSERT INTO `enquiry`(`fullname`, `email`, `noph`, `enquiry`) VALUES ('$fullname','$email','$noph','$enquiry')";
    $run = mysqli_query($con,$query);
    if($run){
        echo '<section><div class="success">
                            <strong> Thanks for submitting the enquiry!</strong>
                        </div></section>';
    }else{
        echo '<section><div class="alert">
                            <strong> There is some error!</strong>
                        </div></section>';
    }
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry</title>
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/customer/popup.css">
</head>
<style>
    .success{
        margin-top: 80px;
    }
    .alert{
        margin-top: 80px;
    }
</style>
<body>
    <?php
        include 'homenav.php';
    ?>
<script>
    function Validation() {
                var Fullname = document.form.Fullname.value;
                var Email = document.form.Email.value;
                var NoPH = document.form.NoPH.value;
                var Enquiry = document.form.Enquiry.value;

                var emailFormat = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
                var phoneFormat = /^01\d{8,9}$/; 



                if (Fullname.length > 50) {
                    alert("Full name should not be longer than 50 characters!");
                    return false;
                } else if (!emailFormat.test(Email)) {
                    alert("Invalid email format! Must be a Gmail email address.");
                    return false;
                } else if (!phoneFormat.test(NoPH)) {
                    alert("Invalid phone number format! Please enter a valid Malaysian phone number in the format of 01xxxxxxxx.");
                    return false;
                } else if (Enquiry.length > 100) {
                    alert("Feedback should not be longer than 100 characters!");
                    return false;
                }
                return true;
            }
    </script>
    <section class="form-container">
        <div class="form-wrapper">
            <header>Contact Us</header>
            <form  action="ContactUs.php" class="form" method="post" name="form" onsubmit="return Validation();">
                <div class="form-input-details">
                    <label for="">Full Name</label>
                    <input type="text" name="Fullname" placeholder="Full Name" required>
                </div>
                <div class="form-input-details">
                    <label for="">Email</label>
                    <input type="email" name="Email" placeholder="Email Address" required>
                </div>
                <div class="form-input-details">
                    <label for="">Phone Number</label>
                    <input type="tel" name="NoPH"  placeholder="Phone Number" required>
                </div>
                <div class="form-input-details">
                    <label for="">Your enquiry</label>
                    <input type="text" name="Enquiry"  placeholder="Your enquiry" required>

                </div>

                    <div class="form-btn-details">
                        <button style="float:left; width:45%" type="button" onclick="window.location.href='homepage.php';">Back</button>
                        <button type="submit" style="float:right;width:45%" name="submit">Submit</button>
                    </div>
            </form>
        </div>
    </section>
</body>
</html>