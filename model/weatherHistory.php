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

    mysqli_close($con);
    return $history;
}
function getLastSearchedCity($username) {
    $defaultCity = 'Dhaka';

    $query = "SELECT city FROM userweatherview WHERE uname = ? ORDER BY timestamp DESC LIMIT 1";
    $conn = getConnection(); // You should have a function that returns the DB connection

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) return $defaultCity;

    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        if (!empty($data['city'])) {
            return $data['city'];
        }
    }

    return $defaultCity;
}

?>