<?php
session_start();
require_once('../../model/weatherHistory.php');

if (!isset($_COOKIE['status']) || !isset($_SESSION['username']) || !isset($_SESSION['uid'])) {
    header("Location: ../user_authentication/login.php");
    exit;
}

$uid = $_SESSION['uid'];
$searchCity = isset($_GET['city']) ? trim($_GET['city']) : '';
$weatherHistory = getUserWeatherHistory($uid, $searchCity);
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
        <form method="GET" style="margin-bottom: 20px;">
            <input type="text" name="city" placeholder="Search by city" value="<?php echo isset($_GET['city']) ? $_GET['city'] : ''; ?>">
            <button type="submit">Search</button>
        </form>
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
    
    <?php
if (!empty($weatherHistory)) {
    foreach ($weatherHistory as $row) {
        echo "<tr>";
        echo "<td>" . $row['city'] . "</td>";
        echo "<td>" . $row['temperature'] . "</td>";
        echo "<td>" . $row['humidity'] . "</td>";
        echo "<td>" . $row['pressure'] . "</td>";
        echo "<td>" . $row['wind_speed'] . "</td>";
        echo "<td>" . $row['timestamp'] . "</td>";
        echo "</tr>";
    }
} else {
    echo '<tr><td colspan="6" style="text-align:center;">No search history found.</td></tr>';
}
?>


        </table>
    </div>
    <script src="../../asset/js/location.js"></script>
</body>
</html>