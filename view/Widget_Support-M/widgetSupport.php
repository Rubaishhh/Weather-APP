<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Widgets</title>
    <link rel="stylesheet" href="../../asset/css/widgetSupport.css">
</head>
<body>
     <h1> Weather Widget Gallery</h1>

  <div class="controls">
    <input type="text" id="cityInput" placeholder="Enter city name" />
    <button onclick="addWidget()">Add Widget</button>
  </div>

  <div class="styles">
    <strong>Choose Size:</strong>
    <label><input type="radio" id="sizeSmall" name="size" value="small" checked /> Small</label>
    <label><input type="radio" id="sizeMedium" name="size" value="medium" /> Medium</label>
    <label><input type="radio" id="sizeLarge" name="size" value="large" /> Large</label>
  </div>

  <div class="customization">
    <strong>Customize Data:</strong><br />
    <label><input type="checkbox" id="showTemp" checked /> Temperature</label>
    <label><input type="checkbox" id="showCond" checked /> Condition</label>
    <label><input type="checkbox" id="showHumid" checked /> Humidity</label>
    <label><input type="checkbox" id="showWind" checked /> Wind Speed</label>
  </div>

  <div id="widgetGallery"></div>

<script src="../../asset/js/widgetSupport.js"></script>
</body>
</html>