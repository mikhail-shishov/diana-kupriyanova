let cart = JSON.parse(localStorage.getItem('cart')) || [];
let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

function addToCart(product) {
    const existingItem = cart.find(item => item.id === product.id);
    
    if (existingItem) {
        existingItem.quantity = (existingItem.quantity || 1) + 1;
    } else {
        cart.push({...product, quantity: 1});
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartDisplay();
    showNotification('Товар добавлен в корзину');
    openCart();
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartDisplay();
    showNotification('Товар удален из корзины');
}

function updateCartCount() {
    const cartCount = document.getElementById('cartCount');
    if (cartCount) {
        const count = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
        cartCount.textContent = count;
    }
}

function updateCartDisplay() {
    const cartItems = document.getElementById('cartItems');
    const cartTotal = document.getElementById('cartTotal');
    
    if (!cartItems || !cartTotal) return;
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<p style="text-align: center; color: #999; padding: 20px;">Корзина пуста</p>';
        cartTotal.textContent = '0 ₽';
        return;
    }
    
    let html = '';
    let total = 0;
    
    cart.forEach(item => {
        const itemTotal = item.price * (item.quantity || 1);
        total += itemTotal;
        
        html += `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="cart-item-info">
                    <h4>${item.name}</h4>
                    <div class="cart-item-price">${item.price.toLocaleString()} ₽</div>
                    <div style="font-size: 12px; color: #666;">${item.quantity || 1} шт.</div>
                </div>
                <button class="cart-item-remove" onclick="removeFromCart('${item.id}')">&times;</button>
            </div>
        `;
    });
    
    cartItems.innerHTML = html;
    cartTotal.textContent = total.toLocaleString() + ' ₽';
}

function openCart() {
    document.getElementById('cartSidebar').classList.add('open');
}

function closeCart() {
    document.getElementById('cartSidebar').classList.remove('open');
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification show';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 2000);
}

function checkout() {
    alert('Функция оформления заказа будет доступна в ближайшее время');
}

document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
    updateCartDisplay();

    const userIcon = document.querySelector('.user-icon');
    const favoritesIcon = document.querySelector('.favorites-icon');
    const cartIcon = document.getElementById('cartIcon');
    const searchIcon = document.querySelector('.search-icon');
    const searchInput = document.querySelector('.search-input');

    if (userIcon) {
        userIcon.addEventListener('click', function() {
            document.querySelector("#authModal").classList.add("open")
        });
    }

    if (favoritesIcon) {
        favoritesIcon.addEventListener('click', function() {
            window.location.href = 'favorites.php';
        });
    }

    if (cartIcon) {
        cartIcon.addEventListener('click', openCart);
    }

    if (searchIcon && searchInput) {
        searchIcon.addEventListener('click', function() {
            if (searchInput.value.trim()) {
                window.location.href = `catalog.html?search=${encodeURIComponent(searchInput.value)}`;
            }
        });

        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && searchInput.value.trim()) {
                window.location.href = `catalog.html?search=${encodeURIComponent(searchInput.value)}`;
            }
        });
    }
});