<?php
session_start() ;
if (!isset($_SESSION['noic'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

include 'calendar-action.php';
include 'homenav.php' ;
include 'condb.php';
date_default_timezone_set('Asia/Kuala_Lumpur');
$current_time = $_GET['date']??null;
$calendar = new Calendar($current_time);

$show_petid = $_GET['petid']??null;
$calendar = new Calendar($current_time, $show_petid);

if ($show_petid) {
    $sql = "SELECT pet.petname, subservice.subname, service.serviceid, schedule.date, schedule.S_Date, schedule.E_Date, schedule.scheduleid
            FROM pet 
            JOIN schedule ON pet.petid = schedule.petid 
            JOIN subservice ON schedule.subserviceid = subservice.subserviceid 
            JOIN service ON subservice.serviceid = service.serviceid
            WHERE pet.petid = '".$show_petid."'";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)){
        $event_name = $row['subname'];
        $petname = $row['petname'];
        $date = $row['S_Date']??$row['date'];
        $start_date = new DateTime($date);
        $end_date = $row['E_Date']? new DateTime($row['E_Date']):null;
        $duration = $end_date?$end_date->diff($start_date)->days +1 : 1;
        $service_id = $row['serviceid'];
        $schedule_id = $row['scheduleid'];

        switch ($service_id){
            case 1:
                $color = 'blue';
                break;
            case 2:
                $color = 'red';
                break;
            case 3:
                $color = 'green';
                break;
        }

        $calendar->add_event($event_name, $date, $duration, $color, $schedule_id, 'schedule');
    }

    $sql2 = "SELECT * FROM event WHERE petid = '".$show_petid."'";
    $result2 = mysqli_query($con, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $eventname = $row['title'];
            $datetime = $row['datetime'];
            $t_datetime = new DateTime($datetime);
            $shw_date = $t_datetime->format('Y-m-d');
            $event_id = $row['eventid'];
            
            $calendar->add_event($eventname, $shw_date, '1', 'yellow',$event_id, 'event');
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
    <title>Schedule</title>
    <link rel="stylesheet" href="../assets/css/customer/cstyle.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <script>
        function selectPet(){
            var petid = document.getElementById("myDropdown").value;
            window.location.href = "Schedule.php?petid=" + petid;
        }
    </script>
    <style>
        .schedule-title {
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            padding: 20px;
            margin-bottom: 20px;
        }
        .schedule-title h1 {
            color: #333;
            font-size: 30px;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .buttons-container {
            float: right;
        }
        .PetBtn {
            margin-top:10px ;
            border-radius: 5px;
            background: white;
            height: 50px;
            width: 200px;
            margin-right: 20px;
            color: black;
            font-size: 18px;
        } 
        .PetBtn:hover{
            background-color: #ADD8E6;
        }
        .PetBtn1 {
            position: relative;
            display: inline-block;
        }
        .PetDropdown {
            margin-top:10px ;
            border-radius: 5px;
            background-color: white;
            height: 50px;
            width: 100px;
            margin-right: 20px;
            color: black;
            font-size: 18px;
            text-align: center;
            border: 2px solid black;
        }
        .PetDropdown option {
            display: block;
            border-radius: 5px;
            background: #ADD8E6 ;
            outline: 1px solid black;
            color: black;
            height: 50px;
            width: 100px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            width: auto;
        }
        .PetBtn1:hover .PetBtn1-content {
            display: block;
        }

        .PetBtn1-content button:hover {
            background-color: #ddd;
            color: black;
        }
        .PetBtn1-content a{
            text-decoration: none;
        }
        @media only screen and (max-width: 800px) {
            
            
            .PetBtn{
                
                width: 150px;
                height: 45px;
                font-size: 14px;
            }
        }
        @media only screen and (max-width: 600px) {
            .buttons-container{
                height: 150px;
                width: 100%;
            }
            .PetBtn{
                width: 100px;
                height: 45px;
                font-size: 10px;
            }
        }
        .event a{
            position: relative;
            text-align: center;
            margin: 2px;
            padding: 2px;
            color: #fff;
            font-size: 0.8em;
            border-radius: 3px;
        }
        .calendar {
            display: flex;
            flex-flow: column;
            border: 2px solid black;
        }
        .calendar .header .month-year {
            font-size: 20px;
            font-weight: bold;
            color: white;
            background-color: #70560d;
            border-bottom: 2px solid black;
            padding: 20px 0;
            text-align: center;
        }
        .calendar .days {
            display: flex;
            flex-flow: wrap;
            background-color: #fff;
        }
        .calendar .days .day_name {
            width: calc(100% / 7);
            border-right: 2px solid black;
            border-bottom: 2px solid black;
            padding: 20px;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: bold;
            color: #818589;
            color: #fff;
            background-color: #cf9d15;
        }
        .calendar .days .day_name:nth-child(7) {
            border-right: none;
        }
        .calendar .days .day_num {
            display: flex;
            flex-flow: column;
            width: calc(100% / 7);
            border-right: 1px solid #e6e9ea;
            border-bottom: 1px solid #e6e9ea;
            padding: 15px;
            font-weight: bold;
            color: #7c878d;
            cursor: pointer;
            min-height: 100px;
        }
        .calendar .days .day_num span {
            display: inline-flex;
            width: 30px;
            font-size: 14px;
        }
        .calendar .days .day_num .event {
            margin-top: 10px;
            font-weight: 500;
            font-size: 14px;
            padding: 3px 6px;
            border-radius: 4px;
            color: #fff;
            word-wrap: break-word;
        }
        .calendar .days .day_num .event.green {
            background-color: #51ce57;
        }
        .calendar .days .day_num .event.blue {
            background-color: #518fce;
        }
        .calendar .days .day_num .event.red {
            background-color: #ce5151;
        }
        .calendar .days .day_num .event.yellow {
            background-color: #f7c30d;
        }
        .calendar .days .day_num:nth-child(7n+1) {
            border-left: 1px solid #e6e9ea;
        }
        .calendar .days .day_num:hover {
            background-color: #fdfdfd;
        }
        .calendar .days .day_num.ignore {
            background-color: #fdfdfd;
            color: #ced2d4;
            cursor: inherit;
        }
        .calendar .days .day_num.selected {
            background-color: #f1f2f3;
            cursor: inherit;
        }
    </style>
</head>
<body>
    <div class="schedule-title">
        <h1>Schedule</h1>
    </div>
    <div class="buttons-container">
        <div class="PetBtn1">
        <select class="PetDropdown" id="myDropdown" onchange="selectPet()">
            <option selected disabled>Select Pet</option>
            <?php
                $show_sql = "SELECT * FROM pet where noic = '".$_SESSION['noic']."'";
                $result_show = mysqli_query($con, $show_sql);
                $show_num = mysqli_num_rows($result_show);
                while($row = mysqli_fetch_assoc($result_show)){
                    $petname = $row['petname'];
                    $petid = $row['petid'];
                    $selected = '';
                    if ($show_petid == $petid){
                        $selected = 'selected';
                    }
                    echo '<option value="'.$petid.'" '.$selected.'>'.$petname.'</option>';
                }
            ?>
        </select>
        <a href="addevent.php"><button class="PetBtn">Add Event</button></a>
        </div>
    </div><br>
    <div class="section"></div><br>
    <div class="content">
        <?= $calendar ?>
    </div>
    <br><br>
</body>
</html>