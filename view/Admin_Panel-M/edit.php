<?php
require_once('../../model/db.php'); // Adjust path as needed
$con = getConnection();

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "No user ID provided.";
    exit;
}

// Fetch user info by ID
$sql = "SELECT * FROM user_info WHERE uid = $id";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found.";
    exit;
}

// Update user if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname   = $_POST['fname'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $dob     = $_POST['dob'];
    $gender  = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];

    $errors = [];

    if (empty($fname)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    } elseif (strlen($phone) !== 11 || !ctype_digit($phone)) {
        $errors[] = "Phone number must be exactly 11 digits.";
    }

    if (empty($dob)) $errors[] = "Date of birth is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (empty($address)) $errors[] = "Address is required.";
    if (empty($country)) $errors[] = "Country is required.";

    if (empty($errors)) {
        $updateSql = "UPDATE user_info SET 
                        fname='$fname', 
                        email='$email', 
                        phone='$phone', 
                        dob='$dob', 
                        gender='$gender', 
                        address='$address', 
                        country='$country'
                      WHERE uid=$id";

        if (mysqli_query($con, $updateSql)) {
            echo "<p style='color:green;'>User updated successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error updating: " . mysqli_error($con) . "</p>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>❌ $error</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: auto; padding: 20px; }
        input, select { width: 100%; padding: 8px; margin: 6px 0; }
        button { padding: 10px 15px; background: rgb(0, 123, 255); color: #fff; border: none; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>Edit User</h2>

<form method="POST">
    <label>Full Name:</label>
    <input type="text" name="fname" value="<?= htmlspecialchars($user['fname']) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>

    <label>Date of Birth:</label>
    <input type="date" name="dob" value="<?= htmlspecialchars($user['dob']) ?>" required>

    <label>Gender:</label>
    <select name="gender" required>
        <option value="">--Select--</option>
        <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <label>Address:</label>
    <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>

    <label>Country:</label>
    <input type="text" name="country" value="<?= htmlspecialchars($user['country']) ?>" required>

    <button type="submit">Update</button>
</form>

<p><a href="adminPanel.php">← Back to User List</a></p>

</body>
</html>
