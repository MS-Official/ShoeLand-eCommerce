<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeLand E-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Sweet alert library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/darkmode.js"></script>
    <script src="../js/home.js"></script>

</head>

<body>


    <!-- Header Section -->
    <?php include '../includes/header.php'; ?>


    <!-- Welcome Banner Section with Slider -->
    <section class="banner-slider">
        <div class="slides">
            <img src="http://localhost:8080/ShoeLand/assets/Banner2.jpg" alt="Banner 3">
            <img src="http://localhost:8080/ShoeLand/assets/Banner3.jpg" alt="Banner 4">
            <img src="http://localhost:8080/ShoeLand/assets/Banner5.jpg" alt="Banner 5">
            <img src="http://localhost:8080/ShoeLand/assets/Banner7.jpg" alt="Banner 7">
            <img src="http://localhost:8080/ShoeLand/assets/Banner8.jpg" alt="Banner 8">
        </div>



        <!-- Welcom to shoe Land container  -->
        <div
            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.8); color: black; text-align: center; padding: 20px 40px; border-radius: 40px;">
            <h2 style="font-size: 3rem; margin-bottom: 10px;">Welcome to ShoeLand</h2>
            <p style="font-size: 1.5rem;">Your destination for the best footwear!</p>
        </div>

    </section>


    <!-- Category Section -->
    <section id="category-section" style="padding: 40px; text-align: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 30px;">Shop by Category</h2>
        <div
            style="display: flex; justify-content: space-between; flex-wrap: wrap; max-width: 1200px; margin: 0 auto; gap: 20px;">

            <!-- Men's Category -->
            <div style="flex: 1; min-width: 250px; margin: 10px;">
                <a href="#" style="text-decoration: none; color: inherit;">
                    <video id="menCategoryVideo" muted playsinline
                        style="width: 320px; height: 240px; border-radius: 10px;">
                        <source src="http://localhost:8080/ShoeLand/assets/CategoryVideo/Men_Category.mp4"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h3 style="font-size: 1.5rem; margin-top: 10px;">Men</h3>
                </a>
            </div>
            <!-- Women's Category -->
            <div style="flex: 1; min-width: 250px; margin: 10px;">
                <a href="#" style="text-decoration: none; color: inherit;">
                    <video id="womenCategoryVideo" muted playsinline
                        style="width: 320px; height: 240px; border-radius: 10px;">
                        <source src="http://localhost:8080/ShoeLand/assets/CategoryVideo/Women_Category.mp4"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h3 style="font-size: 1.5rem; margin-top: 10px;">Women</h3>
                </a>
            </div>
            <!-- Kid's Category -->
            <div style="flex: 1; min-width: 250px; margin: 10px;">
                <a href="#" style="text-decoration: none; color: inherit;">
                    <video id="kidCategoryVideo" muted playsinline
                        style="width: 320px; height: 240px; border-radius: 10px;">
                        <source src="http://localhost:8080/ShoeLand/assets/CategoryVideo/Kids_Category.mp4"
                            type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h3 style="font-size: 1.5rem; margin-top: 10px;">Kid</h3>
                </a>
            </div>
    </section>



    <!-- Featured Products Section -->
    <section style="padding: 40px; text-align: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Featured Products</h2>
        <div
            style="display: flex; justify-content: space-between; flex-wrap: wrap; max-width: 1200px; margin: 0 auto; gap: 20px;">
            <div class="product-card" style="flex: 1; min-width: 250px; margin: 10px;">
                <img src="https://via.placeholder.com/250x250?text=Product+1" alt="Product 1"
                    style="width: 100%; height: auto; border-radius: 10px;">
                <h3 style="font-size: 1.5rem; margin-top: 10px;">Stylish Sneakers</h3>
                <p style="color: #ff5733; font-size: 1.25rem;">$49.99</p>
                <button>Add to Cart</button>
            </div>
            <div class="product-card" style="flex: 1; min-width: 250px; margin: 10px;">
                <img src="https://via.placeholder.com/250x250?text=Product+1" alt="Product 2"
                    style="width: 100%; height: auto; border-radius: 10px;">
                <h3 style="font-size: 1.5rem; margin-top: 10px;">Classic Loafers</h3>
                <p style="color: #ff5733; font-size: 1.25rem;">$59.99</p>
                <button>Add to Cart</button>
            </div>
            <div class="product-card" style="flex: 1; min-width: 250px; margin: 10px;">
                <img src="https://via.placeholder.com/250x250?text=Product+1" alt="Product 3"
                    style="width: 100%; height: auto; border-radius: 10px;">
                <h3 style="font-size: 1.5rem; margin-top: 10px;">Sporty Sandals</h3>
                <p style="color: #ff5733; font-size: 1.25rem;">$34.99</p>
                <button>Add to Cart</button>
            </div>
        </div>
    </section>


    <!-- Customer Testimonials Section -->
    <section style="padding: 40px; text-align: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">What Our Customers Say</h2>
        <div style="max-width: 800px; margin: 0 auto;">
            <blockquote style="font-size: 1.25rem; margin: 20px 0; padding: 20px; border-left: 4px solid #ff5733;">
                "The best place to buy shoes! Great selection and excellent service." - Jane D.
            </blockquote>
            <blockquote style="font-size: 1.25rem; margin: 20px 0; padding: 20px; border-left: 4px solid #ff5733;">
                "I love my new sneakers! They are so comfortable." - Mark T.
            </blockquote>
            <blockquote style="font-size: 1.25rem; margin: 20px 0; padding: 20px; border-left: 4px solid #ff5733;">
                "Fantastic shopping experience. Highly recommended!" - Lisa S.
            </blockquote>
        </div>
    </section>


    <!-- Newsletter Signup Section -->
    <section style="padding: 40px; text-align: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Stay Updated!</h2>
        <p style="font-size: 1.25rem; margin-bottom: 30px;">Subscribe to our newsletter for exclusive offers and
            updates.</p>
        <input type="email" id="emailInput" placeholder="Enter your email"
            style="padding: 10px; width: 300px; border-radius: 5px; border: 1px solid #ccc;">
        <button id="subscribeButton" style="padding: 10px 20px; margin-left: 650px; margin-top: 20px">Subscribe</button>
    </section>

    <!-- FAQs Section -->
    <section style="padding: 40px; text-align: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Frequently Asked Questions</h2>
        <div style="max-width: 800px; margin: 0 auto; text-align: left;">
            <div style="margin: 20px 0;">
                <strong>1. What is your return policy?</strong>
                <p>We offer a 30-day return policy for unworn items. Please contact our customer service for assistance.
                </p>
            </div>
            <div style="margin: 20px 0;">
                <strong>2. How do I track my order?</strong>
                <p>Once your order is shipped, you will receive a tracking number via email.</p>
            </div>
            <div style="margin: 20px 0;">
                <strong>3. Do you ship internationally?</strong>
                <p>Yes, we offer international shipping options. Please check our shipping policy for details.</p>
            </div>
        </div>
    </section>


     <!-- Product Section -->
     <section style="padding: 40px; text-align: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Our Latest Collection</h2>
        <p style="font-size: 1.25rem; margin-bottom: 30px;">Browse through our exclusive range of shoes designed for
            comfort and style.</p>
        <!-- Add product cards or images here -->
    </section>


    <?php include '../includes/footer.php'; ?>

    <style>
        body {
            margin: 0;
            transition: background-color 0.3s, color 0.3s;
            color: #000;
            /* Default text color */
        }

        .dark-mode {
            color: #fff;
            /* Text color in dark mode */
        }

        button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            background-color: #ff5733;
            color: white;
            border-radius: 5px;
            margin-left: 10px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }

        button:hover {
            background-color: #ff794f;
        }

        button i {
            margin-right: 5px;
        }

        /* Dark mode styles for the category section */
        .dark-mode .category-section {
            background-color: #444;
            /* Dark background for the category section */
        }

        .icon {
            font-size: 1.5rem;
            margin-left: 15px;
        }

        .product-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            transition: box-shadow 0.3s;
        }

        .product-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .dark-mode .product-card {
            background-color: #333;
            border: 1px solid #777;
        }


        /* Light and Dark Mode Backgrounds */
        .light-theme {
            background-color: #f4f4f4;
            /* Light background color */
        }

        .dark-theme {
            background-color: #222;
            /* Dark background color */
            color: #fff;
            /* Text color for dark mode */
        }

        /* Slider Container */
        .banner-slider {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        /* Slides */
        .slides {
            display: flex;
            width: 500%;
            /* 100% for each image, as there are 5 images */
            animation: slideAnimation 15s infinite;
        }

        .slides img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            /* Ensures images cover the banner area */
        }


        /* Keyframe Animation for the Slide */
        @keyframes slideAnimation {
            0% {
                margin-left: 0;
            }

            20% {
                margin-left: 0;
            }

            25% {
                margin-left: -100%;
            }

            45% {
                margin-left: -100%;
            }

            50% {
                margin-left: -200%;
            }

            70% {
                margin-left: -200%;
            }

            75% {
                margin-left: -300%;
            }

            95% {
                margin-left: -300%;
            }

            100% {
                margin-left: -400%;
            }
        }
    </style>
</body>

</html>