<?php
// Connexion à la base de données
$mysqli = new mysqli('localhost', 'root', '', 'ecommerce');

if ($mysqli->connect_error) {
    die('Erreur de connexion : ' . $mysqli->connect_error);
}

// Récupérer le terme de recherche
$query = $mysqli->real_escape_string($_GET['query']);

// Requête SQL pour rechercher des produits
$sql = "SELECT * FROM produits WHERE nom LIKE '%$query%'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Afficher les produits correspondant à la recherche
    while ($row = $result->fetch_assoc()) {
        echo '
            <div class="product-item">
                <img src="' . $row['image'] . '" alt="' . $row['nom'] . '">
                <h3>' . $row['nom'] . '</h3>
                <p>Prix : ' . $row['prix'] . '€</p>
                <a href="#">Ajouter au panier</a>
            </div>
        ';
    }
} else {
    echo 'Aucun produit trouvé.';
}

$mysqli->close();
?>
