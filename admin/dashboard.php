<?php include"/Applications/MAMP/htdocs/ShoeLand-eCommerce/admin/util/admin_functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Shop Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="./css/dashboard.css">
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
            <h1>ShoeLand Admin Dashboard</h1>
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
                            <td><img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>"
                                    class="product-image"></td>
                            <td>
                                <button
                                    onclick="showUpdateForm('product', <?php echo htmlspecialchars(json_encode($product)); ?>)">Update</button>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                    <input type="submit" name="delete_product" value="Delete"
                                        onclick="return confirm('Are you sure you want to delete this product?');">
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
                                <button
                                    onclick="showUpdateForm('user', <?php echo htmlspecialchars(json_encode($user)); ?>)">Update</button>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <input type="submit" name="delete_user" value="Delete"
                                        onclick="return confirm('Are you sure you want to delete this user?');">
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
                                <button
                                    onclick="showUpdateForm('order', <?php echo htmlspecialchars(json_encode($order)); ?>)">Update</button>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                                    <input type="submit" name="delete_order" value="Delete"
                                        onclick="return confirm('Are you sure you want to delete this order?');">
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
                                    <input type="submit" name="delete_subscriber" value="Delete"
                                        onclick="return confirm('Are you sure you want to delete this subscriber?');">
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
                gravity: 'bottom',
                position: 'left',
                backgroundColor: '{$toast['type']}' === 'success' ? '#4CAF50' : '#F44336',
            }).showToast();";
            unset($_SESSION['toast']);
        }
        ?>
    </script>



</body>

</html>