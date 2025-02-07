<?php
session_start();
include('db_connect.php');

// Vérification si le commerçant ou client est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    echo "Accès interdit.";
    exit();
}

$id_utilisateur = $_SESSION['id_utilisateur'];
$message = $_POST['message'];  // Le message de notification

// Ajouter la notification dans la base de données
$query = "INSERT INTO notifications (id_utilisateur, message, date_ajout) 
          VALUES ('$id_utilisateur', '$message', NOW())";

if (mysqli_query($conn, $query)) {
    echo "Notification ajoutée avec succès!";
} else {
    echo "Erreur lors de l'ajout de la notification.";
}
?>
