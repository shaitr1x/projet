<?php
session_start();

if (isset($_GET['id_produit'])) {
    $id_produit = $_GET['id_produit'];

    // Rechercher le produit dans le panier et le supprimer
    foreach ($_SESSION['panier'] as $index => $item) {
        if ($item['id_produit'] == $id_produit) {
            unset($_SESSION['panier'][$index]);
            break;
        }
    }

    // Réindexer le tableau après suppression
    $_SESSION['panier'] = array_values($_SESSION['panier']);
    echo "Produit supprimé du panier.";
    header('Location: cart.php');
}
?>
