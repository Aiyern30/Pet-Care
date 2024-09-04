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
    <title>Staff Registration</title>
    <link rel="stylesheet" href="../assets/css/customer/form.css">
</head>
<style>
    section{
        padding-left: 80px;
    }
</style>
<body>
    <?php 
        include 'Sidebar.php';
    ?>
    <?php 
    if(isset($_POST['Register'])){
        $noic = $_POST['NoIC'];
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $noph = $_POST['NoPH'];
        $password = $_POST['Password'];
        $UserType = "staff";

        $sql = "SELECT * FROM employee";
        $check = mysqli_query($con,$sql);
        $isDuplicate = false;

        while($row = mysqli_fetch_assoc($check)) {
            $NoIC = $row['noic'];
            $NoPH = $row['noph'];
            $Email = $row['email'];
            
            if ($NoIC == $noic){
                echo '<script>window.alert("IC Number has been registed!");</script>';
                $isDuplicate = true;
                break;
            }elseif($NoPH == $noph){
                echo '<script>window.alert("This Phone Number has been used!");</script>';
                $isDuplicate = true;
                break;
            }elseif($Email == $email){
                echo '<script>window.alert("This Email has been used!");</script>';
                $isDuplicate = true;
                break;
            }
        }

        if(!$isDuplicate){
            $Register = "INSERT INTO employee (`noic`, `fullname`, `noph`, `email`, `password`, `status`, `usertype`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $statement = mysqli_prepare($con,$Register);
            $status = true;
            mysqli_stmt_bind_param($statement,"sssssss",$noic,$name,$noph, $email, $password, $status, $UserType);
            $result = mysqli_stmt_execute($statement);

            if($result){
                echo '<script>alert("Successfully registered");</script>';
                echo '<script>window.location.href = "StaffRegistration.php";</script>';
            }
            else{
                echo '<script>alert("Something Error");</script>';
                echo '<script>window.location.href = "StaffRegistration.php";</script>';
            }
        }
    }
    ?>
        <script>
            function StaffRegistration(){
                var Name = document.Staff_Form["Name"].value;
                var NoIC = document.Staff_Form["NoIC"].value;
                var NoPH = document.Staff_Form["NoPH"].value;
                var Email = document.Staff_Form["Email"].value;
                var Password = document.Staff_Form["Password"].value;
                var phoneFormat = /^01\d{8,9}$/; 

                var emailFormat = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

                var icRegex = /^[0-9]{12}$/;

                if (Name.length > 50) {
                    alert("Staff Name should not be longer than 50 characters!");
                    return false;
                }else if(NoIC.match(icRegex) == null) { 
                    alert("Invalid NoIC format! Please enter a 12-digit number.");
                    return false;
                }else if (Password.length > 15) {
                    alert("Password should not be longer than 15 characters!");
                    return false;
                } else if (!emailFormat.test(Email)) {
                    alert("Invalid email format! Must be a Gmail email address.");
                    return false;
                } else if (!phoneFormat.test(NoPH)) {
                    alert("Invalid phone number format! Please enter a valid Malaysian phone number in the format of 01xxxxxxxx.");
                    return false;
                }
                return true;
            }
        </script>
    <section>
        <div class="container">
            <div class="title">Staff Registration</div>
            
                <form action="StaffRegistration.php" method="POST" name="Staff_Form" onsubmit="return StaffRegistration();">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Staff Name</span>
                            <input type="text" name="Name" placeholder="Staff Name" required >
                        </div>
                        <div class="input-box">
                            <span class="details">IC Number</span>
                            <input type="text" name="NoIC" placeholder="Staff IC Number" required >
                        </div>
                        
                        <div class="input-box">
                            <span class="details">Phone Number</span>
                            <input type="text" name="NoPH" placeholder="Phone Number" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" name="Email" placeholder="Email" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" name="Password" placeholder="Staff Password" required>
                        </div>
                    </div>
                        
                        <div class="button">
                            <input style="width: 100%;" type="submit" name="Register" value="Register">
                            <div style="text-align:center"><br>
                                <a href="OwnerHomePage.php"><input style="width: 100px; height:45px" type="button" value="Back"></a>
                            </div>
                        </div>
                    
                </form>
        </div>
    </section>
    
</body>
</html>