<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set content type to JSON
header('Content-Type: application/json');

// Include the database configuration file
require_once '../../dbconfig/db_config.php';

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to check if an email already exists
function email_exists($conn, $email) {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Function to insert a new user
function insert_user($conn, $name, $email, $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'customer'; // Default role for new registrations

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "All fields are required"]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format"]);
        exit;
    }

    // Check if email exists and handle registration logic
    if (email_exists($conn, $email)) {
        echo json_encode(["status" => "error", "message" => "Email already exists"]);
    } else {
        $result = insert_user($conn, $name, $email, $password);
        if ($result) {
            echo json_encode(["status" => "success", "message" => "Registration successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error inserting user"]);
        }
    }
    $conn->close();
    exit;
}

// Default response for unsupported requests
http_response_code(405);
echo json_encode(["status" => "error", "message" => "Invalid request method"]);
exit;
?>
