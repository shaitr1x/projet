<?php
session_start();
include('db_connect.php');

// Vérification si le client est connecté
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['role'] != 'client') {
    echo "Accès interdit.";
    exit();
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer les produits dans le panier
$query = "SELECT * FROM panier p JOIN produits pr ON p.id_produit = pr.id_produit WHERE p.id_utilisateur = '$id_utilisateur'";
$result = mysqli_query($conn, $query);

$total = 0;
$produits_commande = [];
while ($row = mysqli_fetch_assoc($result)) {
    $produits_commande[] = [
        'id_produit' => $row['id_produit'],
        'quantite' => $row['quantite'],
        'prix' => $row['prix']
    ];
    $total += $row['quantite'] * $row['prix'];
}

// Enregistrer la commande dans la base de données
$query = "INSERT INTO commandes (id_utilisateur, total, statut) VALUES ('$id_utilisateur', '$total', 'En attente')";
if (mysqli_query($conn, $query)) {
    $id_commande = mysqli_insert_id($conn);

    // Enregistrer les produits dans la commande
    foreach ($produits_commande as $produit) {
        $query = "INSERT INTO commande_produits (id_commande, id_produit, quantite) 
                  VALUES ('$id_commande', '{$produit['id_produit']}', '{$produit['quantite']}')";
        mysqli_query($conn, $query);
    }

    // Vider le panier
    $query = "DELETE FROM panier WHERE id_utilisateur = '$id_utilisateur'";
    mysqli_query($conn, $query);

    echo "Commande confirmée. Merci pour votre achat!";
} else {
    echo "Erreur lors du traitement de la commande.";
}
?>
