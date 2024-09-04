<?php
session_start();
include('../Customer/condb.php');

if (isset($_POST['login_btn'])) {
    $noic = mysqli_real_escape_string($con, $_POST['noic']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM employee WHERE noic='$noic' AND password='$password';";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $usertype = $row['usertype'];

        if ($usertype == 'staff') {
            $status = $row['status'];
            if ($status) {
                $_SESSION['noic_staff'] = $noic;
                header('location: StaffHomepage.php');
                exit();
            } else {
                $_SESSION['error_msg'] = "Your account is disabled.";
                header('location: login.php');
                exit();
            }
        } elseif ($usertype == 'owner') {
            $_SESSION['noic_owner'] = $noic;
            header('location: ../Owner/OwnerHomePage.php');
            exit();
        }
    } else {
        $_SESSION['error_msg'] = "Invalid login credentials.";
        header('location: ../login.php');
        exit();
    }
}

function display_error()
{
    if (isset($_SESSION['error_msg'])) {
        $error = $_SESSION['error_msg'];
        unset($_SESSION['error_msg']);
        return '<div class="error">' . $error . '</div>';
    }
}
