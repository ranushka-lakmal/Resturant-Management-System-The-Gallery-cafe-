<?php
// db_connection.php

// Database connection variables
$servername = "localhost"; // or your server name, usually "localhost"
$username = "root";         // your database username
$password = "";             // your database password, if any
$dbname = "res_booking"; // replace with your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

