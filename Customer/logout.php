<?php
session_start();

unset($_SESSION['customerid']);
unset($_SESSION['noic']);

session_destroy();

header("location: ../login.php");
exit();
