<?php
session_start();

if (isset($_POST['selectedData'])) {
    // Decode the stringified JSON
    $data = json_decode($_POST['selectedData'], true);

    if ($data) {
        $_SESSION['selected_day'] = $data;
        //echo "Data saved";
    } else {
        http_response_code(400);
        echo "Invalid JSON data";
    }
} else {
    http_response_code(400);
    echo "No data received";
}
?>