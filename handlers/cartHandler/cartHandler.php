<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Log errors to a file for better tracking (optional, especially useful in production)
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/cartHandler_errors.log');

require_once '../../dbconfig/db_config.php';

header('Content-Type: application/json');

session_start();

function sendJsonResponse($data) {
    echo json_encode($data);
    exit;
}

function getProductDetails($productId) {
    global $conn;

    try {
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    } catch (Exception $e) {
        error_log('Database error: ' . $e->getMessage());
        return null;
    }
}

function getCart() {
    try {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $cartItems = [];
        $subtotal = 0;

        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = getProductDetails($productId);
            if ($product) {
                $product['quantity'] = $quantity;
                $cartItems[] = $product;
                $subtotal += $product['price'] * $quantity;
            }
        }

        $tax = $subtotal * 0.1; // Assuming 10% tax
        $shipping = 5.99; // Fixed shipping cost
        $total = $subtotal + $tax + $shipping;

        $response = [
            'items' => $cartItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total
        ];

        sendJsonResponse($response);
    } catch (Exception $e) {
        error_log('Error in getCart: ' . $e->getMessage());
        sendJsonResponse(['error' => 'An error occurred while fetching the cart.']);
    }
}

function addToCart() {
    $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($productId <= 0) {
        sendJsonResponse(['error' => 'Invalid product ID']);
        return;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    sendJsonResponse(['success' => true, 'message' => 'Product added to cart']);
}

function updateCart() {
    $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if ($productId <= 0) {
        sendJsonResponse(['error' => 'Invalid product ID']);
        return;
    }

    if ($quantity <= 0) {
        unset($_SESSION['cart'][$productId]);
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    sendJsonResponse(['success' => true, 'message' => 'Cart updated']);
}

function removeFromCart() {
    $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;

    if ($productId <= 0) {
        sendJsonResponse(['error' => 'Invalid product ID']);
        return;
    }

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    sendJsonResponse(['success' => true, 'message' => 'Product removed from cart']);
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

switch ($action) {
    case 'getCart':
        getCart();
        break;
    case 'addToCart':
        addToCart();
        break;
    case 'updateCart':
        updateCart();
        break;
    case 'removeFromCart':
        removeFromCart();
        break;
    default:
        sendJsonResponse(['error' => 'Invalid action']);
        break;
}

// Catch any uncaught exceptions
set_exception_handler(function($e) {
    error_log('Uncaught exception: ' . $e->getMessage());
    sendJsonResponse(['error' => 'An unexpected error occurred.']);
});
