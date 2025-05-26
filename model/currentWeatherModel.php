<?php
require_once('db.php');
session_start();
if (!isset($_SESSION['uid'])) {
    header("Location: ../view/user_authentication/login.php");
    exit();
}
$uid = $_SESSION['uid'];


$con = getConnection();

// $city = $_POST['city'];
// $temp = $_POST['temp'];
// $humidity = $_POST['humidity'];
// $pressure = $_POST['pressure'];
// $wind = $_POST['wind'];
$jsonData = $_POST['json'];
$info = json_decode($jsonData);//making php obj


if (!isset($info->city, $info->temp, $info->humidity, $info->pressure, $info->wind)) {
    header("Location: ../view/user_authentication/login.php");
    exit();
}

$city = $info->city;
$temp = $info->temp;
$humidity = $info->humidity;
$pressure = $info->pressure;
$wind = $info->wind;

$sql = "INSERT INTO weather_logs (uid ,city, temperature, humidity, pressure, wind_speed, timestamp) 
        VALUES ('$uid','$city', '$temp', '$humidity', '$pressure', '$wind', NOW())";
        //echo "<script>alert(\"SQL Query: $sql\");</script>";


 $result = mysqli_query($con, $sql);
if($result){
        echo "Saved sql cholse";
    }else{
        echo "Error: " . $con->error;
    }

?>
