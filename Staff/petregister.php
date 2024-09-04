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
       
       if(isset($_POST['Register'])){
            $Petname = $_POST['Petname'];
            $Type = $_POST['Type'];
            $Gender = $_POST['Gender'];
            $DOB = $_POST['DOB'];
            $Description = $_POST['Description'];
            $NoIC = $_POST['NoIC'];
       
               $sql = "INSERT INTO `pet` (`petname`, `dob`, `description` , `type` , `gender`,`noic`) VALUES (?, ?, ?, ?, ?, ?)";
               $prepare = mysqli_prepare($con, $sql);
               if ($prepare) {
                   mysqli_stmt_bind_param($prepare, "ssssss", $Petname, $DOB, $Description, $Type, $Gender, $NoIC);
                   $result = mysqli_stmt_execute($prepare);
       
                   if ($result) {
                    echo '<div class="success">
                    <strong>Alert!</strong> Register  Successfull!
                </div>';                   
            } else {
                       echo "Error: " . mysqli_error($con);
                   }
               } else {
                    echo '<div class="alert">
                    <strong>Alert!</strong> Something erro!!
                </div>';              
             }
            }
       
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Register</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
</head>
<body>
    <?php 
        include 'sidebar.php';
    ?>
        <script>
    function validateForm() {
        var Petname = document.PetRegisterForm.Title.value;  
        var NoIC = document.PetRegisterForm.NoIC.value; 
        var Fullname = document.PetRegisterForm.Fullname.value;  
        var Description = document.PetRegisterForm.Description.value;  
        var icRegex = /^[0-9]{12}$/;

        if(Petname.length > 50){
            alert("Petname is too long!");
            return false;
        }else if(NoIC.match(icRegex) == null) { 
            alert("Invalid NoIC format! Please enter a 12-digit number.");
            return false;
        }else if(Description.length > 50){  
            alert("Description is too long!"); 
            return false;  
        }else if(Fullname.length > 50){  
            alert("Fullname is too long!"); 
            return false;  
        }
    }
</script>

    <section class="form-container">
        <div class="form-wrapper">
            <header>Create Pet Details</header>
            <form action="petregister.php" class="form" method="post" enctype="multipart/form-data" name="PetRegisterForm" onsubmit="return ValidateForm();">
                <div class="form-input-details">
                    <label for="">Pet Name</label>
                    <input type="text" name="Petname" placeholder="Pet Name" autocomplete="off" required >
                </div>

                <div class="form-split">
                    <div class="form-input-details">
                        <label for="">Date of birth</label>
                        <input type="date" name="DOB" placeholder="DOB" required >
                    </div>
                    <div class="form-input-details">
                        <label for="">Description</label>
                        <input type="text" name="Description" placeholder="Description" autocomplete="off">
                    </div>
                </div>

                
                <div class="form-split">
                    <div class="gender-box">
                        <h3>Type</h3>
                        <div class="gender-option">
                            <div class="gender">
                                <input type="radio" id="Dog"  name="Type" value="Dog" checked>
                                <label for="Dog">Dog</label>
                            </div>
                            <div class="gender">
                                <input type="radio" id="Cat" name="Type" value="Cat" checked>
                                <label for="Cat">Cat</label>
                            </div>
                            
                        </div>
                    </div>
                
                    <div class="gender-box">
                        <h3>Gender</h3>
                            <div class="gender-option">
                                <div class="gender">
                                    <input type="radio" id="Male" name="Gender" value="Male" checked>
                                    <label for="Male">Male</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="Female" name="Gender" value="Female" checked>
                                    <label for="Female">Female</label>
                                </div>
                                
                            </div>
                    </div>
                </div>
                <div class="form-split">
                    <div class="form-input-details">
                        <label for="">Owner's IC Number</label>
                        <input type="text" name="NoIC" placeholder="IC Number" autocomplete="off" required >
                    </div>
                </div>
                
                    <div class="form-btn-details">
                        <button style="float:left; width:45%" onclick="goBack()">Back</button>
                        <button type="submit" style="float:right;width:45%" name="Register">Register</button>
                    </div>
            </form>
        </div>
    </section>
    
    <script>
        function goBack(){
            window.location.href = "PetDetails.php";
        }
    </script>
</body>
</html>