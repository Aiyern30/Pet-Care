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
        $PetID = $_GET['petid'];
    

         if(isset($_POST['Submit'])){
            
                $PetID = $_POST['PetID'];
                $Subservice = $_POST['Subservice'];
                $Date = $_POST['Date'];
                $Time = $_POST['Time'];
                $S_Date = $_POST['S_Date'];
                $E_Date = $_POST['E_Date'];
                $Remarks = $_POST['Remarks'];

                if($Subservice == 'Cozy Cottage' || $Subservice == 'Purrfect Pad' || $Subservice == 'Grand Suite' || $Subservice == 'Royal Retreat' ){

                    $SQL = "SELECT subserviceid FROM subservice where subname = '$Subservice';";
                    $run = mysqli_query($con,$SQL);
                    $get = mysqli_fetch_assoc($run);
                    $Subserviceid = $get['subserviceid'];
                    $checkSchedule = "SELECT * FROM schedule where petid = '$PetID' and subserviceid = '$Subserviceid' and S_Date = '$S_Date' and E_Date = '$E_Date' ;";
                    $Result = mysqli_query($con,$checkSchedule);
                    $DATE = $S_Date.' '.$E_Date;
                    if($Result){

                        $validate = "SELECT * from progression where date = '$DATE' and service = '$Subservice' and petid = '$PetID';";
                        $run = mysqli_query($con,$validate);
                        $row = mysqli_num_rows($run);
                        if($row > 0){
                            echo '<section><div class="alert">
                                <strong>Record exists in database!</strong>
                            </div></section>';
                        }else{
                            $SQL = "INSERT INTO progression (petid, date, service, remarks) VALUES ('$PetID','$DATE','$Subservice','$Remarks')";
                            $run = mysqli_query($con,$SQL);
                            if($run){
                                header("Location:Progression.php");
                            } 
                        }
                        
                    }else{
                        echo '<section><div class="alert">
                                <strong>Details not match!</strong>
                            </div></section>';
                    }


                }else{
                    $SQL = "SELECT subserviceid FROM subservice where subname = '$Subservice';";
                    $run = mysqli_query($con,$SQL);
                    $get = mysqli_fetch_assoc($run);
                    $Subserviceid = $get['subserviceid'];
                    $checkSchedule = "SELECT * FROM schedule where petid = '$PetID' and subserviceid = '$Subserviceid' and date = '$Date' and time = '$Time' ;";
                    $Result = mysqli_query($con,$checkSchedule);
                    $ifGot = mysqli_num_rows($Result);
                    if($ifGot > 0){
                        $DATE = $Date.' '.$Time;

                        $validate = "SELECT * from progression where date = '$DATE' and service = '$Subservice' and petid = '$PetID';";
                        $run = mysqli_query($con,$validate);
                        $row = mysqli_num_rows($run);

                        if($row > 0){
                            echo '<section><div class="alert">
                                <strong>Record exists in database!</strong>
                            </div></section>';
                        }else{
                            $SQL = "INSERT INTO progression (petid, date, service, remarks) VALUES ('$PetID','$DATE','$Subservice','$Remarks')";
                            
                            $run = mysqli_query($con,$SQL);
                            if($run){
                                echo '<section><div class="success">
                                        <strong>Insert Successfull!</strong>
                                    </div></section>';
                            } 
                        }

                        
                    }else{
                        echo '<section><div class="alert">
                                <strong>Details not match!</strong>
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
    <title>Add Progression Details</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/table.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
</head>

<body>
    <?php 
        include 'sidebar.php';
    ?>
        <script>
            function Progression(){
                var Remarks = document.Form.Remarks.value;

                if (Remarks.length > 50) {
                    alert("Remarks cannot more than 50 characters!");
                    return false;
                }
                return true;
            }

            function goBack(){
                window.location.href="Progression.php";
            }
        </script>

    <section class="form-container">
        <div class="form-wrapper">
            <header>Add Progression Details</header>
            <form action="" name="Form" class="form" method="post" onsubmit="return Progression()">
                <div class="form-input-details">
                    
                    <label for="">Sub Services</label>
                    <div class="form-split">
                        <div class="select-box">
                            <select name="Subservice" required>
                                    <option value="BATH PACKAGE">BATH PACKAGE</option>
                                    <option value="HAIRCUT PACKAGE">HAIRCUT PACKAGE</option>
                                    <option value="PUPPY 101 PACKAGE">PUPPY 101 PACKAGE</option>
                                    <option value="Cozy Cottage">Cozy Cottage</option>
                                    <option value="Purrfect Pad">Purrfect Pad</option>
                                    <option value="Grand Suite">Grand Suite</option>
                                    <option value="Royal Retreat">Royal Retreat</option>
                                    <option value="Comprehensive physical exams">Comprehensive physical exams</option>
                                    <option value="Vaccinations">Vaccinations</option>
                                    <option value="Dental care">Dental care</option>
                                    <option value="Surgical procedures">Surgical procedures</option>
                                    <option value="Diagnostic testing">Diagnostic testing</option>
                                    <option value="Parasite prevention and treatment">Parasite prevention and treatment</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-split">
                    <div class="form-input-details">
                        <label for="Date">Date</label>
                        <input type="date" name="Date" placeholder="Date" >
                    </div>
                    <div class="form-input-details">
                        <label for="Time">Time</label>
                        <div class="select-box">
                            <select name="Time">
                                <option value="10:00 am - 11:00 am">10:00 am - 11:00 am</option>
                                <option value="11:00 am - 12:00 pm">11:00 am - 12:00 pm</option>
                                <option value="12:00 pm - 1:00 pm">12:00 pm - 1:00 pm</option>
                                <option value="1:00 pm - 2:00 pm">1:00 pm - 2:00 pm</option>
                                <option value="2:00 pm - 3:00 pm">2:00 pm - 3:00 pm</option>
                                <option value="3:00 pm - 4:00 pm">3:00 pm - 4:00 pm</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-split">
                    <div class="form-input-details">
                        <label  for="S_Date">Start Date</label>
                        <input type="date"  name="S_Date" placeholder="Start Date" >
                    </div>
                    <div class="form-input-details">
                        <label  for="E_Date">End Date</label>
                        <input type="date"  name="E_Date" placeholder="End Date" >
                    </div>
                </div>

                <div class="form-input-details">
                    <label for="">Remarks</label>
                    <input type="text" name="PetID" hidden value="<?php echo trim($_GET['petid']);?>" required>
                    <input type="text" name="Remarks" placeholder="Remarks" required>
                </div>
                
                    <div class="form-btn-details">
                        <button style="float:left; width:45%" onclick="goBack()">Back</button>
                        <button type="submit" style="float:right;width:45%" name="Submit">Submit</button>
                    </div>
            </form>
        </div>
    </section>
    
</body>
</html>