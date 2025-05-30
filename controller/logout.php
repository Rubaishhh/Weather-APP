<?php
    session_start();
    session_destroy();
    setcookie('status', 'true', time()-10, '/');
    setcookie('username', '', time()-10, '/');
    header('location: ../view/user_authentication/login.php');

?>