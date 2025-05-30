<?php
require_once('db.php');

function getAllUsers($search_term = '') {
    $con = getConnection();

    $sql = "SELECT uid, fname, email, phone, dob, gender, address, country FROM user_info";

    if ($search_term !== '') {
        $search_term_esc = mysqli_real_escape_string($con, $search_term);
        if (is_numeric($search_term_esc)) {
            $sql .= " WHERE uid = $search_term_esc OR fname LIKE '%$search_term_esc%'";
        } else {
            $sql .= " WHERE fname LIKE '%$search_term_esc%'";
        }
    }

    return mysqli_query($con, $sql);
}

function getAllMessages() {
    $con = getConnection();
    $sql = "SELECT full_name, email, subject, message FROM contact";
    return mysqli_query($con, $sql);
}
