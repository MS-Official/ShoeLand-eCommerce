$(document).ready(function () {
    let currentPage = 1;
    let isLoading = false;
    let hasMoreProducts = true;
    let debounceTimer;

    function getPlaceholderImage(productName) {
        return `https://source.unsplash.com/300x300/?shoe,${encodeURIComponent(productName)}`;
    }

    function loadProducts(page, filters = {}) {
        if (isLoading || !hasMoreProducts) return;

        isLoading = true;
        $('#loading').removeClass('hidden');

        $.ajax({
            url: 'http://localhost:8888/ShoeLand-eCommerce/handlers/productHandler/productHandler.php',
            method: 'GET',
            data: { action: 'getProducts', page, ...filters },
            dataType: 'json',
            success: function (response) {
                isLoading = false;
                $('#loading').addClass('hidden');

                if (response.error) {
                    console.error('Server Error:', response.error);
                    showNotification(`Error: ${response.error}`, 'error');
                    return;
                }

                const productContainer = $('#product-container');
                if (page === 1) {
                    productContainer.empty();
                }

                response.products.forEach((product) => {
                    const productCard = `
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl border border-gray-200">
                            <img data-src="${product.image_url || getPlaceholderImage(product.name)}"
                                 alt="${product.name}"
                                 class="lazyload w-full h-48 object-cover"
                                 onerror="this.onerror=null;this.src='${getPlaceholderImage(product.name)}';">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold mb-2 text-gray-800">${product.name}</h2>
                                <p class="text-orange-custom font-bold mb-2">$${parseFloat(product.price).toFixed(2)}</p>
                                <p class="text-sm text-gray-600 mb-2">Size: ${product.size || 'N/A'}</p>
                                <p class="text-sm text-gray-600 mb-4">In Stock: ${product.stock || 'N/A'}</p>
                                <div class="flex justify-between items-center">
                                    <button class="quick-view-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out" data-product-id="${product.id}">Quick View</button>
                                    <button class="add-to-cart-btn px-4 py-2 bg-orange-custom text-white rounded-md hover:bg-orange-custom transition duration-300 ease-in-out" data-product-id="${product.id}">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    `;
                    productContainer.append(productCard);
                });

                hasMoreProducts = response.currentPage < response.totalPages;
                currentPage = response.currentPage;
            },
            error: function (xhr, status, error) {
                isLoading = false;
                $('#loading').addClass('hidden');
                console.error('AJAX Error:', status, error);
                console.error('Response Text:', xhr.responseText);
                showNotification(`Failed to load products: ${error}`, 'error');
            },
        });
    }

    function showNotification(message, type = 'success') {
        const notificationEl = $(`<div class="fixed bottom-4 right-4 px-6 py-3 rounded-md text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}">${message}</div>`);
        $('body').append(notificationEl);
        setTimeout(() => {
            notificationEl.remove();
        }, 3000);
    }

    function debounce(func, delay) {
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        };
    }

    const debouncedLoadProducts = debounce(function() {
        currentPage = 1;
        hasMoreProducts = true;
        loadProducts(currentPage, getFilters());
    }, 300);

    function getFilters() {
        return {
            search: $('#search').val(),
            size: $('#size-filter').val(),
            minPrice: $('#min-price').val(),
            maxPrice: $('#max-price').val(),
            sort: $('#sort-options').val()
        };
    }

    $('#search, #size-filter, #min-price, #max-price, #sort-options').on('input change', debouncedLoadProducts);

    $(window).on('scroll', debounce(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            loadProducts(currentPage + 1, getFilters());
        }
    }, 200));

    $(document).on('click', '.quick-view-btn', function() {
        const productId = $(this).data('product-id');
        $.ajax({
            url: 'http://localhost:8888/ShoeLand-eCommerce/handlers/productHandler/productHandler.php',
            method: 'GET',
            data: { action: 'quickView', productId: productId },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    showNotification(`Error: ${response.error}`, 'error');
                    return;
                }
                const product = response.product;
                const quickViewContent = `
                    <div class="flex flex-col md:flex-row">
                        <img src="${product.image_url || getPlaceholderImage(product.name)}" alt="${product.name}" class="w-full md:w-1/2 h-64 object-cover rounded-lg mb-4 md:mb-0 md:mr-4">
                        <div class="w-full md:w-1/2">
                            <h2 class="text-2xl font-bold mb-2 text-gray-800">${product.name}</h2>
                            <p class="text-orange-custom font-bold text-xl mb-2">$${parseFloat(product.price).toFixed(2)}</p>
                            <p class="text-gray-600 mb-2">Size: ${product.size || 'N/A'}</p>
                            <p class="text-gray-600 mb-4">In Stock: ${product.stock || 'N/A'}</p>
                            <p class="text-gray-700">${product.description || 'No description available.'}</p>
                        </div>
                    </div>
                `;
                $('#quick-view-content').html(quickViewContent);
                $('#quick-view-modal').removeClass('hidden');
            },
            error: function(xhr, status, error) {
                showNotification(`Failed to load product details: ${error}`, 'error');
            }
        });
    });

    $('#close-quick-view').on('click', function() {
        $('#quick-view-modal').addClass('hidden');
    });

    $(document).on('click', '.add-to-cart-btn', function() {

        
        const userEmail = sessionStorage.getItem('userEmail'); // Check login status
        if (!userEmail) {
            // SweetAlert popup for login
            Swal.fire({
                title: 'Login Required',
                text: 'Please log in to add products to your cart.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Login',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php'; // Redirect to login page
                }
            });
            return; // Prevent further execution if not logged in
        }


        const productId = $(this).data('product-id');
        $.ajax({
            url: 'http://localhost:8888/ShoeLand-eCommerce/handlers/cartHandler/cartHandler.php',
            method: 'POST',
            data: {
                action: 'addToCart',
                productId: productId,
                quantity: 1
            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    showNotification(`Error: ${response.error}`, 'error');
                    return;
                }
                showNotification('Product added to cart!', 'success');
                updateCartCount();
            },
            error: function(xhr, status, error) {
                showNotification(`Failed to add product to cart: ${error}`, 'error');
            }
        });
    });

    function updateCartCount() {
        $.ajax({
            url: 'http://localhost:8888/ShoeLand-eCommerce/handlers/cartHandler/cartHandler.php',
            method: 'GET',
            data: { action: 'getCart' },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.error('Error fetching cart:', response.error);
                    return;
                }
                const itemCount = response.items.reduce((total, item) => total + item.quantity, 0);
                $('#cart-count').text(itemCount);
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch cart:', error);
                console.error('status.responseText', status.responseText);
                console.error('xhr.responseText', xhr.responseText);
            }
        });
    }

    // Initial load of products
    loadProducts(1);
    updateCartCount();
});
