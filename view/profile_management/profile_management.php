<?php
session_start();

require_once("../../model/user_infomodel.php");
$username = $_SESSION['username'];
$user = getUserInfo($username);
//print_r($user);

$imgLocation = "../../asset/images and icons/upIMG/" . $user['img_name'];
//print_r($imgLocation);

if (!isset($_COOKIE['status']) || $_COOKIE['status'] !== 'true') {
    header("Location: ../user_authentication/login.php");
    exit;
  }

  if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error === 'all_fields_required') {
        echo "<p style='color: red; font-weight: bold;'>All fields are required.</p>";
    } else if ($error === 'invalid_phone') {
        echo "<p style='color: red; font-weight: bold;'>Phone number must be 11 digits and numeric.</p>";
    } else if ($error === 'invalid_email') {
        echo "<p style='color: red; font-weight: bold;'>Invalid email format.</p>";
    } else if ($error === 'password_mismatch') {
        echo "<p style='color: red; font-weight: bold;'>Passwords do not match.</p>";
    } else if ($error === 'image_upload_failed') {
        echo "<p style='color: red; font-weight: bold;'>Image upload failed. Try again.</p>";
    } else if ($error === 'profile_image_required') {
        echo "<p style='color: red; font-weight: bold;'>Profile image is required.</p>";
    } else if ($error === 'username_exists') {
        echo "<p style='color: red; font-weight: bold;'>Username already exists</p>";
    } else if ($error === 'signup_failed') {
        echo "<p style='color: red; font-weight: bold;'>Signup failed!!</p>";
    }
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
        <label><input type="radio" name="gender" value="male" <?= ($user['gender'] == 'male') ? 'checked' : '' ?>> Male</label>
        <label><input type="radio" name="gender" value="female" <?= ($user['gender'] == 'female') ? 'checked' : '' ?>> Female</label>
        <label><input type="radio" name="gender" value="other" <?= ($user['gender'] == 'other') ? 'checked' : '' ?>> Other</label>
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
      </div>
    </form>
  </div>
    <script src="../../asset/js/profile.js"></script>
</body>
</html>