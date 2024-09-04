<?php
session_start();
include "condb.php";

$fullname = "";
$email = "";
$NoPH = "";
$NoIC = "";
$errors = array();

if(isset($_POST['register_btn'])){
    register();
}

function register(){
    global $con, $errors, $fullname, $email, $NoPH, $NoIC;

    $fullname = e($_POST['fullname']);
    $email = e($_POST['email']);
    $NoPH = e($_POST['noph']);
    $NoIC = e($_POST['noic']);
    $password1 = e($_POST['password1']);
    $password2 = e($_POST['password2']);

    if (empty($fullname)){
        array_push($errors, "Fullname is required!");
    }
    else if (strlen($fullname) > 50){
        array_push($errors, "Fullname should not exceed 50 characters!");
    }
    else if (empty($email)){
        array_push($errors, "Email is required!");
    }
    else if (empty($NoPH)){
        array_push($errors, "Phone number is required!");
    }
    else if (empty($NoIC)){
        array_push($errors, "Identity card number is required!");
    }
    else if (empty($password1)){
        array_push($errors, "Password is required!");
    }
    else if (strlen($password1) > 15){
        array_push($errors, "Password should not be longer than 15 characters!");
    }
    else if ($password1 != $password2){
        array_push($errors, "Passwords are not match!");
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors);
    }

    if(count($errors) == 0) {
        $check = "SELECT * from customer where email = '$email' or noph = '$NoPH' or noic = '$NoIC';";
        $run = mysqli_query($con,$check);
        $num = mysqli_num_rows($run);
        if($num > 0){
            echo '<script>alert("Sorry, this account has been registered!");</script>';
        }else{
            $sql = "INSERT INTO customer (fullname, email, noph, noic, password, status) VALUES (?, ?, ?, ?, ?, ?)";
            $statement = mysqli_prepare($con, $sql);
            $status = true;
            mysqli_stmt_bind_param($statement, "ssssss", $fullname, $email, $NoPH, $NoIC, $password1, $status);
            $result = mysqli_stmt_execute($statement);

            if($result){
                echo '<script>alert("Register account successfully!");</script>';
            }
        }

        
    }
}

if (isset($_POST['login_btn'])){
    login();
}
function login(){
    global $con, $errors;

    $noic = e($_POST['noic']);
    $password = e($_POST['password']);

    if (empty($noic)){
        array_push($errors, "IC Number is required!");
    } else if (empty($password)){
        array_push($errors, "Password is required!");
    }

    if(count($errors)==0){

        $stmt = $con->prepare("SELECT * FROM customer WHERE noic = ? AND password = ?");
            $stmt->bind_param("ss", $noic, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
        if (mysqli_num_rows($result)==1){    
            $logged_in_customer = mysqli_fetch_assoc($result);
            $customerid = $logged_in_customer['customerid'];
            $noic = $logged_in_customer['noic'];
            $status = $logged_in_customer['status'];

            if($status){
                $_SESSION['customerid'] = $customerid;
                $_SESSION['noic'] = $noic;
                
                header('location: homepage.php');
                exit();
            }else{
                array_push($errors, "Your account is disabled.");
            }
        }else{
            array_push($errors, "Wrong username/password combination!");
        }
    }
}

function e($val){
    global $con;
    return mysqli_real_escape_string($con, trim($val));
}

function display_error(){
    global $errors;

    if (count($errors)>0){
        echo '<div class="error">';
            foreach ($errors as $error){
                echo $error .'<br>';
            }
        echo '</div>';
    }
}