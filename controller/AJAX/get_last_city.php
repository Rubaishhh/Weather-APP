<?php
session_start();
require_once("../../model/db.php");
require_once("../../model/weatherHistory.php");

if(!isset($_COOKIE['status']) || !isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $city = getLastSearchedCity($username);
    echo json_encode(['status' => 'success', 'city' => $city]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
}
?>
