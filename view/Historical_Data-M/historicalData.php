<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../user_authentication/login.php");
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Weather App</title>
  <link rel="stylesheet" href="../../asset/css/historicalData.css">
</head>
<body>
 <h2>Historical Weather </h2>
<label>City:</label>
<input type="text" id="cityInput" placeholder="e.g. Dhaka">
<label>Start Date:</label>
<input type="date" id="startDate">
<label>End Date:</label>
<input type="date" id="endDate">
<button onclick="lookupWeather()">Lookup</button>
<div id="error" style="color:red"></div>

<table id="weatherTable" style="display:none;">
  <thead>
    <tr>
      <th>Date</th>
      <th>Max Temp (°C)</th>
      <th>Min Temp (°C)</th>

    </tr>
  </thead>
  <tbody id="weatherBody"></tbody>
</table>

<div id="seasonalSummary"></div>

  <script src="../../asset/js/historicalData.js"></script>
</body>
</html>
