<?php
session_start();

// Ajouter au panier
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Si le panier existe déjà, on ajoute l'article
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Afficher le panier
if (isset($_SESSION['cart'])) {
    echo "<ul>";
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT * FROM produits WHERE id = '$product_id'";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();
        echo "<li>" . $product['nom'] . " - Quantité: $quantity</li>";
    }
    echo "</ul>";
}
?>