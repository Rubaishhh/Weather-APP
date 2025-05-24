<?php
session_start();
require_once('../../model/weatherHistory.php');

if (!isset($_COOKIE['status']) || !isset($_SESSION['username']) || !isset($_SESSION['uid'])) {
    header("Location: ../user_authentication/login.php");
    exit;
}


$uid = $_SESSION['uid'];
$weatherHistory = getUserWeatherHistory($uid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Locations</title>
    <link rel="stylesheet" href="../../asset/css/saved_location.css">
</head>
<body>
    <div class="container">
   <!-- Search History Table -->
        <h2>Search History</h2>
        <table class="history-table">
            <thead>
                <tr>
                    <th>City</th>
                    <th>Temperature (°C)</th>
                    <th>Humidity (%)</th>
                    <th>Pressure (mb)</th>
                    <th>Wind Speed (km/h)</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
    <tbody>
    <?php if (!empty($weatherHistory)): ?>
        <?php foreach ($weatherHistory as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['city']) ?></td>
                <td><?= htmlspecialchars($row['temperature']) ?></td>
                <td><?= htmlspecialchars($row['humidity']) ?></td>
                <td><?= htmlspecialchars($row['pressure']) ?></td>
                <td><?= htmlspecialchars($row['wind_speed']) ?></td>
                <td><?= htmlspecialchars($row['timestamp']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No search history found.</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
    </div>
    <script src="../../asset/js/location.js"></script>
</body>
</html>