<?php
session_start();
if(!isset($_COOKIE['status']) || !isset($_SESSION['username'])) {
     header("Location: ../user_authentication/login.php");
    exit;
  }
  $username = $_SESSION['username'];
  //$uid = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../asset/css/dashboard.css">
</head>
<body>
    <div class="container">
        <h1 id="welcome">Welcome, <?php echo $username; ?>!</h1>
        <button onclick="window.location.href='../../controller/logout.php'" class="logout">
          Logout
        </button>
        <button onclick="window.location.href='../profile_management/profile_management.php'" class="profileMGT">
          Your Profile
        </button>

        <!--for the location, date and time, search box-->
        <div class="top-section">
              <div class="location">
                <h1 id="city_name">City</h1>
                <p id="date_time">Date | Time</p>
              </div>

              <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Enter city name" />
                <button onclick="searchCity()">Search</button>
              </div>

        </div>
        <div class="main-weather">
          <div class="temp">
            <h1 id="temperature">--°C</h1>
            <p id="weather-description">Weather</p>
          </div>
          <div class="icon-info">
            <img id="weather-icon" src="" alt="Weather Icon" />
            <ul>
              <li id="feels-like">Feels like: --°C</li>
              <li id="humidity">Humidity: --%</li>
              <li id="wind">Wind: -- km/h</li>
            </ul>
          </div>
        </div>
<!--details in widg-->
<div class="summary-widgets">
    <div class="widget-card clickable" onclick="toggleTemp()">
      <h3>Temparature</h3>
      <p id="w-temp">--°C</p>
    </div>
    <div class="widget-card clickable" onclick="toggleWind()">
      <h3>Wind speed</h3>
      <p id="w-wind">-- km/h</p>
    </div>
    <div class="widget-card clickable" onclick="togglePressure()">
      <h3>Pressure</h3>
      <p id="w-pressure">-- mb</p>
    </div>
    <div class="widget-card">
      <h3>Humidity</h3>
      <p id="w-humidity">--%</p>
    </div>
  </div>
        <!--5 day forecast-->
        <section id="forecast">
            <h2>5 Day Forecast</h2>
            <div class="forecast">
                <div class="forecast-card clickable" id="day1" onclick="showForecastModal(1)"></div>
                <div class="forecast-card clickable" id="day2" onclick="showForecastModal(2)"></div>
                <div class="forecast-card clickable" id="day3" onclick="showForecastModal(3)"></div>
                <div class="forecast-card clickable" id="day4" onclick="showForecastModal(4)"></div>
                <div class="forecast-card clickable" id="day5" onclick="showForecastModal(5)"></div>
            </div>
        </section>

        <div id="forecast-modal" class="modal">
    <div class="modal-content">
        <h2 id="modal-date">Day</h2>
        <img id="modal-icon" src="" alt="Weather Icon" />
        <p id="modal-temp">Temperature: --°C</p>
        <p id="modal-description">Description: --</p>
        <p id="modal-humidity">Humidity: --%</p>
        <p id="modal-wind">Wind: -- km/h</p>
        <p id="modal-pressure">Pressure: -- mb</p>
    </div>
</div>
</div>
    
      <script src="../../asset/js/dashboard.js"></script>
</body>
</html>