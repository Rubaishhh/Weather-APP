<?php
session_start();

if(!isset($_COOKIE['status']) || !isset($_SESSION['username'])) {
    header("Location: ../user_authentication/login.php");
    exit;
}

$username = $_SESSION['username'];
require_once('../../model/adminModel.php');

// Handle AJAX Search
if (isset($_GET['ajax']) && $_GET['ajax'] == "1") {
    $search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
    $result = getAllUsers($search_term);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['uid']}</td>";
        echo "<td>{$row['fname']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['dob']}</td>";
        echo "<td>{$row['gender']}</td>";
        echo "<td>{$row['address']}</td>";
        echo "<td>{$row['country']}</td>";
        echo "<td>
                <a class='action-btn edit-btn' href='edit.php?id={$row['uid']}'>Edit</a>
                <a class='action-btn delete-btn' href='delete.php?id={$row['uid']}' onclick='return confirm(\"Are you sure to delete this user?\");'>Delete</a>
              </td>";
        echo "</tr>";
    }
    exit();
}

// Regular Load
$users = getAllUsers();
$messages = getAllMessages();
