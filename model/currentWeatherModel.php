<?php
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

$sql = "INSERT INTO weather_logs (city, temperature, humidity, pressure, wind_speed, timestamp) 
        VALUES ('$city', '$temp', '$humidity', '$pressure', '$wind', NOW())";

 $result = mysqli_query($con, $sql);
if($result){
        echo "Saved";
    }else{
        echo "Error: " . $conn->error;
    }

$conn->close();
?>
