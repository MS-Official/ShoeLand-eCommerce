<?php
session_start();

// Database connection
$servername = "127.0.0.1:3307";
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
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Function to get paginated products
function getProducts($offset, $items_per_page) {
    global $conn;
    $sql = "SELECT * FROM products LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of products
function getTotalProducts() {
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM products";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['count'];
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
    $stmt->bind_param("ssdsisi", $name, $description, $price, $size, $stock, $image_url, $id);
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

// Function to get paginated users
function getUsers($offset, $items_per_page) {
    global $conn;
    $sql = "SELECT * FROM users LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of users
function getTotalUsers() {
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['count'];
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

// Function to get paginated orders
function getOrders($offset, $items_per_page) {
    global $conn;
    $sql = "SELECT * FROM orders LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of orders
function getTotalOrders() {
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM orders";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['count'];
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

// Function to get paginated newsletter subscribers
function getNewsletterSubscribers($offset, $items_per_page) {
    global $conn;
    $sql = "SELECT * FROM newsletter_subscribers LIMIT $offset, $items_per_page";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get total number of newsletter subscribers
function getTotalNewsletterSubscribers() {
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM newsletter_subscribers";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['count'];
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
$products = getProducts($offset, $items_per_page);
$total_products = getTotalProducts();
$users = getUsers($offset, $items_per_page);
$total_users = getTotalUsers();
$orders = getOrders($offset, $items_per_page);
$total_orders = getTotalOrders();
$subscribers = getNewsletterSubscribers($offset, $items_per_page);
$total_subscribers = getTotalNewsletterSubscribers();
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
            --bg-color: #ffffff;
            --text-color: #333333;
            --sidebar-bg: #ff5733;
            --sidebar-text: #ffffff;
            --sidebar-hover: #e64d2e;
            --header-bg: #ff5733;
            --header-text: #ffffff;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --input-border: #cccccc;
            --button-bg: #ff5733;
            --button-hover: #e64d2e;
            --table-border: #dddddd;
            --table-header: #ff5733;
            --table-header-text: #ffffff;
        }

        .dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #ffffff;
            --sidebar-bg: #ff5733;
            --sidebar-text: #ffffff;
            --sidebar-hover: #e64d2e;
            --header-bg: #ff5733;
            --header-text: #ffffff;
            --card-bg: #2c2c2c;
            --input-bg: #3a3a3a;
            --input-border: #555555;
            --button-bg: #ff5733;
            --button-hover: #e64d2e;
            --table-border: #444444;
            --table-header: #ff5733;
            --table-header-text: #ffffff;
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
            color: var(--sidebar-text);
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
            color: var(--table-header-text);
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

        input[type="submit"], button {
            background-color: var(--button-bg);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        input[type="submit"]:hover, button:hover {
            background-color: var(--button-hover);
        }

        .toggle-btn {
            background: none;
            border: none;
            color: var(--header-text);
            font-size: 1.5em;
            cursor: pointer;
        }

        .product-image {
            max-width: 100px;
            max-height: 100px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: var(--text-color);
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid var(--table-border);
            margin: 0 4px;
        }

        .pagination a.active {
            background-color: var(--button-bg);
            color: white;
            border: 1px solid var(--button-bg);
        }

        .pagination a:hover:not(.active) {
            background-color: var(--button-hover);
        }

        #updateFormContainer {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        #updateFormContent {
            background-color: var(--card-bg);
            color: var(--text-color);
            padding: 20px;
            border-radius: 5px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 500px;
            width: 100%;
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
                                <button onclick="showUpdateForm('product', <?php echo htmlspecialchars(json_encode($product)); ?>)">Update</button>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                    <input type="submit" name="delete_product" value="Delete" onclick="return confirm('Are you sure you want to delete this product?');">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                $total_pages = ceil($total_products / $items_per_page);
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?section=products&page=$i'" . ($page == $i ? " class='active'" : "") . ">$i</a>";
                }
                echo "</div>";
                ?>

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
                                <button onclick="showUpdateForm('user', <?php echo htmlspecialchars(json_encode($user)); ?>)">Update</button>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <input type="submit" name="delete_user" value="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                $total_pages = ceil($total_users / $items_per_page);
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?section=users&page=$i'" . ($page == $i ? " class='active'" : "") . ">$i</a>";
                }
                echo "</div>";
                ?>

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
                                <button onclick="showUpdateForm('order', <?php echo htmlspecialchars(json_encode($order)); ?>)">Update</button>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                                    <input type="submit" name="delete_order" value="Delete" onclick="return confirm('Are you sure you want to delete this order?');">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php
                $total_pages = ceil($total_orders / $items_per_page);
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?section=orders&page=$i'" . ($page == $i ? " class='active'" : "") . ">$i</a>";
                }
                echo "</div>";
                ?>

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
                <?php
                $total_pages = ceil($total_subscribers / $items_per_page);
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?section=subscribers&page=$i'" . ($page == $i ? " class='active'" : "") . ">$i</a>";
                }
                echo "</div>";
                ?>

            <?php endif; ?>
        </div>
    </div>

    <div id="updateFormContainer">
        <div id="updateFormContent">
            <h3>Update <span id="updateFormTitle"></span></h3>
            <form id="updateForm" method="post">
                <!-- Form fields will be dynamically added here -->
            </form>
            <button onclick="hideUpdateForm()">Cancel</button>
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

        function showUpdateForm(type, data) {
            const container = document.getElementById('updateFormContainer');
            const form = document.getElementById('updateForm');
            const title = document.getElementById('updateFormTitle');

            // Clear previous form fields
            form.innerHTML = '';

            // Set the form title
            title.textContent = type.charAt(0).toUpperCase() + type.slice(1);

            // Add hidden input for ID
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = data.id;
            form.appendChild(idInput);

            // Add form fields based on the type
            if (type === 'product') {
                addFormField(form, 'name', 'text', 'Product Name', data.name);
                addFormField(form, 'description', 'textarea', 'Description', data.description);
                addFormField(form, 'price', 'number', 'Price', data.price, { step: '0.01' });
                addFormField(form, 'size', 'text', 'Size', data.size);
                addFormField(form, 'stock', 'number', 'Stock', data.stock);
                addFormField(form, 'image_url', 'text', 'Image URL', data.image_url);
            } else if (type === 'user') {
                addFormField(form, 'name', 'text', 'Name', data.name);
                addFormField(form, 'email', 'email', 'Email', data.email);
                addFormField(form, 'role', 'select', 'Role', data.role, {
                    options: [
                        { value: 'customer', label: 'Customer' },
                        { value: 'admin', label: 'Admin' }
                    ]
                });
            } else if (type === 'order') {
                addFormField(form, 'user_id', 'number', 'User ID', data.user_id);
                addFormField(form, 'product_ids', 'text', 'Product IDs', data.product_ids);
                addFormField(form, 'total_price', 'number', 'Total Price', data.total_price, { step: '0.01' });
                addFormField(form, 'order_status', 'text', 'Order Status', data.order_status);
                addFormField(form, 'payment_info', 'text', 'Payment Info', data.payment_info);
            }

            // Add submit button
            const submitButton = document.createElement('input');
            submitButton.type = 'submit';
            submitButton.name = `update_${type}`;
            submitButton.value = 'Update';
            form.appendChild(submitButton);

            // Show the form container
            container.style.display = 'block';
        }

        function hideUpdateForm() {
            document.getElementById('updateFormContainer').style.display = 'none';
        }

        function addFormField(form, name, type, placeholder, value, options = {}) {
            const label = document.createElement('label');
            label.textContent = placeholder;
            form.appendChild(label);

            let input;
            if (type === 'select') {
                input = document.createElement('select');
                options.options.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.textContent = option.label;
                    optionElement.selected = option.value === value;
                    input.appendChild(optionElement);
                });
            } else if (type === 'textarea') {
                input = document.createElement('textarea');
                input.value = value;
            } else {
                input = document.createElement('input');
                input.type = type;
                input.value = value;
            }

            input.name = name;
            input.placeholder = placeholder;
            
            for (const [key, value] of Object.entries(options)) {
                if (key !== 'options') {
                    input[key] = value;
                }
            }

            form.appendChild(input);
        }

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