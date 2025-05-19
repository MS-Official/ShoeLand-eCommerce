$(document).ready(function() {
    console.log("Document is ready. Initializing cart load.");
    // Check if the user is logged in
    const userEmail = sessionStorage.getItem('userEmail');
    if (!userEmail) {
        console.warn("User is not logged in. Redirecting to login page.");
        showNotification('Please log in to access the cart.', 'error');
        setTimeout(() => {
            window.location.href = 'login.php'; // Redirect to the login page
        }, 2000);
        return;
    }

 loadCart();

    function loadCart() {
        console.log("Loading cart data...");
        $.ajax({
            url: 'http://localhost:8888/ShoeLand-eCommerce/handlers/cartHandler/cartHandler.php',
            method: 'GET',
            data: { action: 'getCart' },
            dataType: 'json',
            success: function(response) {
                console.log("Cart data fetched successfully:", response);
                if (response.error) {
                    console.warn("Error in cart response:", response.error);
                    showNotification(response.error, 'error');
                    return;
                }
                updateCartUI(response);
            },
            error: function(xhr, status, error) {
                console.error("Failed to fetch cart. Details:", { xhr, status, error });
                showNotification('Failed to load cart. Please try again later.', 'error');
            }
        });
    }

    function updateCartUI(cartData) {
        console.log("Updating cart UI with data:", cartData);
        const cartItemsContainer = $('#cart-items');
        const cartSummaryContainer = $('#cart-summary');

        cartItemsContainer.empty();
        if (cartData.items.length === 0) {
            console.log("Cart is empty.");
            cartItemsContainer.html('<p class="p-4 text-center">Your cart is empty.</p>');
        } else {
            let itemsHtml = '<table class="w-full"><thead class="bg-gray-100"><tr><th class="p-2 text-left">Product</th><th class="p-2 text-center">Price</th><th class="p-2 text-center">Quantity</th><th class="p-2 text-center">Total</th><th class="p-2 text-center">Action</th></tr></thead><tbody>';
            cartData.items.forEach(item => {
                console.log("Rendering item:", item);

                // Ensure item.price is a valid number before using toFixed
                const price = parseFloat(item.price);
                const quantity = parseInt(item.quantity);
                const total = isNaN(price) || isNaN(quantity) ? 0 : (price * quantity).toFixed(2);
                
                itemsHtml += `
                    <tr class="border-b">
                        <td class="p-2">
                            <div class="flex items-center">
                                <img src="${item.image_url}" alt="${item.name}" class="w-16 h-16 object-cover rounded mr-2">
                                <span>${item.name}</span>
                            </div>
                        </td>
                        <td class="p-2 text-center">$${isNaN(price) ? '0.00' : price.toFixed(2)}</td>
                        <td class="p-2 text-center">
                            <input type="number" class="quantity-input w-16 text-center border rounded" value="${quantity}" min="1" data-product-id="${item.id}">
                        </td>
                        <td class="p-2 text-center">$${total}</td>
                        <td class="p-2 text-center">
                            <button class="remove-item-btn text-red-500 hover:text-red-700" data-product-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            itemsHtml += '</tbody></table>';
            cartItemsContainer.html(itemsHtml);
        }

        // Ensure cart summary values are valid numbers before displaying
        const subtotal = parseFloat(cartData.subtotal) || 0;
        const tax = parseFloat(cartData.tax) || 0;
        const shipping = parseFloat(cartData.shipping) || 0;
        const total = parseFloat(cartData.total) || 0;

        cartSummaryContainer.html(`
            <h2 class="text-2xl font-bold mb-4">Cart Summary</h2>
            <div class="space-y-2 mb-4">
                <p class="flex justify-between"><span>Subtotal:</span> <span>$${subtotal.toFixed(2)}</span></p>
                <p class="flex justify-between"><span>Tax:</span> <span>$${tax.toFixed(2)}</span></p>
                <p class="flex justify-between"><span>Shipping:</span> <span>$${shipping.toFixed(2)}</span></p>
                <p class="flex justify-between font-bold text-lg"><span>Total:</span> <span>$${total.toFixed(2)}</span></p>
            </div>
            <button id="checkout-btn" class="w-full bg-orange-custom text-white py-2 rounded-md hover:bg-orange-600 transition duration-300">Proceed to Checkout</button>
        `);
    }

    $(document).on('change', '.quantity-input', function() {
        const productId = $(this).data('product-id');
        const newQuantity = $(this).val();
        console.log(`Quantity changed for product ID ${productId} to ${newQuantity}.`);
        updateCartItem(productId, newQuantity);
    });

    $(document).on('click', '.remove-item-btn', function() {
        const productId = $(this).data('product-id');
        console.log(`Remove button clicked for product ID ${productId}.`);
        removeCartItem(productId);
    });

    function updateCartItem(productId, quantity) {
        console.log(`Updating cart item. Product ID: ${productId}, Quantity: ${quantity}`);
        $.ajax({
            url: 'http://localhost:8888/ShoeLand-eCommerce/handlers/cartHandler/cartHandler.php',
            method: 'POST',
            data: { 
                action: 'updateCart',
                productId: productId,
                quantity: quantity
            },
            dataType: 'json',
            success: function(response) {
                console.log("Cart item updated successfully:", response);
                if (response.error) {
                    console.warn("Error updating cart item:", response.error);
                    showNotification(response.error, 'error');
                    return;
                }
                loadCart();
                showNotification('Cart updated successfully', 'success');
            },
            error: function(xhr, status, error) {
                console.error("Failed to update cart. Details:", { xhr, status, error });
                showNotification('Failed to update cart. Please try again later.', 'error');
            }
        });
    }

    function removeCartItem(productId) {
        console.log(`Removing cart item. Product ID: ${productId}`);
        $.ajax({
            url: 'http://localhost:8888/ShoeLand-eCommerce/handlers/cartHandler/cartHandler.php',
            method: 'POST',
            data: { 
                action: 'removeFromCart',
                productId: productId
            },
            dataType: 'json',
            success: function(response) {
                console.log("Cart item removed successfully:", response);
                if (response.error) {
                    console.warn("Error removing cart item:", response.error);
                    showNotification(response.error, 'error');
                    return;
                }
                loadCart();
                showNotification('Item removed from cart', 'success');
            },
            error: function(xhr, status, error) {
                console.error("Failed to remove item. Details:", { xhr, status, error });
                showNotification('Failed to remove item. Please try again later.', 'error');
            }
        });
    }

    $(document).on('click', '#checkout-btn', function() {
        console.log("Checkout button clicked. Checkout logic is pending implementation.");
        showNotification('Checkout functionality not implemented yet', 'info');
    });

    
    function showNotification(message, type = 'success') {
        console.log(`Showing notification. Message: ${message}, Type: ${type}`);
        const notificationEl = $(`<div class="fixed bottom-4 right-4 px-6 py-3 rounded-md text-white ${type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'}">${message}</div>`);
        $('body').append(notificationEl);
        setTimeout(() => {
            notificationEl.remove();
        }, 3000);
    }
});
