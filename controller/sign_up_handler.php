<?php

require_once('../model/db.php');
require_once('../model/user_infomodel.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uname = $_POST['username'];
    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];

    $result = sign_up($uname, $fname, $email, $password, $phone, $dob, $gender, $address, $country);

    if ($result === true) {
        header("Location: ../view/user_authentication/login.php");
        exit;
    }else if($result === "exists" ){
        header("Location: ../view/user_authentication/sign_up.php?error=username_exists");
        
    }
     else {
        echo "<script>alert('Signup failed. Try again!!');</script>";
    }
}
?>
