<?php
// Inclure la connexion à la base de données
include('../db_connect.php'); // Assurez-vous d'avoir votre fichier de connexion à la DB

// Vérifier si l'ID de l'utilisateur est passé en paramètre
if (isset($_GET['id'])) {
    $id_utilisateur = $_GET['id'];

    // Préparer la requête SQL pour supprimer le produit
    $query = "DELETE FROM utilisateurs WHERE id_utilisateur = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_utilisateur);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "L'utilisateur a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du produit.";
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
} else {
    echo "ID de l'utilisateur non spécifié.";
}
?>