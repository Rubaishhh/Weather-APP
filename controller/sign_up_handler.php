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
        header("Location: ../view/user_authentication/sign_up.php?error=all_fields_required");
        exit;
    }

    if (!is_numeric($phone) || strlen($phone) !== 11) {
        header("Location: ../view/user_authentication/sign_up.php?error=invalid_phone");
        exit;
    }

    if (strpos($email, '@') === false || strpos($email, '.') === false || strpos($email, '@') > strrpos($email, '.')) {
        header("Location: ../view/user_authentication/sign_up.php?error=invalid_email");
        exit;
    }

    if ($password !== $confirmpassword) {
        header("Location: ../view/user_authentication/sign_up.php?error=password_mismatch");
        exit;
    }

    $imgName = '';
    if (isset($_FILES['profile_image'])) {
        $imgTmp = $_FILES['profile_image']['tmp_name'];
        $imgName = $_FILES['profile_image']['name'];
        $target = "../asset/images and icons/upIMG/" . $imgName;

        if (!move_uploaded_file($imgTmp, $target)) {
            header("Location: ../view/user_authentication/sign_up.php?error=image_upload_failed");
            exit;
        }
    } else {
        header("Location: ../view/user_authentication/sign_up.php?error=profile_image_required");
        exit;
    }

    $result = sign_up($uname, $fname, $email, $password, $phone, $dob, $gender, $address, $country, $imgName);

    if ($result === true) {
        header("Location: ../view/user_authentication/login.php");
        exit;
    } else if ($result === "exists") {
        header("Location: ../view/user_authentication/sign_up.php?error=username_exists");
        exit;
    } else {
        header("Location: ../view/user_authentication/sign_up.php?error=signup_failed");
        exit;
    }
}
?>
