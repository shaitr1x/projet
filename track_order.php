<?php
session_start();

// Inclure la connexion à la base de données
include('includes/db_connection.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Veuillez vous connecter pour suivre vos commandes.";
    exit;
}

// Vérifier si l'ID de la commande est passé en paramètre
if (!isset($_GET['order_id'])) {
    echo "Commande non trouvée.";
    exit;
}

$order_id = $_GET['order_id'];

// Récupérer les informations de la commande
$query = "SELECT * FROM commandes WHERE order_id = '$order_id' AND client_id = {$_SESSION['user_id']}";
$result = $conn->query($query);
$order = $result->fetch_assoc();

if (!$order) {
    echo "Commande non trouvée.";
    exit;
}
?>

<h2>Suivi de ma commande</h2>

<p><strong>Numéro de commande :</strong> <?= $order['order_id'] ?></p>
<p><strong>Montant total :</strong> <?= $order['total'] ?>€</p>
<p><strong>Statut :</strong> <?= $order['status'] ?></p>
