<?php
session_start();
include('includes/db_connection.php');

if (empty($_SESSION['cart'])) {
    echo "Votre panier est vide.";
    exit;
}

// Récupérer les détails de la commande (client, produits, etc.)
$user_id = $_SESSION['user_id'];  // Id de l'utilisateur connecté
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// Insérer la commande dans la table commandes
$query = "INSERT INTO commandes (user_id, total_price, status, date_ordered) VALUES ('$user_id', '$total_price', 'En attente', NOW())";
$result = mysqli_query($connection, $query);

if ($result) {
    // Obtenir l'ID de la commande nouvellement insérée
    $order_id = mysqli_insert_id($connection);

    // Insérer les produits de la commande dans la table order_products
    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['id'];
        $quantity = $item['quantity'];
        $product_price = $item['price'];

        $query = "INSERT INTO order_products (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$product_price')";
        mysqli_query($connection, $query);
    }

    // Vider le panier après la commande
    unset($_SESSION['cart']);

    // Rediriger vers la page de confirmation de commande
    header("Location: order_confirmation.php?order_id=$order_id");
} else {
    echo "Erreur lors de la création de la commande.";
}
?>
