<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';  // Default MySQL username in XAMPP is 'root'
$db_pass = '';      // Default password for MySQL in XAMPP is an empty string
$db_name = 'auth_system';

// Create database connection
$conn = new mysqli($db_host , $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    // Improved error handling: Detailed error message and exit script
    die("Connection failed: " . $conn->connect_error);
}

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
