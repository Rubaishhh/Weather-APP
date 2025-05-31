<?php
session_start();
require_once("../model/db.php");
require_once("../model/user_infomodel.php");
require_once("../model/adminlogin.php");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $remember = isset($_POST['remember']);

    //~~~~~~~~~~~~~~Munnas Part~~~~~~~~~~~~~
    $admin = login_admin($username, $password);

    if ($admin) {
        $_SESSION['admin_username'] = $admin['username'];
        $cookie_duration = $remember ? (time() + (86400 * 30)) : (time() + 600);
        setcookie("status", "true", $cookie_duration, "/");
        setcookie("username", $username, $cookie_duration, "/");
        header("Location: ../view/Admin_Panel-M/adminPanel.php");
        exit;
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    $user = login_user($username, $password);

    if ($user) {
        $_SESSION['username'] = $user['uname'];
        $_SESSION['uid'] = $user['uid'];
        $cookie_duration = $remember ? (time() + (86400 * 30)) : (time() + 3600);
        setcookie("status", "true", $cookie_duration, "/");
        setcookie("username", $username, $cookie_duration, "/");
        header("Location: ../view/Dashboard/dashboard.php");
    } else {
        $error_message = "Invalid username or password!";
        header("Location: ../view/user_authentication/login.php?error=" . $error_message);
    }

    exit;
}
?>
