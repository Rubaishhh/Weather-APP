<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Weather App (No API)</title>
  <link rel="stylesheet" href="/css/dataExport.css" />
</head>
<body>

<h1>Weather App</h1>

<div class="box">
  <input type="text" id="cityInput" placeholder="Enter city" />
  <button onclick="getWeather()">Get Weather</button>
  <button onclick="getWeatherByLocation()">Use Current Location</button>
  <div id="weatherData"></div>
</div>

<div class="box">
  <h2>Export Weather Report</h2>
  <label>Start Date:</label>
  <input type="date" id="startDate" />
  <label>End Date:</label>
  <input type="date" id="endDate" />
  <label>Format:</label>
  <select id="format">
    <option value="csv">CSV</option>
    <option value="pdf">PDF</option>
  </select>
  <button onclick="exportData()">Download</button>
</div>

<script src="/js/dataExport.js"></script>

</body>
</html>
