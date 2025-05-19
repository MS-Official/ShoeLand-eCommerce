<?php
// header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoe Land</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }
        
        .header {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1rem 5%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
        }
        
        .logo img {
            height: 60px;
            margin-right: 10px;
        }
        
        .logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
        }
        
        .nav-item {
            margin-left: 1.5rem;
        }
        
        .nav-link {
            color: #333;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: #4ecdc4;
        }
        
        .hamburger {
            display: none;
            cursor: pointer;
        }
        
        .hamburger .line {
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
            transition: all 0.3s ease;
        }
        
        @media screen and (max-width: 768px) {
            .nav-menu {
                position: fixed;
                left: -100%;
                top: 70px;
                flex-direction: column;
                background-color: #fff;
                width: 100%;
                text-align: center;
                transition: 0.3s;
                box-shadow: 0 10px 27px rgba(0, 0, 0, 0.05);
            }
            
            .nav-menu.active {
                left: 0;
            }
            
            .nav-item {
                margin: 2.5rem 0;
            }
            
            .hamburger {
                display: block;
            }
            
            .hamburger.active .line:nth-child(2) {
                opacity: 0;
            }
            
            .hamburger.active .line:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }
            
            .hamburger.active .line:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a href="index.php" class="logo">
                <img src="http://localhost:8888/ShoeLand-eCommerce/assets/logo/sneakers.png" alt="Shoe Land Logo">
                <h1>Shoe Land</h1>
            </a>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="home.php" class="nav-link"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a href="products.php" class="nav-link"><i class="fas fa-box"></i> Products</a>
                </li>
                <li class="nav-item">
                    <a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i> Cart</a>
                </li>
                <li class="nav-item">
                    <a href="about.php" class="nav-link"><i class="fas fa-info-circle"></i> About</a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link"><i class="fas fa-user"></i> Login</a>
                </li>
            </ul>
            
            <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </nav>
    </header>

    <script>
        const hamburger = document.querySelector(".hamburger");
        const navMenu = document.querySelector(".nav-menu");

        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("active");
            navMenu.classList.toggle("active");
        });

        document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
            hamburger.classList.remove("active");
            navMenu.classList.remove("active");
        }));
    </script>
</body>
</html>
