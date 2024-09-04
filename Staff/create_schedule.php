<?php
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_staff'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

if(isset($_POST['back'])){
    header("Location: Schedule.php");
    exit();
}

if(isset($_POST['create'])){
    $PETID = $_POST['petdd'];
    $serviceid = $_POST['serviceid'];
    $subserviceid = $_POST['subserviceid'];
    $Date = $_POST['date'];
    $Time = $_POST['time'];
    $startdate = new DateTime($_POST['start_date']);
    $enddate = new DateTime($_POST['end_date']);
    $duration = $enddate->diff($startdate);
    $total_days = $duration->days +1;
    $startdate_str = date_format($startdate, "y-m-d");
    $enddate_str = date_format($enddate, "y-m-d");

    $start_date = clone $startdate;
    $fully_booked_dates = array();
    $fully_booked_slots = array();

    if(!empty($PETID) && !empty($serviceid) && !empty($subserviceid) && (!empty($Date) && !empty($Time)) || (!empty($startdate) && !empty($enddate))){
        $currentDate = new DateTime(); // Get current date and time
        // if ($startdate < $currentDate) {
        //     echo '<script>alert("Start date or date cannot before the current date!");</script>';
        //     echo '<script>window.location.href = "create_schedule.php";</script>';
        // }

        if($serviceid == 2){
            while ($start_date <= $enddate){
                $date_str = $start_date->format('Y-m-d');

                $checkSlots = "SELECT * from availableslots where date ='$date_str';";
                $check = mysqli_query($con, $checkSlots);

                if(mysqli_num_rows($check)>0){
                    $check_full = "SELECT * from availableslots where date = '$date_str' and slots <= 0;";
                    $check = mysqli_query($con, $check_full);

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
                }else{
                    $insertDate = "INSERT INTO `availableslots` (date, slots) VALUES ('$date_str', 9)";
                    $run = mysqli_query($con,$insertDate);
                }
                $start_date->modify('+1 day');
            }
            if($enddate <= $startdate){
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
                    $SQL = "SELECT * FROM schedule where S_Date = '$startdate_str' and subserviceid  = '".$subserviceid."' AND E_Date = '$enddate_str' AND petid = '$PETID';";
                    $run = mysqli_query($con,$SQL);
                    if($num = mysqli_num_rows($run) > 0){
                        echo '<section><div class="alert">
                            <strong>Alert! </strong>Your pet has registered the same schedule which are from '.$startdate_str.' until '.$enddate_str.'.
                        </div></section>';
                    }else{
                        $SQL = "INSERT INTO schedule (`S_Date`, `E_Date`, `Duration`,`serviceid`, `subserviceid`, `petid`, `status`) VALUES ('$startdate_str','$enddate_str','$total_days','$serviceid','$subserviceid','$PETID', FALSE);";
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
        }else{
            $SQL2 = "SELECT * FROM schedule where date = '$Date' and subserviceid  = '$subserviceid' AND time = '$Time' AND petid = '$PETID';";
            $run = mysqli_query($con,$SQL2);
            if($num = mysqli_num_rows($run) > 0){
                echo '<section><div class="alert">
                        <strong> Alert!</strong>Your pet has registered the same schedule, date = '.$Date.' , time = '.$Time.'.
                    </div></section>';
            }else{
                $Check = "SELECT * FROM schedule where date = '$Date' and subserviceid = '$subserviceid' AND time = '$Time';";
                $checking = mysqli_query($con,$Check);
                    if(($num = mysqli_num_rows($checking)) >= 5){
                        echo '<section><div class="alert">
                                <strong> Alert!</strong>'.$Time.' has been booked, there are no slots available.
                            </div></section>';
                    } else {
                        $sql = "INSERT INTO `schedule`(`date`, `time`, `serviceid`, `subserviceid`, `petid`, `status`) VALUES ('$Date','$Time','$serviceid','$subserviceid','$PETID', FALSE)";
                        $result = mysqli_query($con,$sql);
                        $time_slot = 4;
                        $slot_left = $time_slot - $num;
                        if ($result) {
                            echo '<section><div class="success">
                                <strong> Successful Book!</strong>'.$slot_left.' slots left!
                            </div></section>';
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        }
                    }
            }
        }
    }else{
        echo '<script>alert("Please insert all the columns!");</script>';
        echo '<script>window.location.href="create_schedule.php";</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create schedule</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
    <script>
        function selectService() {
            var serviceSelect = document.getElementById("myDropdown");
            var serviceid = serviceSelect.value;
            var serviceName = serviceSelect.options[serviceSelect.selectedIndex].text;
            
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has("serviceid")) {
                urlParams.delete("serviceid");
            }
            if (serviceid === "2") {
                urlParams.set("showPethotel", "true");
                urlParams.delete("showOther");
            } else {
                urlParams.set("showOther", "true");
                urlParams.delete("showPethotel");
            } 

            window.location.href = "create_schedule.php?serviceid=" + serviceid + "&" + urlParams.toString();
        }
    </script>
    <?php
    $showPethotel = isset($_GET['showPethotel']) && $_GET['showPethotel'] === "true";
    $showOther = isset($_GET['showOther']) && $_GET['showOther'] === "true";
    ?>
    <style>
        .form-input-details select{
            text-align: center;
            position: relative;
            height: 50px;
            width: 100%;
            font-size: 1rem;
            outline: none;
            margin-top: 8px;
            border: 1px solid #b3d7ff;
            border-radius: 6px;
            padding: 0 15px;
            color: black;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.604);
        }
        .form-input-details select:hover{
            transform: scale(1.01);
            transition: all 0.5s ease;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
            padding: 0 20px;

        }
        .form-input-details select option{
            background: #ADD8E6 ;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <section class="form-container">
        <div class="form-wrapper">
            <header>Create Schedule</header>
            <form action="create_schedule.php" name="form" class="form" method="post">
                <div class="form-input-details">
                    <label for="">Service type</label><br>
                    <select id="myDropdown" onchange="selectService()" name="serviceid">
                    <option selected disabled>Select Service</option>
                        <?php
                            $selected_serviceid = isset($_GET['serviceid']) ? $_GET['serviceid'] : null;
                            $service_sql = "SELECT * FROM service";
                            $service_result = mysqli_query($con, $service_sql);
                            while ($row = mysqli_fetch_assoc($service_result)) {
                                $serviceid = $row['serviceid'];
                                $servicename = $row['servicename'];
                                $selected = ($selected_serviceid == $serviceid) ? 'selected' : '';
                                echo '<option value="'.$serviceid.'" '.$selected.'>'.$servicename.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-input-details">
                    <label for="">Subservice</label><br>
                    <select name="subserviceid" required>
                        <option selected disabled>Select Subservice</option>
                            <?php
                                $get_serviceid = $_GET['serviceid'];
                                $subservice_sql = "SELECT * from subservice where serviceid = '".$get_serviceid."'";
                                $subservice_result = mysqli_query($con, $subservice_sql) ;
                                while($row = mysqli_fetch_assoc($subservice_result)){
                                    $subserviceid = $row['subserviceid'];
                                    $subname = $row['subname'];
                                    $selected = '';
                                    echo '<option value="'.$subserviceid.'" '.$selected.'>'.$subname.'</option>';
                                }
                            ?>
                    </select>
                </div>
                <div class="form-input-details">
                    <label for="">Pet Name</label>
                    <select name="petdd">
                    <option selected disabled>Select Pet</option>
                        <?php
                            $selected_petid = isset($_GET['petid']) ? $_GET['petid'] : null;
                            $pet_sql = "SELECT * from pet";
                            $pet_result = mysqli_query($con, $pet_sql);
                            while($row = mysqli_fetch_assoc($pet_result)){
                                $petid = $row['petid'];
                                $petname = $row['petname'];
                                $selected = ($selected_petid == $petid) ? 'selected' : '';
                                echo '<option value="'.$petid.'" '.$selected.'>'.$petname.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-input-details" style="display: <?php echo $showPethotel ? "block" : "none"; ?>">
                    <label for="">Start Date</label>
                    <input type="date" name="start_date">
                </div>
                <div class="form-input-details" style="display: <?php echo $showPethotel ? "block" : "none"; ?>">
                    <label for="">End Date</label>
                    <input type="date" name="end_date">
                </div>
                <div class="form-input-details" style="display: <?php echo $showOther ? "block" : "none"; ?>">
                    <label for="">Date</label>
                    <input type="date" name="date">
                </div>
                <div class="form-input-details" style="display: <?php echo $showOther ? "block" : "none"; ?>">
                    <label for="">Time</label>
                    <select name="time" id="" required>
                            <option value="10:00 am - 11:00 am">10:00 am - 11:00 am</option>
                            <option value="11:00 am - 12:00 pm">11:00 am - 12:00 pm</option>
                            <option value="12:00 pm - 1:00 pm">12:00 pm - 1:00 pm</option>
                            <option value="1:00 pm - 2:00 pm">1:00 pm - 2:00 pm</option>
                            <option value="2:00 pm - 3:00 pm">2:00 pm - 3:00 pm</option>
                            <option value="3:00 pm - 4:00 pm">3:00 pm - 4:00 pm</option>
                    </select>
                </div>
                <div class="form-btn-details">
                    <button style="float:left;width:45%" name="back">Back</button>
                    <button type="submit" style="float:right;width:45%" name="create">Create</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>