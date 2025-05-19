<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sun & Moon Tracker</title>
  <link rel="stylesheet" href="../../asset/css/sunriseSunset.css">
</head>
<body>
  <h2>Sunrise/Sunset</h2>

<input type="text" id="cityName" placeholder="Enter city name" />
<button id="fetchWeatherBtn">Fetch Weather</button>


<div id="tabs" style="margin-top: 20px;">
  <button id="dayNightTabBtn">Day/Night</button>
  <button id="goldenHourTabBtn">Golden Hour</button>
  <button id="moonTabBtn">Moon Phase</button>
</div>

<div id="day-night" class="tab-content">
  <h3>Sunrise & Sunset</h3>
  <p>Sunrise: <span id="sunriseTime">--:--</span></p>
  <p>Sunset: <span id="sunsetTime">--:--</span></p>
</div>

<div id="golden-hour" class="tab-content">
  <h3>Golden Hour Times</h3>
  <p>Morning start: <span id="goldenMorningStart">--:--</span></p>
  <p>Morning end: <span id="goldenMorningEnd">--:--</span></p>
  <p>Evening start: <span id="goldenEveningStart">--:--</span></p>
  <p>Evening end: <span id="goldenEveningEnd">--:--</span></p>
</div>

<div id="moon" class="tab-content">
  <h3>Moonrise & Moonset</h3>
  <p>Moonrise: <span id="moonriseTime">--:--</span></p>
  <p>Moonset: <span id="moonsetTime">--:--</span></p>
</div>

  <script src="../../asset/js/sunriseSunset.js"></script>
</body>
</html>
