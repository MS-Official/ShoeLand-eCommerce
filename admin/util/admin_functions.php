<?php
session_start();

// Database connection
$servername = "127.0.0.1:8889";
$username = "root";
$password = "";
$dbname = "shoeland_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination settings
$items_per_page = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Function to get paginated products
function getProducts($offset, $items_per_page)
{
    global $conn;
    $sql = "SELECT * FROM products LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of products
function getTotalProducts()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM products";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['count'];
}

// Function to add a product
function addProduct($name, $description, $price, $size, $stock, $image_url)
{
    global $conn;
    $sql = "INSERT INTO products (name, description, price, size, stock, image_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsss", $name, $description, $price, $size, $stock, $image_url);
    $stmt->execute();
    $stmt->close();
}

// Function to update a product
function updateProduct($id, $name, $description, $price, $size, $stock, $image_url)
{
    global $conn;
    $sql = "UPDATE products SET name=?, description=?, price=?, size=?, stock=?, image_url=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsisi", $name, $description, $price, $size, $stock, $image_url, $id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a product
function deleteProduct($id)
{
    global $conn;
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Function to get paginated users
function getUsers($offset, $items_per_page)
{
    global $conn;
    $sql = "SELECT * FROM users LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of users
function getTotalUsers()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['count'];
}

// Function to add a user
function addUser($name, $email, $password, $role)
{
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
    $stmt->execute();
    $stmt->close();
}

// Function to update a user
function updateUser($id, $name, $email, $role)
{
    global $conn;
    $sql = "UPDATE users SET name=?, email=?, role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $role, $id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a user
function deleteUser($id)
{
    global $conn;
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Function to get paginated orders
function getOrders($offset, $items_per_page)
{
    global $conn;
    $sql = "SELECT * FROM orders LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of orders
function getTotalOrders()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM orders";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['count'];
}

// Function to add an order
function addOrder($user_id, $product_ids, $total_price, $order_status, $payment_info)
{
    global $conn;
    $sql = "INSERT INTO orders (user_id, product_ids, total_price, order_status, payment_info) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdss", $user_id, $product_ids, $total_price, $order_status, $payment_info);
    $stmt->execute();
    $stmt->close();
}

// Function to update an order
function updateOrder($id, $user_id, $product_ids, $total_price, $order_status, $payment_info)
{
    global $conn;
    $sql = "UPDATE orders SET user_id=?, product_ids=?, total_price=?, order_status=?, payment_info=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdssi", $user_id, $product_ids, $total_price, $order_status, $payment_info, $id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete an order
function deleteOrder($id)
{
    global $conn;
    $sql = "DELETE FROM orders WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Function to get paginated newsletter subscribers
function getNewsletterSubscribers($offset, $items_per_page)
{
    global $conn;
    $sql = "SELECT * FROM newsletter_subscribers LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of newsletter subscribers
function getTotalNewsletterSubscribers()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM newsletter_subscribers";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['count'];
}

// Function to add a newsletter subscriber
function addNewsletterSubscriber($email)
{
    global $conn;
    $sql = "INSERT INTO newsletter_subscribers (email) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a newsletter subscriber
function deleteNewsletterSubscriber($id)
{
    global $conn;
    $sql = "DELETE FROM newsletter_subscribers WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$section = isset($_GET['section']) ? $_GET['section'] : 'dashboard';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        addProduct($_POST['name'], $_POST['description'], $_POST['price'], $_POST['size'], $_POST['stock'], $_POST['image_url']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Product added successfully'];
    } elseif (isset($_POST['update_product'])) {
        updateProduct($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['size'], $_POST['stock'], $_POST['image_url']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Product updated successfully'];
    } elseif (isset($_POST['delete_product'])) {
        deleteProduct($_POST['id']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Product deleted successfully'];
    } elseif (isset($_POST['add_user'])) {
        addUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['role']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'User added successfully'];
    } elseif (isset($_POST['update_user'])) {
        updateUser($_POST['id'], $_POST['name'], $_POST['email'], $_POST['role']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'User updated successfully'];
    } elseif (isset($_POST['delete_user'])) {
        deleteUser($_POST['id']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'User deleted successfully'];
    } elseif (isset($_POST['add_order'])) {
        addOrder($_POST['user_id'], $_POST['product_ids'], $_POST['total_price'], $_POST['order_status'], $_POST['payment_info']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Order added successfully'];
    } elseif (isset($_POST['update_order'])) {
        updateOrder($_POST['id'], $_POST['user_id'], $_POST['product_ids'], $_POST['total_price'], $_POST['order_status'], $_POST['payment_info']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Order updated successfully'];
    } elseif (isset($_POST['delete_order'])) {
        deleteOrder($_POST['id']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Order deleted successfully'];
    } elseif (isset($_POST['add_subscriber'])) {
        addNewsletterSubscriber($_POST['email']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Subscriber added successfully'];
    } elseif (isset($_POST['delete_subscriber'])) {
        deleteNewsletterSubscriber($_POST['id']);
        $_SESSION['toast'] = ['type' => 'success', 'message' => 'Subscriber deleted successfully'];
    }
}

// Get data for each section
$products = getProducts($offset, $items_per_page);
$total_products = getTotalProducts();
$users = getUsers($offset, $items_per_page);
$total_users = getTotalUsers();
$orders = getOrders($offset, $items_per_page);
$total_orders = getTotalOrders();
$subscribers = getNewsletterSubscribers($offset, $items_per_page);
$total_subscribers = getTotalNewsletterSubscribers();
?>
