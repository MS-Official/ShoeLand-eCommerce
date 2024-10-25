<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | ShoeLand</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        /* Light mode styles */
        body {
            margin: 0;
            background-color: #f7f7f7;
            color: black;
        }

        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        input {
            border: 1px solid #ddd;
            background-color: white;
        }

        button {
            background-color: #ff5733;

        }

        footer {
            background-color: #333;
            color: #fff;
        }

        /* Dark mode styles */
        .dark-mode {
            background-color: #121212; /* Dark background */
            color: #ffffff; /* Light text */
        }

        .dark-mode header {
            background-color: black;
        }

        .dark-mode input {
            border: 1px solid #444; /* Darker border */
            background-color: #333; /* Dark input background */
            color: #fff; /* Light text */
        }

        .dark-mode input::placeholder {
            color: #bbb; /* Light placeholder */
        }

        .dark-mode button {
            background-color: #ff5733; /* Same button color */
            
        }

        .dark-mode footer {
            background-color: #1e1e1e; /* Dark footer */
            color: #bbb; /* Lighter footer text */
        }

        .dark-mode a {
            color: #ff5733; /* Same link color */
        }
    </style>
</head>

<body>

    <script>
        // Function to toggle the theme between light and dark mode
        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
        }
    </script>

     <!-- Import header -->
    <?php include '../includes/header.php'; ?>

    <div style="max-width: 400px; margin: 100px auto; padding: 90px;  border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); text-align: center;">
        <h2 style="color: #ff5733; margin-bottom: 20px;">Register to Shoe Land</h2>

        <!-- Username Input -->
        <div style="position: relative; margin-bottom: 20px;">
            <i class="fas fa-user" style="position: absolute; left: 10px; top: 10px; color: #ff5733;"></i>
            <input type="text" placeholder="Username" required style="width: 80%; padding: 10px 40px; border-radius: 8px; font-size: 1.1rem; transition: border 0.3s; outline: none;"
                onfocus="this.style.borderColor='#ff5733'" onblur="this.style.borderColor=''" />
        </div>

        <!-- Password Input -->
        <div style="position: relative; margin-bottom: 20px;">
            <i class="fas fa-lock" style="position: absolute; left: 10px; top: 10px; color: #ff5733;"></i>
            <input type="password" placeholder="Password" required style="width: 80%; padding: 10px 40px; border-radius: 8px; font-size: 1.1rem; transition: border 0.3s; outline: none;"
                onfocus="this.style.borderColor='#ff5733'" onblur="this.style.borderColor=''" />
        </div>

         <!-- Password Input -->
         <div style="position: relative; margin-bottom: 20px;">
            <i class="fas fa-lock" style="position: absolute; left: 10px; top: 10px; color: #ff5733;"></i>
            <input type="password" placeholder="Confirm Password" required style="width: 80%; padding: 10px 40px; border-radius: 8px; font-size: 1.1rem; transition: border 0.3s; outline: none;"
                onfocus="this.style.borderColor='#ff5733'" onblur="this.style.borderColor=''" />
        </div>

        <!-- Register or Submit Button -->
        <button type="submit"
            style="width: 100%; padding: 10px; color: white; font-size: 1.2rem; border: none; border-radius: 8px; cursor: pointer; transition: background 0.3s ease; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);"
            onmouseover="this.style.backgroundColor='#ff7849'"
            onmouseout="this.style.backgroundColor='#ff5733'">Register</button>

        <!-- Footer -->
        <p style="margin-top: 20px; font-size: 0.9rem; opacity: 0.7;">Already have an account? <a href="login.php"
                style="color: #ff5733; text-decoration: none;">Sign In</a></p>
    </div>

    <!-- Footer Section -->
    <!-- Import footer -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>


<?php
// Include database connection
include('db_connect.php');

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user details into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
