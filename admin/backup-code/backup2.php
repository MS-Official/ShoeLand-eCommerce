<?php
session_start();

// Database connection
$servername = "127.0.0.1:3307";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password
$dbname = "shoeland_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get all products
function getProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to add a product
function addProduct($name, $description, $price, $size, $stock, $image_url) {
    global $conn;
    $sql = "INSERT INTO products (name, description, price, size, stock, image_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsss", $name, $description, $price, $size, $stock, $image_url);
    $stmt->execute();
    $stmt->close();
}

// Function to update a product
function updateProduct($id, $name, $description, $price, $size, $stock, $image_url) {
    global $conn;
    $sql = "UPDATE products SET name=?, description=?, price=?, size=?, stock=?, image_url=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsssi", $name, $description, $price, $size, $stock, $image_url, $id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a product
function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Function to get all users
function getUsers() {
    global $conn;
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to add a user
function addUser($name, $email, $password, $role) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
    $stmt->execute();
    $stmt->close();
}

// Function to update a user
function updateUser($id, $name, $email, $role) {
    global $conn;
    $sql = "UPDATE users SET name=?, email=?, role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $role, $id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a user
function deleteUser($id) {
    global $conn;
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Function to get all orders
function getOrders() {
    global $conn;
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to add an order
function addOrder($user_id, $product_ids, $total_price, $order_status, $payment_info) {
    global $conn;
    $sql = "INSERT INTO orders (user_id, product_ids, total_price, order_status, payment_info) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdss", $user_id, $product_ids, $total_price, $order_status, $payment_info);
    $stmt->execute();
    $stmt->close();
}

// Function to update an order
function updateOrder($id, $user_id, $product_ids, $total_price, $order_status, $payment_info) {
    global $conn;
    $sql = "UPDATE orders SET user_id=?, product_ids=?, total_price=?, order_status=?, payment_info=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdssi", $user_id, $product_ids, $total_price, $order_status, $payment_info, $id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete an order
function deleteOrder($id) {
    global $conn;
    $sql = "DELETE FROM orders WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Function to get all newsletter subscribers
function getNewsletterSubscribers() {
    global $conn;
    $sql = "SELECT * FROM newsletter_subscribers";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to add a newsletter subscriber
function addNewsletterSubscriber($email) {
    global $conn;
    $sql = "INSERT INTO newsletter_subscribers (email) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a newsletter subscriber
function deleteNewsletterSubscriber($id) {
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
$products = getProducts();
$users = getUsers();
$orders = getOrders();
$subscribers = getNewsletterSubscribers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Shop Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        :root {
            --bg-color: #f4f4f4;
            --text-color: #333;
            --sidebar-bg: #ffffff;
            --sidebar-hover: #e0e0e0;
            --header-bg: #4a90e2;
            --header-text: #ffffff;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --input-border: #cccccc;
            --button-bg: #4CAF50;
            --button-hover: #45a049;
            --table-border: #dddddd;
            --table-header: #f2f2f2;
        }

        .dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #f4f4f4;
            --sidebar-bg: #2c2c2c;
            --sidebar-hover: #3a3a3a;
            --header-bg: #2c3e50;
            --header-text: #ffffff;
            --card-bg: #2c2c2c;
            --input-bg: #3a3a3a;
            --input-border: #555555;
            --button-bg: #2ecc71;
            --button-hover: #27ae60;
            --table-border: #444444;
            --table-header: #2c2c2c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            height: 100vh;
            padding: 20px;
            transition: width 0.3s, background-color 0.3s;
            overflow-x: hidden;
        }

        .sidebar.minimized {
            width: 60px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            color: var(--text-color);
            transition: background-color 0.2s;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
        }

        .sidebar a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar.minimized a span {
            display: none;
        }

        .content {
            flex: 1;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .header {
            background-color: var(--header-bg);
            color: var(--header-text);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .header h1 {
            margin: 0;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid var(--table-border);
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--table-header);
        }

        form {
            display: grid;
            gap: 10px;
        }

        input[type="text"], input[type="number"], input[type="email"], input[type="password"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--input-border);
            border-radius: 4px;
            background-color: var(--input-bg);
            color: var(--text-color);
        }

        input[type="submit"] {
            background-color: var(--button-bg);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        input[type="submit"]:hover {
            background-color: var(--button-hover);
        }

        .toggle-btn {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.5em;
            cursor: pointer;
        }

        .product-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    
    <div class="sidebar" id="sidebar">
        <h2><i class="fas fa-shoe-prints"></i> <span>Dashboard</span></h2>
        <a href="?section=dashboard"><i class="fas fa-home"></i> <span>Dashboard</span></a>
        <a href="?section=products"><i class="fas fa-box"></i> <span>Products</span></a>
        <a href="?section=users"><i class="fas fa-users"></i> <span>Users</span></a>
        <a href="?section=orders"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
        <a href="?section=subscribers"><i class="fas fa-envelope"></i> <span>Subscribers</span></a>
    </div>
    
    <div class="content">
        <div class="header">
            <button id="toggleSidebar" class="toggle-btn"><i class="fas fa-bars"></i></button>
            <h1>Shoe Shop Admin Dashboard</h1>
            <button id="toggleTheme" class="toggle-btn"><i class="fas fa-moon"></i></button>
        </div>
        
        <div class="card">
            <?php if ($section === 'dashboard'): ?>
                <h2>Welcome to the Dashboard</h2>
                <p>Select a section from the sidebar to manage your shoe shop.</p>

            <?php elseif ($section === 'products'): ?>
                <h2>Manage Products</h2>
                <h3>Add Product</h3>
                <form method="post">
                    <input type="text" name="name" placeholder="Product Name" required>
                    <textarea name="description" placeholder="Product Description" required></textarea>
                    <input type="number" name="price" step="0.01" placeholder="Price" required>
                    <input type="text" name="size" placeholder="Size" required>
                    <input type="number" name="stock" placeholder="Stock" required>
                    <input type="text" name="image_url" placeholder="Image URL" required>
                    <input type="submit" name="add_product" value="Add Product">
                </form>

                <h3>Product List</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Stock</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td>$<?php echo $product['price']; ?></td>
                            <td><?php echo $product['size']; ?></td>
                            <td><?php echo $product['stock']; ?></td>
                            <td><img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" class="product-image"></td>
                            <td>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                    <input type="submit" name="delete_product" value="Delete" onclick="return confirm('Are you sure you want to delete this product?');">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            <?php elseif ($section === 'users'): ?>
                <h2>Manage Users</h2>
                <h3>Add User</h3>
                <form method="post">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <select name="role" required>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                    <input type="submit" name="add_user" value="Add User">
                </form>

                <h3>User List</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <input type="submit" name="delete_user" value="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            <?php elseif ($section === 'orders'): ?>
                <h2>Manage Orders</h2>
                <h3>Add Order</h3>
                <form method="post">
                    <input type="number" name="user_id" placeholder="User ID" required>
                    <input type="text" name="product_ids" placeholder="Product IDs (comma-separated)" required>
                    <input type="number" name="total_price" step="0.01" placeholder="Total Price" required>
                    <input type="text" name="order_status" placeholder="Order Status" required>
                    <input type="text" name="payment_info" placeholder="Payment Info" required>
                    <input type="submit" name="add_order" value="Add Order">
                </form>

                <h3>Order List</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Product IDs</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Payment Info</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['user_id']; ?></td>
                            <td><?php echo $order['product_ids']; ?></td>
                            <td>$<?php echo $order['total_price']; ?></td>
                            <td><?php echo $order['order_status']; ?></td>
                            <td><?php echo $order['payment_info']; ?></td>
                            <td>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                                    <input type="submit" name="delete_order" value="Delete" onclick="return confirm('Are you sure you want to delete this order?');">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            <?php elseif ($section === 'subscribers'): ?>
                <h2>Manage Newsletter Subscribers</h2>
                <h3>Add Subscriber</h3>
                <form method="post">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="submit" name="add_subscriber" value="Add Subscriber">
                </form>

                <h3>Subscriber List</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($subscribers as $subscriber): ?>
                        <tr>
                            <td><?php echo $subscriber['id']; ?></td>
                            <td><?php echo $subscriber['email']; ?></td>
                            <td><?php echo $subscriber['created_at']; ?></td>
                            <td>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $subscriber['id']; ?>">
                                    <input type="submit" name="delete_subscriber" value="Delete" onclick="return confirm('Are you sure you want to delete this subscriber?');">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            <?php endif; ?>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const toggleTheme = document.getElementById('toggleTheme');
        const body = document.body;

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('minimized');
        });

        toggleTheme.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            const isDarkMode = body.classList.contains('dark-mode');
            toggleTheme.innerHTML = isDarkMode ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        });

        <?php
        if (isset($_SESSION['toast'])) {
            $toast = $_SESSION['toast'];
            echo "Toastify({
                text: '{$toast['message']}',
                duration: 3000,
                close: true,
                gravity: 'top',
                position: 'right',
                backgroundColor: '{$toast['type']}' === 'success' ? '#4CAF50' : '#F44336',
            }).showToast();";
            unset($_SESSION['toast']);
        }
        ?>
    </script>
</body>
</html>