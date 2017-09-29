<?php

/* 
 * This file contains config for the site - db conneection.
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sukulu";
$baseURL = "http://localhost/sukulu";

// Create connection
$conString = mysqli_connect($servername, $username, $password, $dbname);


// Check connection
if (!$conString) {
    die("Unable to connect to database: " . mysqli_connect_error());
}

?>