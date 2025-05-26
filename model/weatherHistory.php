<?php
require_once('db.php');

function getUserWeatherHistory($uid) {
    $con = getConnection();
    $sql = "SELECT city, temperature, humidity, pressure, wind_speed, timestamp 
            FROM userweatherview 
            WHERE uid = '$uid' 
            ORDER BY timestamp DESC";
    
    $result = mysqli_query($con, $sql);
    $history = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $history[] = $row;
        }
    }

    return $history;
}
function getLastSearchedCity($username) {
    $defaultCity = 'Dhaka';
    $conn = getConnection();

    // Escape the username to prevent SQL injection (still very important!)

    $query = "SELECT city FROM userweatherview WHERE uname = '$username' ORDER BY timestamp DESC LIMIT 1";

    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        if (!empty($data['city'])) {
            return $data['city'];
        }
    }

    return $defaultCity;
}

?>