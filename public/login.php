<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Shoe Land</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../css/darkmode.css">
    <script src="../js/darkmode.js" defer></script>
    <style>
        /* Light mode styles */
        body {
            margin: 0;
            background-color: #f7f7f7;
            color: black;
        }

        input {
            border: 1px solid #ddd;
            background-color: white;
        }

        button {
            background-color: #ff5733;
        }

        /* Dark mode styles */
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .dark-mode header {
            background-color: black;
        }

        .dark-mode input {
            border: 1px solid #444;
            background-color: #333;
            color: #fff;
        }

        .dark-mode input::placeholder {
            color: #bbb;
        }

        .dark-mode button {
            background-color: #ff5733;
        }

        .dark-mode a {
            color: #ff5733;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include '../includes/header.php'; ?>

    <div id="loginForm" style="display: none;">

        <div
            style="max-width: 500px; margin: 100px auto; padding: 70px;  border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); text-align: center;">
            <h2 style="color: #ff5733; margin-bottom: 20px;">Login to Shoe Land</h2>

            <!-- Username Input -->
            <div style="position: relative; margin-bottom: 20px;">
                <i class="fas fa-user" style="position: absolute; left: 10px; top: 10px; color: #ff5733;"></i>
                <input id="username" type="text" placeholder="Username" required
                    style="width: 80%; padding: 10px 40px; border-radius: 8px; font-size: 1.1rem; transition: border 0.3s; outline: none;"
                    onfocus="this.style.borderColor='#ff5733'" onblur="this.style.borderColor=''" />
            </div>

            <!-- Password Input -->
            <div style="position: relative; margin-bottom: 20px;">
                <i class="fas fa-lock" style="position: absolute; left: 10px; top: 10px; color: #ff5733;"></i>
                <input id="password" type="password" placeholder="Password" required
                    style="width: 80%; padding: 10px 40px; border-radius: 8px; font-size: 1.1rem; transition: border 0.3s; outline: none;"
                    onfocus="this.style.borderColor='#ff5733'" onblur="this.style.borderColor=''" />
            </div>

            <!-- Login Button -->
            <button id="loginBtn"
                style="width: 100%; padding: 10px; color: white; font-size: 1.2rem; border: none; border-radius: 8px; cursor: pointer; transition: background 0.3s ease; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);"
                onmouseover="this.style.backgroundColor='#ff7849'"
                onmouseout="this.style.backgroundColor='#ff5733'">Login</button>

            <!-- Footer -->
            <p style="margin-top: 20px; font-size: 0.9rem; opacity: 0.7;">Don't have an account? <a href="register.php"
                    style="color: #ff5733; text-decoration: none;">Sign Up</a></p>
        </div>

    </div>


    <div id="userInfo" style="display: none;">
        <!-- User info will be dynamically rendered here -->
    </div>

    <!-- Footer Section -->
    <?php include '../includes/footer.php'; ?>

    <!-- External JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script src="../handlers/loginHandler/login.js" defer></script>
</body>

</html>