<?php
session_start();

// Inclure la connexion à la base de données
include('includes/db_connection.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Mettre à jour le statut de la commande dans la base de données
    $query = "UPDATE commandes SET status = '$status' WHERE id = '$order_id'";
    if ($conn->query($query)) {
        echo "Statut de la commande mis à jour avec succès.";
    } else {
        echo "Erreur de mise à jour.";
    }
}
?>
