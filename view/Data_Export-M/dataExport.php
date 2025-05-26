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
  <title>Weather App</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
 
  <link rel="stylesheet" href="../../asset/css/dataExport.css" />
</head>
<body>


<h2 style="text-align:center;">🌤️ Simple Weather App</h2>
<form method="POST">
<div class="box">
  <input type="text" id="cityInput" name="cityInput" placeholder="Enter city name" />
  <button type="button" onclick="getWeatherByCity()">Get Weather</button>
  <button type="button" onclick="getWeatherByLocation()">Use Current Location</button>
  <div id="weatherData" class="result"></div>
</div>
</form>

<div class="box">
  <h3>📥 Export Weather</h3>
  <select id="format">
    <option value="csv">CSV</option>
    <option value="pdf">PDF</option>
  </select>
  <button type="button" onclick="downloadData()">Download</button>
</div>



<script src="../../asset/js/dataExport.js"></script>

</body>
</html>
