<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon E-commerce</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <h1>Mon E-commerce</h1>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="product.php">Produits</a></li>
                <li><a href="categories.php">Catégories</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="logout.php">Deconnexion</a></li>
            </ul>
            <!-- Menu burger pour mobile -->
            <div class="burger-menu" id="burger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>

        <!-- Zone de recherche -->
        <div class="search-bar">
        <form action="search.php" method="POST">
    <input type="text" name="search" placeholder="Rechercher des produits..." required>
    <button type="submit">🔍</button>
</form>

        </div>
    </header>

    <!-- Bannière -->
    <section class="banner">
        <?php
        session_start();
       echo"<h2>Bienvenue sur notre site e-commerce  $_SESSION[nom]</h2>";
        ?>
        <p>Des produits exceptionnels à des prix incroyables !</p>
    </section>

    <!-- Catégories -->
    <section class="categories" id="categories">
        <h3>Catégories Populaires</h3>
        <div class="category-list">
            <div class="category-item">
                <img src="OIF.jpeg" alt="Vêtements">
                <h4>Vêtements</h4>
            </div>
            <div class="category-item">
                <img src="R.jpeg" alt="Électronique">
                <h4>Électronique</h4>
            </div>
            <div class="category-item">
                <img src="OIx.jpeg" alt="Accessoires">
                <h4>Accessoires</h4>
            </div>
        </div>
    </section>

    <!-- Liste des produits -->
    <section class="products" id="product-list">
        <h3>Produits</h3>
        <!-- Les produits seront ajoutés ici dynamiquement via JavaScript -->
    </section>

    <!-- Panier d'achat -->
    <section class="cart-container">
        <h3>Votre Panier</h3>
        <ul id="cart-items"></ul>
        <div id="cart-total"></div>
        <button id="checkout-btn">Passer à la caisse</button>
    </section>

    <!-- Liste des produits -->
    <section class="products" id="product-list">
        <h3>Produits</h3>
        <div class="product-item">
            <img src="OIP.jpg" alt="Produit">
            <h3>Produit 1</h3>
            <p>Prix : 19.99€</p>
            <button class="add-to-cart-btn">Ajouter au panier</button>
        </div>
        <div class="product-item">
            <img src="OIP2.jpeg" alt="Produit">
            <h3>Produit 2</h3>
            <p>Prix : 29.99€</p>
            <button class="add-to-cart-btn">Ajouter au panier</button>
        </div>
        <!-- Plus de produits peuvent être ajoutés ici -->
    </section>

    <!-- Panier d'achat -->
    <section class="cart-container">
        <h3>Votre Panier</h3>
        <ul id="cart-items"></ul>
        <div id="cart-total"></div>
        <button id="checkout-btn">Passer à la caisse</button>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
