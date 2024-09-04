<?php 
include 'condb.php';
session_start();
if (!isset($_SESSION['noic'])){
    echo "<script>alert('You are no right to access this page. Please login first!');</script>";
    echo "<script>window.location.href='homepage.php';</script>";
    exit();
}

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $currentDate = new DateTime();
    $currentDateStr = $currentDate->format('Y-m-d');
    ?>
<?php 
    if(isset($_GET['pet'])){
        $sql = "SELECT * FROM subservice";
        $result = mysqli_query($con, $sql);
    
        while ($row = mysqli_fetch_assoc($result)) {
            $Subname = $row['subname'];
            $Subserviceid = $row['subserviceid'];
            $serviceid = $row['serviceid'];
            if ($Subname == $_GET['pet']) {
                $_SESSION['Subserviceid'] = $Subserviceid;
                $_SESSION['Subname'] = $Subname;
                $_SESSION['Serviceid'] = $serviceid;
                
            }
        }
    }
        
        if(isset($_POST['bookHotel'])){
            $Petid = $_POST['petid'];
            $S_Date = new DateTime($_POST['S_Date']);

            if ($S_Date < $currentDate) {
                echo '<script>alert("Start date cannot before the current date!");</script>';
                echo '<script>event.preventDefault();</script>'; 
            }else{
            $E_Date = new DateTime($_POST['E_Date']);
            $duration = $E_Date->diff($S_Date);
            $total_days = $duration->days +1;
        
            $S_Date_Str = date_format($S_Date,"y-m-d");
            $E_Date_Str = date_format($E_Date,"y-m-d");
        
            $start_date = clone $S_Date; //Create new object so will not affect the original object
            $fully_booked_dates = array(); // array to store fully booked dates
            $fully_booked_slots = array(); // array to store number of slots left for each fully booked date
        
            while ($start_date <= $E_Date) {
                $date_str = $start_date->format('Y-m-d');
        
                $checkSlots = "SELECT * FROM `availableslots` WHERE date = '$date_str';";
                $check = mysqli_query($con,$checkSlots);
        
                if(mysqli_num_rows($check) > 0){
                    $check_full = "SELECT * FROM `availableslots` WHERE date = '$date_str' AND `slots` <= 0;";
                    $check = mysqli_query($con,$check_full);
        
                    if(mysqli_num_rows($check) > 0){
                        $fully_booked_dates[] = $date_str; // store date in the array
                        $get_slots_left = "SELECT `slots` FROM `availableslots` WHERE date = '$date_str';";
                        $get_slots = mysqli_query($con, $get_slots_left);
                        $slots = mysqli_fetch_assoc($get_slots); 
                        $fully_booked_slots[] = $slots['slots']; // store slots in the array
                    } else {
                        $update_slots = "UPDATE `availableslots` SET `slots` = `slots` - 1 WHERE date = '$date_str';";
                        $run = mysqli_query($con,$update_slots);
                    }
                } else {
                    $insertDate = "INSERT INTO `availableslots` (date, slots) VALUES ('$date_str', 9)";
                    $run = mysqli_query($con,$insertDate);
                }
        
                $start_date->modify('+1 day');
            }
                if($E_Date <= $S_Date){
                    echo '<section><div class="alert">
                                <strong>Alert!</strong> Your end date should not before the start date. Please Choose again.!
                            </div></section>';
                }else{
                    if(count($fully_booked_dates) > 0){
                    $message = "Sorry, the hotel is fully booked for the following dates:<br>";
            
                    for ($i=0; $i < count($fully_booked_dates); $i++) { 
                        $message .= $fully_booked_dates[$i]." (slots left: ".$fully_booked_slots[$i].")<br>";
                    }
                    
            
                    echo '<section><div class="alert">
                                <strong>Alert!</strong>' .$message.'
                            </div></section>';
                    }else{

                        $SQL = "SELECT * FROM schedule where S_Date = '$S_Date_Str' and subserviceid  = '".$_SESSION['Subserviceid']."' AND E_Date = '$E_Date_Str'
                         AND petid = '$Petid';";
                        $run = mysqli_query($con,$SQL);
                        if($num = mysqli_num_rows($run) > 0){
                            echo '<section><div class="alert">
                                <strong>Alert! </strong>Your pet has registered the same schedule which are from '.$S_Date_Str.' until '.$E_Date_Str.'.
                            </div></section>';
                        }else{
                           $SQL = "INSERT INTO schedule (`S_Date`, `E_Date`, `Duration`,`serviceid`, `subserviceid`, `petid`, `status`) 
                           VALUES ('$S_Date_Str','$E_Date_Str','$total_days','".$_SESSION['Serviceid']."','".$_SESSION['Subserviceid']."','$Petid', FALSE);";
                        $Insert = mysqli_query($con,$SQL);

                        if($Insert){
                            echo '<section><div class="success">
                                <strong> Successful Book!</strong>
                            </div></section>';
                        }else{
                            echo '<section><div class="alert">
                                <strong>Alert!</strong>Something Error!
                            </div></section>';
                        } 
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
    <title>Book Pet Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/customer/form.css">
    <link rel="stylesheet" href="../assets/css/customer/popup.css">
</head>

<body>
    <script>
        function Pet_Validate() {
                var Petname = document.Pet_Form.petname.value;

                if (Petname == null || Petname == "") {
                    alert("Pet name cannot be empty!");
                    return false;
                
                }
                return true;
            }
    </script>
    <div class="container">
        <div class="title">Booking Pet Hotel
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
            <form action="bookpet.php" method="POST" name="Pet_Form" onsubmit="return Pet_Validate();">
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
                        <span class="details">Room Type</span>
                        <select id="Room Size">
                            <option value="<?php echo $_SESSION['Subserviceid']?>"><?php echo $_SESSION['Subname']?></option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Start Date <i class="fa-solid fa-calendar-days"></i></span>
                        <input  type="date" name="S_Date" placeholder="Your name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">End Date <i class="fa-solid fa-calendar-days"></i></span>
                        <input  type="date" name="E_Date" placeholder="Your name" required>
                    </div>

                </div>

                    
                    <div class="button">
                        <input style="width: 100%;" type="submit" name="bookHotel" value="Book Appointment">
                        <div style="text-align:center"><br>
                        <a href="pethotel.php"><input style="width: 100px; height:45px" type="button" value="Back"></a>
                        </div>   
                    </div>
            </form>
    </div>
    <!-- <div id="popup-box">
        <h3>Registration Successful!</h3>
        <p>Your registration has been confirmed. Thank you for choosing our pet hotel.</p>
         <button id="close-btn">Close</button>
    </div> -->
    <style>
        
#popup-box {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  border: 2px solid #333;
  z-index: 9999;
}

.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9998;
  display: none;
}

.popup-active .popup-overlay {
  display: block;
}

.popup-active #popup-box {
  display: block;
}

    </style>
    <script>
                    // Open popup box on click of register button
            const registerBtn = document.getElementById('register-btn');
            const popupOverlay = document.createElement('div');
            popupOverlay.classList.add('popup-overlay');
            document.body.appendChild(popupOverlay);

            registerBtn.addEventListener('click', () => {
            document.body.classList.add('popup-active');
            });

            // Close popup box on click of close button or overlay
            const closeBtn = document.getElementById('close-btn');

            function closePopup() {
            document.body.classList.remove('popup-active');
            }

            closeBtn.addEventListener('click', closePopup);
            popupOverlay.addEventListener('click', closePopup);

    </script>
    <script>
         const dropdown = document.getElementById("myDropdown");
            const input = document.getElementById("Petname");

            dropdown.addEventListener("change", () => {
                input.value = dropdown.value;
            });
    </script>
    
</body>
</html>