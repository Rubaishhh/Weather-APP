<?php
require_once('../../model/db.php'); // Adjust the path as needed
$con = getConnection();

// Get the user ID from the URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "No user ID provided.";
    exit;
}

// Delete the user from the database
$sql = "DELETE FROM user_info WHERE uid = $id";
$result = mysqli_query($con, $sql);

if ($result) {
    // Redirect to user list after successful deletion
    header("Location: adminPanel.php?msg=deleted");
    exit;
} else {
    echo "Error deleting user: " . mysqli_error($con);
}
?>
