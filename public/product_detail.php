<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="http://localhost:8888/ShoeLand-Ecommerce/assets/Shoeland.png" class="logo"/>
    <title>Product Detail | ShoeLand eCommerce</title>
    
    <script src="../js/darkmode.js"></script>
    <script src="../js/product_detail.js"></script>

</head>
<body>
    <!-- Header Section -->
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <main>
            <div class="product-container">
                <div class="product-images">
                    <img src="https://via.placeholder.com/400x400?text=Product" alt="Vintage Camera" class="main-image">
                    <section class="thumbnail-slider">
                        <button id="prev-button" class="slider-button">&lt;</button>
                        <div class="thumbnail-container">
                            <img src="https://via.placeholder.com/200x200?text=Product+1" alt="Thumbnail 1" class="thumbnail" onclick="changeMainImage(this)"/>
                            <img src="https://via.placeholder.com/200x200?text=Product+2" alt="Thumbnail 2" class="thumbnail" onclick="changeMainImage(this)"/>
                            <img src="https://via.placeholder.com/200x200?text=Product+3" alt="Thumbnail 3" class="thumbnail" onclick="changeMainImage(this)"/>
                            <img src="https://via.placeholder.com/200x200?text=Product+4" alt="Thumbnail 4" class="thumbnail" onclick="changeMainImage(this)"/>
                            <img src="https://via.placeholder.com/200x200?text=Product+5" alt="Thumbnail 5" class="thumbnail" onclick="changeMainImage(this)"/>
                        </div>
                        <button id="next-button" class="slider-button">&gt;</button>
                    </section>

                </div>
                <div class="product-details">
                    <h1>Men's Classic Leather Loafers</h1>
                    <div class="price">$89.99</div>
                    <div class="condition">Category: Men’s Footwear</div>
                    <div class="condition">Condition: Brand New</div>
                    <div class="shipping">Free Shipping</div>
                    <button class="buy-now orange-button">Buy It Now</button>
                    <button class="add-to-cart ash-button">Add to cart</button>
                    <div class="seller-info">
                        <h3>Seller information</h3>
                        <p>ShoeLand (50K <span class="star">★★★★★</span>)</p>
                        <p>100% Positive feedback</p>
                    </div>
                </div>
            </div>

            <section class="product-description">
                <h2>Description: </h2>
                <p>
                    Step into timeless style with our Men's Classic Leather Loafers.
                    Crafted from premium genuine leather, these loafers offer a sleek and versatile look suitable for both formal and casual occasions.
                    The cushioned insole provides unmatched comfort, while the durable outsole ensures long-lasting wear.
                </p>
                <h2>Key Features:</h2>
                <ul>
                    <li>Material: 100% Genuine Leather</li>
                    <li>Style: Slip-on Loafers</li>
                    <li>Sole: Anti-slip rubber outsole</li>
                    <li>Comfort: Padded insole for all-day support</li>
                    <li>Colors: Available in Black, Brown, and Tan</li>
                </ul>
                <h2>Size Options:</h2>
                <p>Available in US sizes 7–12.</p>
            
                <h2>Care Instructions:</h2>
                <p>Clean with a damp cloth and use leather conditioner to maintain shine and durability.</p>
                
                <h2>Why You'll Love It:</h2>
                <p>Clean with a damp cloth and use leather conditioner to maintain shine and durability.</p>
            </section>

            <section class="shipping-payment">
                <h2>Shipping and Payment</h2>
                <p>Item ships worldwide. Payment accepted via PayPal, credit card, or debit card.</p>
            </section>
            <br><br>
        </main>

    </div>

    <!-- Footer Section -->
    <?php include '../includes/footer.php'; ?>

    <style>
        :root {
        --orange: #FF6600;
        --ash: #F0F0F0;
        --dark-ash: #CCCCCC;
        --white: #FFFFFF;
        --text-color: #333333;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.3s, color 0.3s;
            background-color: #ffffff; /* Default light background */
            color: #000000; /* Default text color */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-container {
            display: flex;
            margin-top: 20px;
        }

        .product-images {
            flex: 1;
            margin-right: 20px;
        }

        .main-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border: 1px solid var(--dark-ash);
        }

        .thumbnail-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 1px solid var(--dark-ash);
            cursor: pointer;
        }

        .product-details {
            flex: 1;
        }

        .price {
            font-size: 28px;
            font-weight: bold;
            color: var(--orange);
            margin-bottom: 10px;
        }

        .condition, .shipping {
            margin-bottom: 10px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        .buy-now {
            background-color: var(--orange);
            color: var(--white);
        }

        .add-to-cart {
            background-color: var(--ash);
            border: 1px solid var(--dark-ash);
            color: var(--text-color);
        }

        .seller-info {
            margin-top: 20px;
            border-top: 1px solid var(--dark-ash);
            padding-top: 20px;
        }

        .star {
            color: var(--orange);
        }

        .product-description, .shipping-payment {
            margin-top: 30px;
            background-color: var(--ash);
            padding: 20px;
            border-radius: 20px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        ul {
            padding-left: 20px;
        }

        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
            }
        
            .product-images, .product-details {
                width: 100%;
            }
        }

        /* Dark Mode Styles */
        .dark-mode {
            background-color: #1e1e1e;
            color: #f0f0f0;
        }

        .dark-mode .shipping-payment{
            padding-bottom: 100px;
        }

        .dark-mode .shipping-payment, .dark-mode .product-description {
            background-color: #333333;
            color: #f0f0f0;
            margin-top: 30px;
            border-radius: 20px;
            padding: 20px;
        }

        .dark-mode h1,
        .dark-mode h2,
        .dark-mode p,
        .dark-mode a {
            color: #f0f0f0;
        }

        .dark-mode a {
            color: #ff7849;
        }

        .dark-mode .contact-info i,
        .dark-mode .fas,
        .dark-mode .fab {
            color: #ff7849;
        }

        .dark-mode .form-container input,
        .dark-mode .form-container textarea {
            background-color: #333;
            color: #f0f0f0;
            border: 1px solid #444;
        }

        .dark-mode .form-container button {
            background-color: #ff7849;
            background-image: linear-gradient(135deg, #ff7849, #ff5733);
        }

        .dark-mode footer {
            background-color: #333;
            color: #f0f0f0;
        }

        .dark-mode footer a {
            color: #ff7849;
        }

        .dark-mode #map {
            filter: grayscale(100%);
        }
    </style>
</body>
</html>