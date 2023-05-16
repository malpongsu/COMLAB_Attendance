<?php

// Database configuration
$db_host = 'localhost';
$db_user = 'rfid_admin';
$db_pass = 'rfid_system';
$db_name = 'raspberry_pi_rfid_system';

// Create database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check database connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

?>
