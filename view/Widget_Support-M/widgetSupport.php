<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../user_authentication/login.php");
    exit();
}
$cityError = "";
$city = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $city = trim($_POST["city"]);
  if (empty($city)) {
    $cityError = "City name is required.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Weather Widget Gallery</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background: linear-gradient(to right, rgb(135, 206, 250), rgb(255, 228, 225));
      min-height: 100vh;
    }

    h1 {
      text-align: center;
      color: rgb(40, 40, 40);
      margin-bottom: 30px;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    }

    .controls, .styles, .customization {
      text-align: center;
      margin-bottom: 15px;
    }

    input[type="text"] {
      padding: 10px;
      width: 220px;
      border: 1px solid #aaa;
      border-radius: 6px;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-top: 5px;
    }

    button {
      padding: 10px 14px;
      background-color: rgb(0, 123, 255);
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: rgb(0, 100, 210);
    }

    label {
      margin: 0 8px;
      font-size: 14px;
    }

    #widgetGallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
    }

    .widget {
      background: rgb(255, 255, 255);
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 16px;
      transition: transform 0.3s ease;
    }

    .widget:hover {
      transform: scale(1.03);
    }

    .widget h3 {
      margin-top: 0;
      color: rgb(33, 37, 41);
    }

    .data div {
      margin: 6px 0;
      font-size: 15px;
    }

    .small { width: 180px; background: rgb(255, 255, 240); }
    .medium { width: 250px; background: rgb(240, 255, 255); }
    .large { width: 320px; background: rgb(245, 245, 255); }
  </style>
</head>
<body>

  <h1>🌦️ Weather Widget Gallery</h1>

  <div class="controls">
    <form method="POST" action="">
      <input type="text" name="city" id="cityInput" placeholder="Enter city name" value="<?php echo htmlspecialchars($city); ?>">
      <button type="button" onclick="addWidget()">Add Widget</button>
      <div class="error"><?php echo $cityError; ?></div>
    </form>
  </div>

  <div class="styles">
    <strong>Choose Size:</strong>
    <label><input type="radio" id="sizeSmall" name="size" value="small" checked> Small</label>
    <label><input type="radio" id="sizeMedium" name="size" value="medium"> Medium</label>
    <label><input type="radio" id="sizeLarge" name="size" value="large"> Large</label>
  </div>

  <div class="customization">
    <strong>Customize Data:</strong><br>
    <label><input type="checkbox" id="showTemp" checked> Temperature</label>
    <label><input type="checkbox" id="showCond" checked> Condition</label>
    <label><input type="checkbox" id="showHumid" checked> Humidity</label>
    <label><input type="checkbox" id="showWind" checked> Wind Speed</label>
  </div>

  <div id="widgetGallery"></div>

  <script>
    function addWidget() {
      const cityInput = document.getElementById("cityInput").value.trim();
      if (cityInput === "") {
        alert("Please enter a city name.");
        return;
      }

      const apiKey = "29f608cad39dc1b3b89b3df31040bb39";
      const apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=" + cityInput + "&appid=" + apiKey + "&units=metric";

      fetch(apiUrl)
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
          if (data.cod !== 200) {
            alert("City not found.");
            return;
          }
          createWidget(data);
        })
        .catch(function() {
          alert("Error fetching weather data.");
        });
    }

    function createWidget(data) {
      let size = "small";
      if (document.getElementById("sizeMedium").checked) {
        size = "medium";
      } else if (document.getElementById("sizeLarge").checked) {
        size = "large";
      }

      const showTemp = document.getElementById("showTemp").checked;
      const showCond = document.getElementById("showCond").checked;
      const showHumid = document.getElementById("showHumid").checked;
      const showWind = document.getElementById("showWind").checked;

      let widgetHTML = '<div class="widget ' + size + '">';
      widgetHTML += '<h3>' + data.name + ', ' + data.sys.country + '</h3>';
      widgetHTML += '<div class="data">';

      if (showTemp) {
        widgetHTML += '<div><strong>Temperature:</strong> ' + data.main.temp + '°C</div>';
      }
      if (showCond) {
        widgetHTML += '<div><strong>Condition:</strong> ' + data.weather[0].main + '</div>';
      }
      if (showHumid) {
        widgetHTML += '<div><strong>Humidity:</strong> ' + data.main.humidity + '%</div>';
      }
      if (showWind) {
        widgetHTML += '<div><strong>Wind Speed:</strong> ' + data.wind.speed + ' m/s</div>';
      }

      widgetHTML += '</div></div>';

      const gallery = document.getElementById("widgetGallery");
      gallery.innerHTML += widgetHTML;
    }
  </script>

</body>
</html>
