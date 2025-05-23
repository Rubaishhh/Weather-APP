<?php
session_start();
if (!isset($_SESSION['uid'])) {
    die("User ID not set in session");
}
$uid = $_SESSION['uid'];
require_once('db.php');

$con = getConnection();

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// $city = $_POST['city'];
// $temp = $_POST['temp'];
// $humidity = $_POST['humidity'];
// $pressure = $_POST['pressure'];
// $wind = $_POST['wind'];
$jsonData = $_POST['json'];
$info = json_decode($jsonData);


if (!isset($info->city, $info->temp, $info->humidity, $info->pressure, $info->wind)) {
    die("Missing fields in JSON data");
}

$city = $info->city;
$temp = $info->temp;
$humidity = $info->humidity;
$pressure = $info->pressure;
$wind = $info->wind;
        echo "<script>alert(before sql);</script>";

$sql = "INSERT INTO weather_logs (uid ,city, temperature, humidity, pressure, wind_speed, timestamp) 
        VALUES ('$uid','$city', '$temp', '$humidity', '$pressure', '$wind', NOW())";
        echo "<script>alert(\"SQL Query: $sql\");</script>";


 $result = mysqli_query($con, $sql);
if($result){
        echo "Saved sql cholse";
    }else{
        echo "Error: " . $con->error;
    }

$con->close();
?>
