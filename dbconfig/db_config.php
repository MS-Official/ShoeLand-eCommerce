
<?php
// <!-- db_config.php -->

// Enable error reporting for development (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log errors to a file for better tracking (optional, especially useful in production)
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/db_errors.log');

// Database configuration
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "shoeland_db";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>