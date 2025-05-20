<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../user_authentication/login.php");
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Weather App (No API)</title>
  <link rel="stylesheet" href="../../asset/css/dataExport.css" />
</head>
<body>


<h2 style="text-align:center;">🌦️ Weather App </h2>

<div class="box">
  <input type="text" id="cityInput" placeholder="Enter city name" />
  <button onclick="getWeatherByCity()">Get Weather</button>
  <button onclick="getWeatherByLocation()">Use Current Location</button>
  <div id="weatherData"></div>
</div>

<div class="box">
  <h3>📥 Export Forecast</h3>
  <label for="startDate">Select Date:</label>
  <input type="date" id="startDate" />
  <label for="format">Select Format:</label>
  <select id="format">
    <option value="csv">CSV</option>
    <option value="pdf">PDF</option>
  </select>
  <button onclick="downloadData()">Download</button>
</div>

<script src="../../asset/js/dataExport.js"></script>

</body>
</html>
