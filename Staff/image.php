<?php
include '../Customer/condb.php';
$id = $_GET['id'];
$sql = "SELECT * FROM knowledge WHERE knowledgeid = '".$id."'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$type = $row['imageType'];
$data = $row['imageData'];

header('content-type: '.$type);
echo $data;
?>