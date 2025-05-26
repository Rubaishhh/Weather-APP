<?php
require_once('../../model/db.php');
$con = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $errors = [];

    if (empty($full_name)) {
        $errors[] = "Full name is required.";
    } 
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO contact (full_name, email, subject, message)
                VALUES ('$full_name', '$email', '$subject', '$message')";

        if (mysqli_query($con, $sql)) {
            echo "<p style='color:green; text-align:center;'>✅ Message sent successfully!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>❌ Error: " . mysqli_error($con) . "</p>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red; text-align:center;'>❌ $error</p>";
        }
    }
}
?>
