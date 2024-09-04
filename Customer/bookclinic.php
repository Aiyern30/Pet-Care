<?php 
include 'condb.php';
session_start();
if (!isset($_SESSION['noic'])){
    echo "<script>alert('You are no right to access this page. Please login first!');</script>";
    echo "<script>window.location.href='homepage.php';</script>";
    exit();
}
?>
<?php 
    if(isset($_GET['clinic'])){
        $sql = "SELECT * FROM subservice";
        $result = mysqli_query($con, $sql);
    
        while ($row = mysqli_fetch_assoc($result)) {
            $Subname = $row['subname'];
            $Subserviceid = $row['subserviceid'];
            $serviceid = $row['serviceid'];
            if ($Subname == $_GET['clinic']) {
                $_SESSION['Subserviceid'] = $Subserviceid;
                $_SESSION['Subname'] = $Subname;
                $_SESSION['Serviceid'] = $serviceid;
                
            }
        }
    }
    if(isset($_POST['bookClinic'])){
        $Petid = $_POST['petid'];
        $Date = $_POST['Date'];
        $Time = $_POST['Time'];
        $Petid = $_POST['petid'];
    
        // Date validation
        $currentDate = date("Y-m-d");
        if(strtotime($Date) < strtotime($currentDate)){
            echo '<section><div class="alert">
                    <strong>Alert!</strong> Selected date cannot be before the current date.
                </div></section>';
        }
        else {
            $SQL = "SELECT * FROM schedule WHERE date = '$Date' AND subserviceid = '".$_SESSION['Subserviceid']."' AND time = '$Time' AND petid = '$Petid';";
            $run = mysqli_query($con, $SQL);
            if($num = mysqli_num_rows($run) > 0){
                echo '<section><div class="alert">
                        <strong>Alert!</strong> Your pet has already registered for the same schedule. Date = '.$Date.', time = '.$Time.'.
                    </div></section>';
            } else {
                $Check = "SELECT * FROM schedule WHERE date = '$Date' AND subserviceid = '".$_SESSION['Subserviceid']."' AND time = '$Time';";
                $checking = mysqli_query($con, $Check);
                if(($num = mysqli_num_rows($checking)) >= 5){
                    echo '<section><div class="alert">
                            <strong>Alert!</strong> '.$Time.' has been fully booked. There are no slots available.
                        </div></section>';
                } else {
                    $sql = "INSERT INTO `schedule`(`date`, `time`, `serviceid`, `subserviceid`, `petid`, `status`) VALUES ('$Date','$Time','".$_SESSION['Serviceid']."','".$_SESSION['Subserviceid']."','$Petid', FALSE)";
                    $result = mysqli_query($con, $sql);
                    $time_slot = 4;
                    $slot_left = $time_slot - $num;
                    if ($result) {
                        echo '<section><div class="success">
                            <strong>Successful Book!</strong> '.$slot_left.' slots left!
                        </div></section>';
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($con);
                    }
                }
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
    <title>Book Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/customer/form.css">
    <link rel="stylesheet" href="../assets/css/customer/popup.css">
</head>
<body>
<script>
            function ClinicValidate() {
                var Petname = document.ClinicForm.petname.value;

                if (Petname == null || Petname == "") {
                    alert("Pet name cannot be empty!");
                    return false;
                
                }
                return true;
            }

        </script>
    <div class="container">
        <div class="title">Booking Veterinary Clinic
        <select class="top-right-button" id="myDropdown" required onchange="selectPet(); if (this.value === 'addpet') window.location.href = 'pet_register.php';">
            <?php 
                $sql = "SELECT * from pet where noic = '".$_SESSION['noic']."'";
                $result = mysqli_query($con, $sql);
                $num = mysqli_num_rows($result);
                if($num == 0){
                    echo '<option value="">Click Here</option>';
                    echo ' <option value="addpet">+ Add Pet +</option>';
                }else{
                    echo '<option selected disabled >Click Here</option>';
                        while($row = mysqli_fetch_assoc($result)){
                        $petname = $row['petname'];
                        $petid = $row['petid'];
                        echo '<option value="'.$petid.'">'.$petname.'</option>';
                    }
                }
                 
            ?>
        </select>
        </div>
        <form action="bookclinic.php" method="POST" name="ClinicForm" onsubmit="return ClinicValidate();">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Pet Name</span>
                        <input type="hidden" name="petid" id="petId" >
                        <input type="text" name="petname" id="petName" placeholder="Pet name" required readonly>
                    </div>

                    <script>
                        function selectPet() {
                            var petSelect = document.getElementById("myDropdown");
                            var petId = petSelect.value;
                            var petName = petSelect.options[petSelect.selectedIndex].text;
                            document.getElementById("petId").value = petId;
                            document.getElementById("petName").value = petName;
                        }
                    </script>

                    <div class="input-box">
                        <span class="details">Full Range Services</span>
                        <select id="clinic" name="Clinic"  >
                            <option value="<?php echo $_SESSION['Subserviceid']?>"><?php echo $_SESSION['Subname']?></option>
                        </select>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Date <i class="fa-solid fa-calendar-days"></i></span>
                        <input type="date" name="Date" placeholder="Your name" required>
                    </div>
                    
                    <div class="input-box">
                        <span class="details">Time <i class="fas fa-clock"></i></span>
                        <select name="Time" id="">
                            <option value="10:00 am - 11:00 am">10:00 am - 11:00 am</option>
                            <option value="11:00 am - 12:00 pm">11:00 am - 12:00 pm</option>
                            <option value="12:00 pm - 1:00 pm">12:00 pm - 1:00 pm</option>
                            <option value="1:00 pm - 2:00 pm">1:00 pm - 2:00 pm</option>
                            <option value="2:00 pm - 3:00 pm">2:00 pm - 3:00 pm</option>
                            <option value="3:00 pm - 4:00 pm">3:00 pm - 4:00 pm</option>
                        </select>
                    </div>
                </div>
                    
                    <div class="button">
                        <input style="width: 100%;" type="submit" name="bookClinic" value="Book Appointment">
                        <div style="text-align:center"><br>
                        <a href="clinic.php"><input style="width: 100px; height:45px" type="button" value="Back"></a>
                        </div>
                    </div>
                
            </form>
            <script>
                const dropdown = document.getElementById("myDropdown");
                    const input = document.getElementById("Petname");

                    dropdown.addEventListener("change", () => {
                        input.value = dropdown.value;
                    });
            </script>
    </div>
</body>
</html>