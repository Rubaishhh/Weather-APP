<?php
require_once('db.php');

function sign_up($uname, $fname,$email, $hashedPassword, $phone, $dob, $gender, $address, $country){

    $con = getConnection();
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