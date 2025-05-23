<?php
session_start();

require_once("../../model/user_infomodel.php");
$username = $_SESSION['username'];
$user = getUserInfo($username);
print_r($user);

$imgLocation = "../../asset/images and icons/upIMG/" . $user['img_name'];

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
    <link rel="stylesheet" href="../../asset/css/profile_management.css">
</head>
<body>
    <div class="container">
        <h1>My Profile</h1>
<form id="profile_form"    action="../../controller/upProfile.php" method="POST" enctype="multipart/form-data">
      <div class="profile_img_sec">
        <label for="picture_up">
          <img id="profilePreview" src="<?= $imgLocation ?>" alt="Profile Picture" />
        </label>
        <input type="file" id="picture_up" name="profile_picture" onchange="previewImage(event)">
      </div>

      <div class="form_grp">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" value="<?= $user['fname'] ?? '' ?>" required>
      

      
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $user['email'] ?? '' ?>" required>
      

      
        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" value="<?= $user['phone'] ?? '' ?>">
      
    <div class="gender_grp">
        <label>Gender</label>
        <label><input type="radio" name="gender" value="Male" <?= ($user['gender'] == 'male') ? 'checked' : '' ?>> Male</label>
        <label><input type="radio" name="gender" value="Female" <?= ($user['gender'] == 'female') ? 'checked' : '' ?>> Female</label>
        <label><input type="radio" name="gender" value="Other" <?= ($user['gender'] == 'other') ? 'checked' : '' ?>> Other</label>
      </div>
      
        <label for="address">Address</label>
        <textarea id="address" name="address"><?= $user['address'] ?? '' ?></textarea>
      

      
        <label for="country">Country</label>
        <select id="country" name="country">
          <option value="default" <?= ($user['country'] == 'default') ? 'selected' : '' ?>>Default</option>
          <option value="Bangladesh" <?= ($user['country'] == 'Bangladesh') ? 'selected' : '' ?>>Bangladesh</option>
          <option value="India" <?= ($user['country'] == 'India') ? 'selected' : '' ?>>India</option>
          <option value="USA" <?= ($user['country'] == 'USA') ? 'selected' : '' ?>>USA</option>
          <option value="UK" <?= ($user['country'] == 'UK') ? 'selected' : '' ?>>UK</option>
        </select>
      </div>


      <div class="form_btn">
        <button type="submit" onclick=" return saveProfile()">Save</button> 
        <!-- return saveProfile() ensures JS validation runs first; if validation fails, submission is cancelled. -->
        <button type="reset">Reset</button>
      </div>
    </form>
  </div>
    <script src="../../asset/js/profile.js"></script>
</body>
</html>