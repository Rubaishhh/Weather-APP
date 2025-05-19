<?php
session_start();

require_once("../../model/user_infomodel.php");
$username = $_SESSION['username'];
$user = getUserInfo($username);

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../user_authentication/login.php");
    exit;
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
    <link rel="stylesheet" href="../../asset/css/\profile_management.css">
</head>
<body>
    <div class="main_container">
        <h1>My Profile</h1>
        <div class="picture">
            <label for="picture_up">
                <img src="../../asset/images and icons/no_profile_pic.png" alt="Profile picture">
            </label>
            <!-- <input type="file" name="picture_up" id="picture_up" style="display: none"> -->
            
        </div>
        <form id="profile_form">
            <input type="text" id="fullname" name="fullname" value="<?= $user['fname'] ?? '' ?>">
            <input type="email" id="email" name="email" value="<?= $user['email'] ?? '' ?>">
            <input type="tel" id="phone" name="phone" value="<?= $user['phone'] ?? '' ?>">
            <textarea name="address" id="address"><?= $user['address'] ?? '' ?></textarea>

            <select name="country" id="country">
                <option value="default" <?= ($user['country'] == 'default') ? 'selected' : '' ?>>Default</option>
                <option value="Bangladesh" <?= ($user['country'] == 'Bangladesh') ? 'selected' : '' ?>>Bangladesh</option>
                <option value="India" <?= ($user['country'] == 'India') ? 'selected' : '' ?>>India</option>
                <option value="USA" <?= ($user['country'] == 'USA') ? 'selected' : '' ?>>USA</option>
                <option value="UK" <?= ($user['country'] == 'UK') ? 'selected' : '' ?>>UK</option>
            </select>

            <div class="gender">
                <label><input type="radio" name="gender" value="Male" <?= ($user['gender'] == 'male') ? 'checked' : '' ?>> Male</label>
                <label><input type="radio" name="gender" value="Female" <?= ($user['gender'] == 'female') ? 'checked' : '' ?>> Female</label>
                <label><input type="radio" name="gender" value="Other" <?= ($user['gender'] == 'other') ? 'checked' : '' ?>> Other</label>
            </div>

            <div class="form_btn">
                <button type="button" onclick="saveProfile()">Save</button>
                <button type="reset">Reset</button>
            </div>
        </form>
    </div>
    <script src="../../asset/js/profile.js"></script>
</body>
</html>