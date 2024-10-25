<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <script src="../js/darkmode.js"></script>


    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Header styles */
        header {
            background-color: #23a6d5;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #ff5733;
        }

        /* Main content */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Cart Table styles */
        .cart-table {
            width: 80%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: transparent;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }


        .cart-table th,
        .cart-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }

        .cart-table th {
            background-color: #ff5733;
            color: white;
        }

        /* Product card styles */
        .product-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .product-image {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }

        .product-title {
            font-size: 1.2em;
            color: #333;
        }

        .product-price {
            color: #777;
            font-size: 1.1em;
        }

        .product-quantity {
            width: 60px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .remove-btn {
            background-color: transparent;
            border: none;
            color: #ff5733;
            cursor: pointer;
            font-size: 1em;
        }

        /* Cart summary styles */
        .cart-summary {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 80%;
        }

        .cart-summary h2 {
            margin-top: 0;
            color: #ff5733;
        }

        .coupon-input {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: calc(100% - 22px);
        }

        /* Button styles */
        .checkout-btn {
            background-color: #ff5733;
            border: none;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .checkout-btn:hover {
            background-color: #e74c3c;
        }

        .remove-btn,
        .add-to-cart-btn {
            background-color: #ff5733;
            /* Set the background color */
            color: white;
            /* Set text color */
            border: none;
            /* Remove border */
            cursor: pointer;
            /* Pointer cursor on hover */
            font-size: 1em;
            /* Font size */
            padding: 10px;
            /* Padding for button */
            border-radius: 5px;
            /* Rounded corners */
            transition: background-color 0.3s ease;
            /* Transition effect */
        }

        .remove-btn:hover {
            background-color: #e74c3c;
            /* Darker shade on hover */
        }

        /* Responsive design */
        @media (max-width: 768px) {

            .cart-table,
            .cart-summary {
                width: 95%;
            }
        }
    </style>
</head>

<body>

    <!-- Import header -->
    <?php include '../includes/header.php'; ?>

    <div class="container">

        <h1>Your Cart</h1>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Dummy product data
                $products = [
                    ['name' => 'Product 1', 'price' => 25.00, 'image' => 'https://via.placeholder.com/80'],
                    ['name' => 'Product 2', 'price' => 35.00, 'image' => 'https://via.placeholder.com/80'],
                    ['name' => 'Product 3', 'price' => 45.00, 'image' => 'https://via.placeholder.com/80'],
                ];

                $total = 0;

                foreach ($products as $product) {
                    $subtotal = $product['price']; // Adjust with quantity in real implementation
                    $total += $subtotal;
                    echo '
                    <tr>
                        <td>
                            <div class="product-card">
                                <img src="' . $product['image'] . '" alt="Product Image" class="product-image">
                                <span class="product-title">' . $product['name'] . '</span>
                            </div>
                        </td>
                        <td class="product-price">$' . number_format($product['price'], 2) . '</td>
                        <td>
                            <input type="number" class="product-quantity" value="1" min="1">
                        </td>
                        <td class="product-price">$' . number_format($subtotal, 2) . '</td>
                        <td>
                            <button class="remove-btn">Remove</button>
                        </td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <h2>Cart Summary</h2>
            <p>Subtotal: $<span id="subtotal"><?php echo number_format($total, 2); ?></span></p>
            <p>Taxes (estimated): $<span id="taxes">0.00</span></p>
            <p>Shipping: $<span id="shipping">5.00</span></p>
            <h3>Total: $<span id="total"><?php echo number_format($total + 5.00, 2); ?></span></h3>

            <input type="text" class="coupon-input" placeholder="Enter coupon code">
            <button class="add-to-cart-btn">Apply Coupon</button>
            <br /><br />
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>

    </div>

    <?php include '../includes/footer.php'; ?>

</body>

</html>