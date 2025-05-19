<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart - Shoeland</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .bg-orange-custom { background-color: #FF6600; }
        .text-orange-custom { color: #FF6600; }
        .border-orange-custom { border-color: #FF6600; }
        .hover\:bg-orange-custom:hover { background-color: #FF8533; }
    </style>
</head>
<body class="bg-white text-gray-800">
    <?php include '../includes/header.php'; ?>

    <header class="bg-orange-custom text-white shadow-md">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-center">Your Shopping Cart</h1>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div id="cart-container" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div id="cart-items" class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Cart items will be dynamically inserted here -->
                </div>
            </div>
            <div class="lg:col-span-1">
                <div id="cart-summary" class="bg-white rounded-lg shadow-md p-6">
                    <!-- Cart summary will be dynamically inserted here -->
                </div>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../handlers/cartHandler/cart.js"></script>
</body>
</html>