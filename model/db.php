<?php
    $host = "localhost:3307";
    $dbname = "skysence";
    $dbuser = "root";
    $dbpass = "";

    function getConnection(){
        global $host;
        global $dbname;
        global $dbuser;
        global $dbpass;

        $con = mysqli_connect($host, $dbuser, $dbpass, $dbname);
        return $con;
    }
?>