<?php
session_start();
require_once("../model/user_infomodel.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $country = $_POST['country'] ?? 'default';

    if (!$fullname || !$email || !$phone || !$gender || !$address || $country === 'default') {
        echo "<script>alert('All fields are required.'); window.location.href='../view/profile_management/profile_management.php';</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.location.href='../view/profile_management/profile_management.php';</script>";
        exit;
    }

    if (strlen($phone) !== 11) {
        echo "<script>alert('Phone number must be 11 digits.'); window.location.href='../view/profile_management/profile_management.php';</script>";
        exit;
    }

    if (isset($_FILES['profile_picture'])) {
        $fileTmp = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $targetPath = "../asset/images and icons/upIMG/" . $fileName;
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['profile_picture']['type'], $allowedTypes)) {
            // type is ok
                if (move_uploaded_file($fileTmp, $targetPath)) {
                    $img_name = $fileName;
                }else 
                {
                     echo "<script>alert('Image upload failed.'); window.location.href='../view/profile_management/profile_management.php';</script>";
                    exit;
                }
        } else {
                     echo "<script>alert('Invalid Image Type.'); window.location.href='../view/profile_management/profile_management.php';</script>";
                     exit;
            }
        
    }

    $username = $_SESSION['username'];
    $status = updateUserInfo($username, $fullname, $email, $phone, $gender, $address, $country, $img_name);

    if ($status) {
        echo "<script>alert('Profile updated successfully.'); window.location.href='../view/profile_management/profile_management.php';</script>";
    } else {
        echo "<script>alert('Failed to update profile.'); window.location.href='../view/profile_management/profile_management.php';</script>";
    }
}
?>
