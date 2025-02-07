<?php
session_start();

// Inclure la connexion à la base de données
include('includes/db_connection.php');

// Vérifier si l'ID de commande est passé dans l'URL
if (!isset($_GET['order_id'])) {
    echo "Aucune commande trouvée.";
    exit;
}

$order_id = $_GET['order_id'];

// Récupérer les informations de la commande
$query = "SELECT * FROM commandes WHERE id = '$order_id'";
$result = $conn->query($query);
$order = $result->fetch_assoc();

if (!$order) {
    echo "Commande non trouvée.";
    exit;
}

// Récupérer les produits associés à la commande
$query = "SELECT * FROM order_items WHERE order_id = '$order_id'";
$result = $conn->query($query);
$order_items = $result->fetch_all(MYSQLI_ASSOC);
?>

<h2>Confirmation de votre commande</h2>
<p>Commande ID: <?= $order['id'] ?></p>
<p>Adresse de livraison: <?= $order['shipping_address'] ?></p>
<p>Méthode de paiement: <?= $order['payment_method'] ?></p>
<p>Status de la commande: <?= $order['status'] ?></p>

<h3>Produits commandés:</h3>
<ul>
    <?php foreach ($order_items as $item): ?>
        <li>
            <?= $item['quantity'] ?> x <?= $item['product_name'] ?> - <?= $item['price'] * $item['quantity'] ?>€
        </li>
    <?php endforeach; ?>
</ul>

<p>Total: <?= $order['total_price'] ?>€</p>

<!-- Vous pouvez ajouter un bouton pour revenir à la page d'accueil ou voir d'autres produits -->
<a href="index.php">Retour à l'accueil</a>
