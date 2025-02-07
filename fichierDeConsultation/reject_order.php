<?php
session_start();

// Inclure la connexion à la base de données
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un commerçant
if ($_SESSION['role'] != 'commercant') {
    echo "Accès interdit.";
    exit;
}

// Vérifier si l'ID de la commande est passé en paramètre
if (!isset($_GET['order_id'])) {
    echo "Commande non trouvée.";
    exit;
}

$order_id = $_GET['order_id'];

// Mettre à jour le statut de la commande
$query = "UPDATE commandes SET status = 'Refusée' WHERE id = '$order_id' AND commerçant_id = {$_SESSION['user_id']}";
$conn->query($query);

echo "Commande refusée avec succès.";
// Rediriger vers la gestion des commandes
header("Location: orders_commercant.php");
exit();
?>
