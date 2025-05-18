<?php
require_once('db.php');





//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~LOGIN~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function login_user($username, $password){

    $con = getConnection();

    $sql = "select * from user_info where uname = '$username' and password = '$password'";
    $result = mysqli_query($con, $sql);

    if($result && mysqli_num_rows($result)===1){
        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    return false;
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~SIGN UP~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function sign_up($uname, $fname,$email, $hashedPassword, $phone, $dob, $gender, $address, $country){

    $con = getConnection();

    $chk_username = "select * from user_info where uname = '$uname'";
    $chk_result = mysqli_query($con, $chk_username);

    if(mysqli_num_rows($chk_result)>0){
        return "exists";
    }


   $sql = "INSERT INTO user_info (uname, fname, email, password, phone, dob, gender, address, country)
            VALUES ('$uname', '$fname', '$email', '$hashedPassword', '$phone', '$dob', '$gender', '$address', '$country')";
    $result = mysqli_query($con, $sql);

    if($result){
        return true;
    }else{
        return false;
    }
}


?>