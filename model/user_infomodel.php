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
function sign_up($uname, $fname,$email, $pass, $phone, $dob, $gender, $address, $country, $imgName){

    $con = getConnection();

    $chk_username = "select * from user_info where uname = '$uname'";
    $chk_result = mysqli_query($con, $chk_username);


    //will use Ajax here to check if username exists or not
    if(mysqli_num_rows($chk_result)>0){
        return "exists";
    }


   $sql = "INSERT INTO user_info (uname, fname, email, password, phone, dob, gender, address, country, img_name )
            VALUES ('$uname', '$fname', '$email', '$pass', '$phone', '$dob', '$gender', '$address', '$country', '$imgName')";
    $result = mysqli_query($con, $sql);

    if($result){
        return true;
    }else{
        return false;
    }
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Profile Management~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function getUserInfo($username){

    $con = getConnection();

    $sql = "select * from user_info where uname = '$username'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        $userData = mysqli_fetch_assoc($result);
        return $userData;
    } else {
        return null; // User not found
    }

}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Profile Update~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function updateUserInfo($username, $fullname, $email, $phone, $gender, $address, $country, $img_name) {
    $con = getConnection(); 
    $sql = "UPDATE user_info 
            SET fname = '$fullname', email = '$email', phone = '$phone', gender = '$gender', 
            address = '$address', country = '$country', img_name = '$img_name' 
        WHERE uname = '$username'";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        return false;
    }
    return $result;
}

?>