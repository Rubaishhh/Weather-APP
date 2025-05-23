<?php
session_start();
require_once("../model/db.php");
require_once("../model/user_infomodel.php");


$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") { //initially skipped, karon ekhono submit kori e nai
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

        $user = login_user($username, $password);
       

        if($user){
            $_SESSION['username'] = $user['uname'];
            $_SESSION['uid']= $user['uid'];
            setcookie("status", 'true', time()+3000, "/");
            setcookie("username", $user['uname'], time()+3000, "/");
            header("Location: ../view/Dashboard/dashboard.php");
        }else {
        $error_message = "Invalid username or password!";
        header("Location: ../view/user_authentication/login.php");
        }       
        exit;
}
?>