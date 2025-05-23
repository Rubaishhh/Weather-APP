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
  <title>Weather Data Archive</title>
  <link rel="stylesheet" href="../../asset/css/historicalData.css">
</head>
<body>
  <div class="container">
    <h1>Weather Data Archive</h1>
    <div class="controls">
      <div class="control-group">
        <label for="location">Location</label>
        <input type="text" id="location" placeholder="Enter Location">
      </div>
      <div class="control-group">
        <label for="date">Select Date</label>
        <input type="date" id="date">
      </div>
      <div class="control-group">
        <label for="comparison">Comparison Tool</label>
        <select id="comparison">
          <option value="none">No Comparison</option>
          <option value="seasonal">Seasonal Average</option>
          <option value="record">Record High/Low</option>
        </select>
      </div>
      <button onclick="loadData()">Load Data</button>
    </div>

    <div class="comparison" id="comparison-container">
      <h2>Comparison Data</h2>
      <div class="message" id="comparison-message">No data available for display. Please contact admin for access.</div>
    </div>
  </div>

  <script src="../../asset/js/historicalData.js"></script>
</body>
</html>
