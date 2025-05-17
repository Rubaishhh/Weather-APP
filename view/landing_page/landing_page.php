<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../asset/css/landing.css">
    <title>Document</title>
</head>
<body>
  <div class="container">
    <h1>🌤 Simple Weather</h1>

    <input type="text" id="searchInput" placeholder="Enter city" />
    <button onclick="searchCity()">Search</button>

    <div id="result" class="weather-box"></div>

    <div class="links">
      <a href="../user_authentication/login.php">Login</a>
      <a href="../user_authentication/sign_up.php">Sign up</a>
    </div>
  </div>

  <script src="../../asset/js/landing.js"></script>
</body>
</html>