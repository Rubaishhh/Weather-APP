<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="../../asset/css/landing.css" />
  <title>Simple Weather</title>
</head>
<body>
  <div class="container">
      <div class="logo">
        <img src="../../asset/images and icons/Skysence_logo.png" alt="Logo" />
      </div>
    <div class="input-group">
      <input type="text" id="searchInput" placeholder="Enter city" />
      <button onclick="searchCity()">Search</button>
    </div>

    <div id="result" class="weather-box">
    
    </div>

      <div class="bottom-message">
        <p>🔐 Want more features? <a href="../user_authentication/sign_up.php">Sign up</a> now!</p>
        <p>Already have an account? <a href="../user_authentication/login.php">Log in here</a>.</p>
    </div>
  </div>

  <script src="../../asset/js/landing.js"></script>
</body>
</html>
