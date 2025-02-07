<?php
// Inclure la connexion à la base de données
include('../db_connect.php'); // Assurez-vous d'avoir votre fichier de connexion à la DB

// Vérifier si l'ID du produit est passé en paramètre
if (isset($_GET['id'])) {
    $id_produit = $_GET['id'];

    // Préparer la requête SQL pour supprimer le produit
    $query = "DELETE FROM produits WHERE id_produit = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produit);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Le produit a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du produit.";
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
} else {
    echo "ID du produit non spécifié.";
}
?>
