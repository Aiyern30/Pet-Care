<?php
include '../Customer/condb.php';
$knowledgeid = $_REQUEST['knowledgeid'];
$sql = "DELETE from knowledge where knowledgeid='".$knowledgeid."'";
$result = mysqli_query($con, $sql);

if($result){
    echo '<script>alert("Delete successfully!")</script>';
    echo '<script>window.location.href = "knowledgebase.php";</script>';
    exit();
}else{
    echo '<script>alert("Delete unsuccessfully!")</script>';
    echo '<script>window.location.href = "view_knowledgebase.php?knowledgeid='.$knowledgeid.'";</script>';
    exit();
}
?>