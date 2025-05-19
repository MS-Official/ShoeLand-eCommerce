<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoeland Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .bg-orange-custom {
            background-color: #FF6600;
        }

        .text-orange-custom {
            color: #FF6600;
        }

        .border-orange-custom {
            border-color: #FF6600;
        }

        .hover\:bg-orange-custom:hover {
            background-color: #FF8533;
        }
    </style>
</head>

<body class="bg-white text-gray-800">
    <!-- Header Section -->
    <?php include '../includes/header.php'; ?>

    <header class="bg-orange-custom text-white shadow-md">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-center">Shoeland Products</h1>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            <input type="text" id="search" placeholder="Search by product name..." class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-custom">
            <select id="size-filter" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-custom">
                <option value="">Filter by size</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
            </select>
            <div class="flex items-center space-x-2">
                <input type="number" id="min-price" placeholder="Min Price" class="w-1/2 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-custom">
                <input type="number" id="max-price" placeholder="Max Price" class="w-1/2 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-custom">
            </div>
        </div>
        <div class="mb-8 flex justify-between items-center">
            <button id="apply-filters" class="px-6 py-2 bg-orange-custom text-white rounded-md hover:bg-orange-custom transition duration-300 ease-in-out">Apply Filters</button>
            <select id="sort-options" class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-custom">
                <option value="">Sort by</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="name_asc">Name: A to Z</option>
                <option value="name_desc">Name: Z to A</option>
            </select>
        </div>
        <div id="product-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8"></div>
        <div id="loading" class="text-center py-4 hidden">
            <i class="fas fa-spinner fa-spin text-4xl text-orange-custom"></i>
        </div>
    </main>

    <div id="quick-view-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg max-w-2xl w-full">
            <div id="quick-view-content"></div>
            <button id="close-quick-view" class="mt-4 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition duration-300 ease-in-out">Close</button>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <!-- External JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script src="../handlers/productHandler/product.js"></script>
</body>

</html>