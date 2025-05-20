<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../user_authentication/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Alerts</title>
    <link rel="stylesheet" href="../../asset/css/weatherAlerts.css">
</head>
<body>
  <h1>⚠️ Weather Alert Inbox</h1>
  <div id="alertInbox">
    <p id="noAlerts">No alerts yet.</p>
  </div>

    <script src="../../asset/js/weatherAlerts.js"></script>
</body>
</html>