<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUL - Избранное</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>  
         .logo_img {
            height: 70px;
            width: auto;
            opacity: 0.9;
        }
</style>
<body>
     <header>
        <div class="header-container">
            <div class="header-left">
                <a href="index.php" class="logo-link">
                    <img class="logo_img" src="img/header_img/stud_logo.png" alt="STUL">
                </a>
                <nav class="menu">
                    <a href="catalog.html">Каталог</a>
                    <a href="delivery.html">Доставка</a>
                    <a href="about.html">О нас</a>
                </nav>
            </div>
            <div class="header-right">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Поиск">
                    <img src="img/header_img/search_logo.png" alt="Поиск" class="search-icon">
                </div>
                <div class="icon-group">
                    <img src="img/header_img/user_logo.png" alt="Войти" class="header-icon user-icon">
                    <img src="img/header_img/favorite_logo.png" alt="Избранное" class="header-icon favorites-icon">
                    <div class="basket-icon" id="cartIcon">
                        <img src="img/header_img/backet_logo.png" alt="Корзина">
                        <span class="cart-count" id="cartCount">0</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="favorites-page">
        <h1>Избранное</h1>
        <div class="favorites-grid" id="favoritesGrid"></div>
    </main>

    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>Корзина</h3>
            <span class="close-cart" onclick="closeCart()">&times;</span>
        </div>
        <div class="cart-items" id="cartItems"></div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Итого:</span>
                <span id="cartTotal">0 ₽</span>
            </div>
            <button class="checkout-btn" onclick="checkout()">Оформить заказ</button>
        </div>
    </div>

    <div class="auth-modal" id="authModal">
        <div class="auth-modal-content">
            <span class="close-btn">&times;</span>
            <h2>Авторизация / Регистрация</h2>
            <form>
                <input type="text" placeholder="Имя" required>
                <input type="tel" placeholder="Телефон" required>
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Пароль" required>
                <div class="form-buttons">
                    <button type="submit" class="register-btn">Зарегистрироваться</button>
                    <button type="button" class="login-btn">Войти</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function displayFavorites() {
            const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            const grid = document.getElementById('favoritesGrid');
            
            if (favorites.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state">
                        <p>В избранном пока нет товаров</p>
                        <a href="catalog.html">Перейти в каталог</a>
                    </div>
                `;
                return;
            }
            
            let html = '';
            favorites.forEach(item => {
                html += `
                    <div class="product-card" onclick="location.href='product.html?id=${item.id}'">
                        <img src="${item.image}" alt="${item.name}">
                        <h3>${item.name}</h3>
                        <p class="price">${item.price.toLocaleString()} ₽</p>
                        <button class="add-to-cart-small" onclick="event.stopPropagation(); addToCart(${JSON.stringify(item).replace(/"/g, '&quot;')})">
                            В корзину
                        </button>
                    </div>
                `;
            });
            
            grid.innerHTML = html;
        }

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
        }

        function updateCartCount() {
            const count = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);
            document.getElementById('cartCount').textContent = count;
        }

        function updateCartDisplay() {
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            
            if (cart.length === 0) {
                cartItems.innerHTML = '<p style="text-align: center; color: #999;">Корзина пуста</p>';
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
                            <div>Количество: ${item.quantity || 1}</div>
                        </div>
                        <button class="cart-item-remove" onclick="removeFromCart('${item.id}')">&times;</button>
                    </div>
                `;
            });
            
            cartItems.innerHTML = html;
            cartTotal.textContent = total.toLocaleString() + ' ₽';
        }

        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            updateCartDisplay();
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

        document.querySelector('.user-icon').addEventListener('click', function() {
            document.getElementById('authModal').style.display = 'flex';
        });

        document.querySelectorAll('.close-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('authModal').style.display = 'none';
            });
        });

        document.getElementById('cartIcon').addEventListener('click', function() {
            openCart();
        });

        document.querySelector('.favorites-icon').addEventListener('click', function() {
            window.location.href = 'favorites.html';
        });

        window.addEventListener('click', function(e) {
            if (e.target === document.getElementById('authModal')) {
                document.getElementById('authModal').style.display = 'none';
            }
        });

        displayFavorites();
        updateCartCount();
        updateCartDisplay();
    </script>
</body>
</html>