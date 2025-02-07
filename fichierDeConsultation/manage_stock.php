<?php
session_start();
include('db_connect.php');

// Vérification si le commerçant est connecté
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['role'] != 'commercant') {
    echo "Accès interdit.";
    exit();
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer les produits du commerçant
$query = "SELECT id_produit, nom, quantite_stock FROM produits WHERE id_commercant = '$id_utilisateur'";
$result = mysqli_query($conn, $query);

echo "<h2>Gestion du Stock</h2>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "Produit : " . $row['nom'] . "<br>";
    echo "Quantité en stock : " . $row['quantite_stock'] . "<br>";
    echo "<form method='POST' action='update_stock.php'>
            <input type='hidden' name='id_produit' value='" . $row['id_produit'] . "'>
            <input type='number' name='quantite' value='" . $row['quantite_stock'] . "' min='0'>
            <input type='submit' value='Mettre à jour le stock'>
          </form><hr>";
}
?>
