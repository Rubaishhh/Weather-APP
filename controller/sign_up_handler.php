<?php

require_once('../model/db.php');
require_once('../model/user_infomodel.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $uname = trim($_POST['username'] ?? '');
    $fname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirmpassword = trim($_POST['confirmpassword'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $country = $_POST['country'] ?? '';

    if (
        empty($uname) || empty($fname) || empty($email) || empty($password) || empty($confirmpassword)
        || empty($phone) || empty($dob) || empty($gender) || empty($address) || empty($country)
    ) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit;
    }

    if (!is_numeric($phone) || strlen($phone) !== 11) {
        echo "<script>alert('Invalid phone number'); window.history.back();</script>";
        exit;
    }
    if (!str_contains($email, '@') || !str_contains($email, '.')) {
    echo "<script>alert('Invalid email'); window.history.back();</script>";
    exit;
}

    if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    // print_r($_FILES);
    $imgName= '';
    if(isset($_FILES['profile_image']) ){
        $imgTmp = $_FILES['profile_image']['tmp_name'];
        $imgName = $_FILES['profile_image']['name'];
        $target = "../asset/images and icons/upIMG/".$imgName;

        if(!move_uploaded_file($imgTmp, $target) ){
            echo "<script>alert('Image upload failed.'); window.history.back();</script>";
        exit;
        }
    }else {
    echo "<script>alert('Please upload a profile image.'); window.history.back();</script>";
    exit;
}

    $result = sign_up($uname, $fname, $email, $password, $phone, $dob, $gender, $address, $country, $imgName);

    if ($result === true) {
        header("Location: ../view/user_authentication/login.php");
        exit;
    }else if($result === "exists" ){
        header("Location: ../view/user_authentication/sign_up.php?error=username_exists");
        
    }
     else {
        echo "<script>alert('Signup failed!!');</script>";
    }
}
?>
