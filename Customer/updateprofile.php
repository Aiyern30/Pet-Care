<?php
include '../Customer/condb.php';
session_start();
if (!isset($_SESSION['noic'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>

    <?php 
    $petid = $_GET['update'];

    $SQL = "SELECT * FROM pet where petid = '$petid'; ";
    $run = mysqli_query($con,$SQL);
    if($num = mysqli_num_rows($run)> 0){
        $Data = mysqli_fetch_assoc($run);
        $Petname = $Data['petname'];
        $DOB = $Data['dob'];
        $Description = $Data['description'];
        $Type = $Data['type'];
        $Gender = $Data['gender'];

    }else{
        echo 'Something Error!';
    }

    
       
    if(isset($_POST['Update'])){
        $Petname = $_POST['Petname'];
        $Type = $_POST['Type'];
        $Gender = $_POST['Gender'];
        $DOB = $_POST['DOB'];
        $Description = $_POST['Description'];
        $petid = $_POST['petid'];
    
        $update = "UPDATE pet SET petname=?, dob=?, description=?, type=?, gender=? WHERE petid=?";
        $stmt = mysqli_prepare($con, $update);
        mysqli_stmt_bind_param($stmt, 'sssssi', $Petname, $DOB, $Description, $Type, $Gender, $petid);
        if (mysqli_stmt_execute($stmt)) {
            echo '<div class="success">
                  <strong>Update Successful!</strong>
                  </div>';               
        } else {
            echo '<div class="alert">
                  <strong>Alert!</strong> Something error!! '. mysqli_error($con) .'
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
    <title>Update Profile</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
</head>
<body>
    <?php 
        include 'homenav.php';
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
                }else if(Description.length > 50){  
                    alert("Description is too long!"); 
                    return false;  
                }
            }
        </script>

    <section class="form-container">
        <div class="form-wrapper">
            <header>Create Pet Details</header>
            <form action="updateprofile.php?update=<?php echo $petid?>" class="form" method="post" name="PetRegisterForm" onsubmit="return ValidateForm();">
                <div class="form-input-details">
                    <label for="">Pet Name</label>
                    <input type="text" name="petid" value="<?php echo $petid ?>" hidden>
                    <input type="text" name="Petname" value="<?php echo $Petname ?>" placeholder="Pet Name" autocomplete="off" required >
                </div>

                <div class="form-split">
                    <div class="form-input-details">
                        <label for="">Date of birth</label>
                        <input type="date" value="<?php echo $DOB ?>" name="DOB" placeholder="DOB" required >
                    </div>
                    <div class="form-input-details">
                        <label for="">Description</label>
                        <input type="text" value="<?php echo $Description ?>" name="Description" placeholder="Description" autocomplete="off">
                    </div>
                </div>

                
                <div class="form-split">
                    <div class="gender-box">
                        <h3>Type</h3>
                        <div class="gender-option">
                            <div class="gender">
                                <input type="radio" id="Dog"  name="Type" value="Dog" <?php if($Type == 'Dog') echo 'checked'?> >
                                <label for="Dog">Dog</label>
                            </div>
                            <div class="gender">
                                <input type="radio" id="Cat" name="Type" value="Cat" <?php if($Type == 'Cat') echo 'checked'?> >
                                <label for="Cat">Cat</label>
                            </div>
                            
                        </div>
                    </div>
                
                    <div class="gender-box">
                        <h3>Gender</h3>
                            <div class="gender-option">
                                <div class="gender">
                                    <input type="radio" id="Male" name="Gender" value="Male" <?php if($Gender == 'Male') echo 'checked'?> >
                                    <label for="Male">Male</label>
                                </div>
                                <div class="gender">
                                    <input type="radio" id="Female" name="Gender" value="Female" <?php if($Gender == 'Female') echo 'checked'?> >
                                    <label for="Female">Female</label>
                                </div>
                                
                            </div>
                    </div>
                </div>
                
                    <div class="form-btn-details">
                        <button style="float:left; width:45%" type="button" onclick="window.location.href='homepage.php';">Back</button>
                        <button type="submit" style="float:right;width:45%" name="Update">Update</button>
                    </div>
            </form>
        </div>
    </section>
</body>
</html>