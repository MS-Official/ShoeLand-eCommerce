<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/darkmode.js"></script>
    <title>Shoe Store</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: white;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        .category {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 40px 0;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s, transform 0.5s;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .category.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .category-header {
            width: 40%;
            background-color: #ff5733;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            text-align: center;
            width: 250px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            width: 100%;
            height: 150px;
            background-color: #e0e0e0;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product-title {
            color: #333;
            margin: 15px 0;
            font-size: 1.2em;
        }

        .product-price {
            color: #777;
            font-size: 1.1em;
            margin-bottom: 15px;
        }

        .add-to-cart-btn {
            background-color: #ff5733;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-to-cart-btn:hover {
            background-color: #e74c3c;
        }

        .product-section {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination button {
            background-color: #ff5733;
            color: white;
            border: none;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pagination button:hover {
            background-color: #e74c3c;
        }
    </style>
</head>

<body>

    <?php include '../includes/header.php'; ?>

    <?php
    // Sample products array
    $products = [
        // Men's shoes
        ['category' => "Men's Shoes", 'title' => "Men's Running Shoe", 'price' => 79.99],
        ['category' => "Men's Shoes", 'title' => "Men's Casual Shoe", 'price' => 69.99],
        ['category' => "Men's Shoes", 'title' => "Men's Dress Shoe", 'price' => 89.99],
        ['category' => "Men's Shoes", 'title' => "Men's Hiking Shoe", 'price' => 99.99],
        ['category' => "Men's Shoes", 'title' => "Men's Basketball Shoe", 'price' => 109.99],
        ['category' => "Men's Shoes", 'title' => "Men's Soccer Cleats", 'price' => 89.99],
        ['category' => "Men's Shoes", 'title' => "Men's Tennis Shoe", 'price' => 79.99],
        ['category' => "Men's Shoes", 'title' => "Men's Sandal", 'price' => 49.99],
        ['category' => "Men's Shoes", 'title' => "Men's Loafers", 'price' => 79.99],
        ['category' => "Men's Shoes", 'title' => "Men's Ankle Boot", 'price' => 119.99],
        ['category' => "Men's Shoes", 'title' => "Men's Slip-On Shoe", 'price' => 59.99],
        ['category' => "Men's Shoes", 'title' => "Men's Boat Shoe", 'price' => 69.99],
        ['category' => "Men's Shoes", 'title' => "Men's Slip Resistant Shoe", 'price' => 89.99],
        ['category' => "Men's Shoes", 'title' => "Men's Chukka Boot", 'price' => 109.99],
        ['category' => "Men's Shoes", 'title' => "Men's Oxford Shoe", 'price' => 99.99],
        ['category' => "Men's Shoes", 'title' => "Men's Skate Shoe", 'price' => 79.99],
        ['category' => "Men's Shoes", 'title' => "Men's Work Boot", 'price' => 129.99],

        // Women's shoes
        ['category' => "Women's Shoes", 'title' => "Women's Sneakers", 'price' => 59.99],
        ['category' => "Women's Shoes", 'title' => "Women's Heels", 'price' => 89.99],
        ['category' => "Women's Shoes", 'title' => "Women's Flats", 'price' => 49.99],
        ['category' => "Women's Shoes", 'title' => "Women's Sandals", 'price' => 39.99],
        ['category' => "Women's Shoes", 'title' => "Women's Ankle Boot", 'price' => 99.99],
        ['category' => "Women's Shoes", 'title' => "Women's Loafers", 'price' => 69.99],
        ['category' => "Women's Shoes", 'title' => "Women's Running Shoe", 'price' => 79.99],
        ['category' => "Women's Shoes", 'title' => "Women's Dress Shoe", 'price' => 89.99],
        ['category' => "Women's Shoes", 'title' => "Women's Wedge Sandal", 'price' => 79.99],
        ['category' => "Women's Shoes", 'title' => "Women's Chunky Heel", 'price' => 69.99],
        ['category' => "Women's Shoes", 'title' => "Women's Platform Shoe", 'price' => 89.99],
        ['category' => "Women's Shoes", 'title' => "Women's Espadrille", 'price' => 59.99],
        ['category' => "Women's Shoes", 'title' => "Women's Clog", 'price' => 49.99],
        ['category' => "Women's Shoes", 'title' => "Women's Ballerina Flat", 'price' => 39.99],
        ['category' => "Women's Shoes", 'title' => "Women's Knee High Boot", 'price' => 109.99],
        ['category' => "Women's Shoes", 'title' => "Women's Over-the-Knee Boot", 'price' => 129.99],
        ['category' => "Women's Shoes", 'title' => "Women's Mules", 'price' => 59.99],

        // Kids' shoes
        ['category' => "Kids' Shoes", 'title' => "Kids' Sports Shoes", 'price' => 39.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Sandals", 'price' => 29.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Running Shoe", 'price' => 49.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Casual Shoe", 'price' => 39.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Slip-On Shoe", 'price' => 29.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Dress Shoe", 'price' => 49.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Light-Up Shoe", 'price' => 49.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' All-Weather Shoe", 'price' => 49.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Skate Shoe", 'price' => 39.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Slip Resistant Shoe", 'price' => 39.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Sports Sandal", 'price' => 29.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Outdoor Shoe", 'price' => 49.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' School Shoe", 'price' => 39.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Winter Boot", 'price' => 59.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Summer Sandal", 'price' => 29.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Dress Boot", 'price' => 49.99],
        ['category' => "Kids' Shoes", 'title' => "Kids' Snow Boot", 'price' => 69.99],
    ];

    // Pagination configuration
    $productsPerPage = 10;
    $currentMensPage = isset($_GET['mens_page']) ? (int) $_GET['mens_page'] : 1;
    $currentWomensPage = isset($_GET['womens_page']) ? (int) $_GET['womens_page'] : 1;
    $currentKidsPage = isset($_GET['kids_page']) ? (int) $_GET['kids_page'] : 1;

    // Calculate offsets
    $mensOffset = ($currentMensPage - 1) * $productsPerPage;
    $womensOffset = ($currentWomensPage - 1) * $productsPerPage;
    $kidsOffset = ($currentKidsPage - 1) * $productsPerPage;

    // Total products per category
    $mensProducts = array_filter($products, fn($product) => $product['category'] === "Men's Shoes");
    $womensProducts = array_filter($products, fn($product) => $product['category'] === "Women's Shoes");
    $kidsProducts = array_filter($products, fn($product) => $product['category'] === "Kids' Shoes");

    $totalMens = count($mensProducts);
    $totalWomens = count($womensProducts);
    $totalKids = count($kidsProducts);

    // Slice the arrays for pagination
    $mensProducts = array_slice($mensProducts, $mensOffset, $productsPerPage);
    $womensProducts = array_slice($womensProducts, $womensOffset, $productsPerPage);
    $kidsProducts = array_slice($kidsProducts, $kidsOffset, $productsPerPage);
    ?>

    <section class="category" id="mens">
        <h2 class="category-header">Men's Shoes</h2>
        <div class="product-section">
            <?php foreach ($mensProducts as $product): ?>
                <div class="product-card">
                    <div class="product-image" style="background-image: url(https://via.placeholder.com/150);"></div>
                    <h3 class="product-title"><?= $product['title'] ?></h3>
                    <p class="product-price">$<?= number_format($product['price'], 2) ?></p>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <?php for ($i = 1; $i <= ceil($totalMens / $productsPerPage); $i++): ?>
                <a href="?mens_page=<?= $i ?>">
                    <button><?= $i ?></button>
                </a>
            <?php endfor; ?>
        </div>
    </section>

    <section class="category" id="womens">
        <h2 class="category-header">Women's Shoes</h2>
        <div class="product-section">
            <?php foreach ($womensProducts as $product): ?>
                <div class="product-card">
                    <div class="product-image" style="background-image: url(https://via.placeholder.com/150);"></div>
                    <h3 class="product-title"><?= $product['title'] ?></h3>
                    <p class="product-price">$<?= number_format($product['price'], 2) ?></p>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <?php for ($i = 1; $i <= ceil($totalWomens / $productsPerPage); $i++): ?>
                <a href="?womens_page=<?= $i ?>">
                    <button><?= $i ?></button>
                </a>
            <?php endfor; ?>
        </div>
    </section>

    <section class="category" id="kids">
        <h2 class="category-header">Kids' Shoes</h2>
        <div class="product-section">
            <?php foreach ($kidsProducts as $product): ?>
                <div class="product-card">
                    <div class="product-image" style="background-image: url(https://via.placeholder.com/150);"></div>
                    <h3 class="product-title"><?= $product['title'] ?></h3>
                    <p class="product-price">$<?= number_format($product['price'], 2) ?></p>
                    <button class="add-to-cart-btn">Add to Cart</button>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <?php for ($i = 1; $i <= ceil($totalKids / $productsPerPage); $i++): ?>
                <a href="?kids_page=<?= $i ?>">
                    <button><?= $i ?></button>
                </a>
            <?php endfor; ?>
        </div>
    </section>

    <script>
        // Animation for category sections
        function revealCategories() {
            const categories = document.querySelectorAll('.category');
            categories.forEach((category, index) => {
                setTimeout(() => {
                    category.classList.add('visible');
                }, index * 300); // Delay for each category
            });
        }

        window.onload = revealCategories; // Trigger animation on load
    </script>

    <!-- Import header -->
    <?php include '../includes/footer.php'; ?>
</body>

</html>