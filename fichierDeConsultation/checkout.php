<?php
session_start();

// Inclure la connexion à la base de données
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un client
if ($_SESSION['role'] != 'client') {
    echo "Accès interdit.";
    exit;
}

// Récupérer les informations du panier
// On suppose que le panier est stocké en session
$cart = $_SESSION['cart']; // Panier sous forme de tableau associatif
$total = 0;
foreach ($cart as $product_id => $quantity) {
    $query = "SELECT * FROM produits WHERE id = '$product_id'";
    $result = $conn->query($query);
    $product = $result->fetch_assoc();
    $total += $product['price'] * $quantity;
}

// Traitement du paiement ici (par exemple, via PayPal ou Stripe)
// Pour cet exemple, on va simuler une réussite de paiement

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // On créer une commande après le paiement
    $query = "INSERT INTO commandes (client_id, product_name, quantity, total_price, status)
              VALUES ({$_SESSION['user_id']}, 'Produit 1', 1, '$total', 'En attente')";
    $conn->query($query);

    echo "Paiement réussi. Votre commande a été enregistrée.";
    // Rediriger vers le suivi des commandes
    header("Location: orders.php");
    exit();
}
?>

<h2>Processus de Paiement</h2>

<p>Total: <?= $total ?>€</p>

<!-- Formulaire de paiement -->
<form action="checkout.php" method="POST">
    <input type="text" name="address" placeholder="Adresse de livraison" required>
    <button type="submit">Payer maintenant</button>
</form>
