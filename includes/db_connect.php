<?php 
    // Database connection
    $servername = "127.0.0.1:8889";
    $username = "root";
    $password = "root";
    $dbname = "shoeland_db";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>