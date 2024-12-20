<?php
session_start();
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un administrateur ou un commerçant
if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'commercant') {
    echo "Accès refusé.";
    exit;
}

$order_id = $_GET['order_id'];
$status = $_GET['status'];

// Mettre à jour le statut de la commande
$query = "UPDATE commandes SET status = '$status' WHERE order_id = '$order_id'";
$result = mysqli_query($connection, $query);

if ($result) {
    header("Location: orders_admin.php");  // Ou redirige vers orders_commercant.php si c'est un commerçant
} else {
    echo "Erreur lors de la mise à jour du statut de la commande.";
}
?>
