<?php
require_once("db.php");

function login_admin($username, $password) {

    $con = getConnection();

    $sql = "SELECT * FROM admintable WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql); // returns object

    if ($result && mysqli_num_rows($result) === 1) {
        $admin = mysqli_fetch_assoc($result); // associative array
        return $admin;
    }

    return false;
}
?>
