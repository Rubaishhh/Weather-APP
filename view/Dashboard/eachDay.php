<?php
session_start();
if(!isset($_COOKIE['status']) || !isset($_SESSION['username'])) {
     header("Location: ../user_authentication/login.php");
    exit;
}
$username = $_SESSION['username'];

// Check if session data exists for the selected day
if (isset($_SESSION['selected_day'])) {
    $weatherData = $_SESSION['selected_day'];
} else {
    $weatherData = [
        'city' => 'Unknown',
        'date' => 'No Data',
        'iconCode' => '',
        'tempCelsius' => 'N/A',
        'feelsLike' => 'N/A',
        'description' => 'N/A',
        'humidity' => 'N/A',
        'pressureMb' => 'N/A',
        'windSpeedKph' => 'N/A'
    ];
}

$iconHTML = '';
if (!empty($weatherData['iconCode'])) {
    $iconURL = "https://openweathermap.org/img/wn/" . $weatherData['iconCode'] . "@2x.png";
    $iconHTML = '<img src="' . $iconURL . '" alt="Weather icon" id="weather-icon">';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forecast for <?= $weatherData['city'] ?> on <?= $weatherData['date'] ?></title>
    <link rel="stylesheet" href="../../asset/css/eachDay.css">
</head>
<body>
    <div class="container">
        <h1 id="welcome">Welcome, <?= $username ?>!</h1>
        <button onclick="window.location.href='../../controller/logout.php'" class="logout">Logout</button>
        <button onclick="window.location.href='../profile_management/profile_management.php'" class="profileMGT">Your Profile</button>

        <div class="top-section">
            <div class="location">
                <h1 id="city_name"><?= $weatherData['city'] ?></h1>
                <p id="date_time"><?= $weatherData['date'] ?></p>
            </div>
        </div>

        <div class="main-weather">
            <div class="temp">
                <h1 id="temperature"><?= $weatherData['tempCelsius'] ?>°C</h1>
                <p id="weather-description"><?= $weatherData['description'] ?></p>
            </div>
            <div class="icon-info">
                <?= $iconHTML ?>
                <ul>
                    <li id="feels-like">Feels like: <?= $weatherData['feelsLike'] ?>°C</li>
                    <li id="humidity">Humidity: <?= $weatherData['humidity'] ?>%</li>
                    <li id="wind">Wind Speed: <?= $weatherData['windSpeedKph'] ?> km/h</li>
                </ul>
            </div>
        </div>

        <div class="summary-widgets">
            <div class="widget-card">
                <h3>Temperature</h3>
                <p id="w-temp"><?= $weatherData['tempCelsius'] ?>°C</p>
            </div>
            <div class="widget-card">
                <h3>Wind speed</h3>
                <p id="w-wind"><?= $weatherData['windSpeedKph'] ?> km/h</p>
            </div>
            <div class="widget-card">
                <h3>Pressure</h3>
                <p id="w-pressure"><?= $weatherData['pressureMb'] ?> mb</p>
            </div>
            <div class="widget-card">
                <h3>Humidity</h3>
                <p id="w-humidity"><?= $weatherData['humidity'] ?>%</p>
            </div>
        </div>
    </div>
</body>
</html>
