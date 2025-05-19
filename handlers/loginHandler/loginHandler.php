<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the response content type to JSON
header('Content-Type: application/json');

// Include the database configuration file
require_once '../../dbconfig/db_config.php'; 

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check user credentials and fetch email and role
function verify_login($conn, $name, $password) {
    // Fetch password, email, and role from the database
    $stmt = $conn->prepare("SELECT password, email, role FROM users WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    // Initialize variables to avoid warnings
    $hashed_password = null;
    $email = null;
    $role = null;

    // Check if user exists
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_password, $email, $role);
        $stmt->fetch();

        if ($hashed_password !== null && password_verify($password, $hashed_password)) {
            return [
                "email" => $email,
                "role" => $role,
                "name" => $name
            ]; // Return email, role, and name on successful login
        }
    }

    $stmt->close();
    return false;
}

// Main login logic
try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = sanitize_input($_POST['username'] ?? '');
        $password = sanitize_input($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "All fields are required"]);
            exit;
        }

        $user_data = verify_login($conn, $username, $password);
        if ($user_data) {
            echo json_encode([
                "status" => "success",
                "message" => "Login successful!",
                "email" => $user_data["email"],
                "name" => $user_data["name"],
                "role" => $user_data["role"] 
            ]);
        } else {
            // Login failed, return error message
            echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "An error occurred: " . $e->getMessage()]);
}

// Close database connection
$conn->close();
?>