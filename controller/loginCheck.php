<?php
session_start();
require_once("../model/db.php");
require_once("../model/user_infomodel.php");


$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $remember = isset($_POST['remember']);

        $user = login_user($username, $password);
       

        if($user){
            $_SESSION['username'] = $user['uname'];
            $_SESSION['uid']= $user['uid'];

            $cookie_duration = $remember ? (time() + (86400 * 30)) : (time() + 3600); // 30 din or 1 hour
            setcookie("status", "true", $cookie_duration, "/");
            setcookie("username", $username, $cookie_duration, "/");
            header("Location: ../view/Dashboard/dashboard.php");
        }else {
        $error_message = "Invalid username or password!";
        header("Location: ../view/user_authentication/login.php?error=" .$error_message);
        }       
        exit;
}
?>