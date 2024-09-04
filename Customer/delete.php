<?php
include '../Customer/condb.php';

if (isset($_GET['event_id'])) {
    $eventId = $_GET['event_id'];
    $tableName = 'event';
    $idColumnName = 'eventid';
} elseif (isset($_GET['schedule_id'])) {
    $eventId = $_GET['schedule_id'];
    $tableName = 'schedule';
    $idColumnName = 'scheduleid';
} else {
    echo 'Invalid request!';
    exit;
}

$sql = "DELETE from $tableName where $idColumnName = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $eventId);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo '<script>alert("Event deleted successfully!");</script>';
    echo '<script>window.location.href="Schedule.php";</script>';
} else {
    echo '<script>alert("Event delete unsuccessfully!");</script>';
    echo '<script>window.location.href="Schedule.php";</script>';
}
?>
