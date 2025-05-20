<?php
require_once('../../model/db.php');
$con = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['uname'];
    $fname = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    if (empty($uname)) {
        $errors[] = "Username is required.";
    }

    if (empty($fname) || !preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $errors[] = "Full name must contain only letters and spaces (no numbers).";
    }

    if (empty($email) || !preg_match("/^[\w\.-]+@[\w\.-]+\.\w{2,6}$/", $email)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phone) || !preg_match("/^01[0-9]{9}$/", $phone)) {
        $errors[] = "Phone must be a valid Bangladeshi number (11 digits, starts with 01).";
    }

    if (empty($dob)) $errors[] = "Date of birth is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (empty($address)) $errors[] = "Address is required.";
    if (empty($country)) $errors[] = "Country is required.";
    $sql = "INSERT INTO user_info (uname, fname, email, phone, dob, gender, address, country)
            VALUES ('$uname', '$fname', '$email', '$phone', '$dob', '$gender', '$address', '$country')";

    if (mysqli_query($con, $sql)) {
        echo "<p style='color:green; text-align:center;'>✅ User added successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Error: " . mysqli_error($con) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add User</title>
<link rel="stylesheet" href="../../asset/css/addUser.css">
</head>
<body>
<form action="" method="POST" onsubmit="return validateForm()">
  <div class="container">
    <h2>Add New User</h2>
    <form method="POST">
      <label>Username</label>
      <input type="text" name="uname" required>

      <label>Full Name</label>
      <input type="text" name="name" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Phone</label>
      <input type="text" name="phone" required>

      <label>Date of Birth</label>
      <input type="date" name="dob">

      <label>Gender</label>
      <select name="gender">
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>

      <label>Address</label>
      <input type="text" name="address">

      <label>Country</label>
      <input type="text" name="country">

      <button type="submit">Add User</button>
    </form>
    <a href="a.php">⬅ Back to User List</a>
  </div>
  <script src="../../asset/js/addUser.js"></script>
</form>
</body>
</html>
