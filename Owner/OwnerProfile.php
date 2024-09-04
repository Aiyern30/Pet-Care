<?php
include '../Customer/condb.php';
session_start();

if (!isset($_SESSION['noic_owner'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='../Staff/login.php';</script>";
    exit();
}
?>

    <?php 

        $sql = "SELECT * FROM employee where noic = '".$_SESSION['noic_owner']."';";
        $display = mysqli_query($con,$sql);
        $num=mysqli_num_rows($display);
        if ($num>0){
            $row = mysqli_fetch_assoc($display);

        $Fullname = $row['fullname'];
        $NoIC = $row['noic'];
        $NoPH = $row['noph'];
        $Email = $row['email'];
        $Password = $row['password'];
        if(isset($_POST['Update'])){
            $NoPH = $_POST['NoPH'];
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];

            $sql = "UPDATE employee SET fullname = '$Fullname', noph = '$NoPH', email = '$Email', password = '$Password' where noic = '".$_SESSION['noic_owner']."';";
            $result = mysqli_query($con, $sql);
            if($result){
                echo '<section><div class="success">
                    <strong>Successfully Update!!</strong>
                    </div></section>';
            }else{
                echo '<section><div class="alert">
                    <strong>Alert!</strong> Something error!
                    </div></section>';
            }
        
        }
    }
?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="../assets/css/owner/form.css">
    <link rel="stylesheet" href="../assets/css/owner/style.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
</head>
<body>
    <?php 
        include 'Sidebar.php';
    ?>
        <script>
            function ProfileValidate(){
                var NoIC = document.Profile["NoIC"].value;
                var NoPH = document.Profile["NoPH"].value;
                var Email = document.Profile["Email"].value;
                var Password = document.Profile["Password"].value;
                var icFormat = /^[0-9]{12}$/; 
                var phoneFormat = /^01\d{8,9}$/; 

                var emailFormat = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

                if (Password.length > 15) {
                    alert("Password should not be longer than 15 characters!");
                    return false;
                } else if (!emailFormat.test(Email)) {
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
            <header>My Profile</header>
            <form action="OwnerProfile.php" class="form" method="post" name="Profile" onsubmit="return ProfileValidate();">
                <div class="form-split">
                    <div class="form-input-details">
                        <label for="">Full name</label>
                        <input name="Fullname" type="text"  placeholder="Your Fullname" value="<?php echo $Fullname;?>" required readonly>
                    </div>
                </div>
                <div class="form-split">
                    <div class="form-input-details">
                        <label for="">IC Number</label>
                        <input name="NoIC" type="text" placeholder="Your IC Number"value="<?php echo $NoIC;?>"  required readonly>
                    </div>
                    <div class="form-input-details">
                        <label for="">Phone Number</label>
                        <input type="text" name="NoPH" placeholder="Your Phone Number 01xxxxxxxx."value="<?php echo $NoPH;?>"  required>
                    </div>
                </div>
                    <div class="form-input-details">
                        <label for="">Email</label>
                        <input type="email" name="Email" placeholder="Your Email"value="<?php echo $Email;?>"  required>
                    </div>
                    <div class="form-input-details">
                        <label for="">Password</label>
                        <input type="password" name="Password" placeholder="Your Password" value="<?php echo $Password;?>" required>
                    </div>
                    <div class="form-btn-details">
                        <button style="float:left; width:45%" type="button" onclick="window.location.href='OwnerHomePage.php';">Back</button>
                        <button type="submit" style="float:right;width:45%" name="Update">Submit</button>
                    </div>