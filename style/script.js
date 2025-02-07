// Gestion du menu burger
const burgerMenu = document.getElementById('burger-menu');
const navBar = document.querySelector('.nav-bar');

burgerMenu.addEventListener('click', () => {
    navBar.classList.toggle('active');
});

// Fonction de recherche dynamique (affiche les produits sur la page)
function searchProducts() {
    const query = document.getElementById('search-input').value.toLowerCase();
    const productItems = document.querySelectorAll('.product-item');

    productItems.forEach(item => {
        const productName = item.querySelector('h3').textContent.toLowerCase();
        item.style.display = productName.includes(query) ? 'block' : 'none';
    });
}

// Fonction de recherche via Ajax
function searchProductsAjax() {
    const query = document.getElementById('search-input').value;

    if (query.length > 0) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `search_products.php?query=${query}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById('product-list').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    } else {
        document.getElementById('product-list').innerHTML = '';
    }
}

// Gestion du panier
let cart = []; // Tableau pour stocker les produits du panier

// Ajouter un produit au panier
function addToCart(productId, productName, productPrice) {
    const existingProduct = cart.find(item => item.id === productId);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
    }

    updateCart();
}

// Mise à jour de l'affichage du panier
function updateCart() {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    cartItems.innerHTML = '';

    let total = 0;
    cart.forEach(item => {
        const li = document.createElement('li');
        li.textContent = `${item.name} x${item.quantity} - €${(item.price * item.quantity).toFixed(2)}`;
        cartItems.appendChild(li);

        total += item.price * item.quantity;
    });

    cartTotal.textContent = `Total: €${total.toFixed(2)}`;

    // Afficher ou masquer le panier en fonction de son contenu
    document.querySelector('.cart-container').style.display = cart.length > 0 ? 'block' : 'none';
}

// Gestion des boutons "Ajouter au panier"
function handleAddToCart(event) {
    const button = event.target;
    const productId = button.getAttribute('data-id');
    const productName = button.getAttribute('data-name');
    const productPrice = parseFloat(button.getAttribute('data-price'));

    addToCart(productId, productName, productPrice);
}

document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', handleAddToCart);
});
