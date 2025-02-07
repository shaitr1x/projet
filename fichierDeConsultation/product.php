<?php
include('db_connect.php');
$id_produit = $_GET['id'];

$query = "SELECT * FROM produits WHERE id_produit = '$id_produit'";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['nom']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Mon E-Commerce</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="cart.php">Panier</a></li>
            </ul>
        </nav>
    </header>

    <section class="product-detail">
        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['nom']; ?>">
        <div class="product-info">
            <h2><?php echo $product['nom']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <p><strong><?php echo $product['prix']; ?>€</strong></p>
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="id_produit" value="<?php echo $product['id_produit']; ?>">
                <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['quantite_stock']; ?>">
                <button type="submit">Ajouter au panier</button>
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Mon E-Commerce. Tous droits réservés.</p>
    </footer>
</body>
</html>
