<?php 
$con = new mysqli('localhost','root','','petcareDB');

if(!$con){
    die(mysqli_error($con));
}
if (mysqli_connect_errno()) {
    printf("DB error: %s", mysqli_connect_error());
    exit();
}
?>