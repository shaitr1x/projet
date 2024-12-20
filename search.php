<?php
// Connexion à la base de données
include('db_connect.php');

// Démarrage de la session pour pouvoir utiliser $_SESSION
session_start();

// Vérification si un texte de recherche est soumis
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];  // Récupère la valeur de la recherche

    // Préparation de la requête SQL pour rechercher par nom ou description
    $query = "SELECT * FROM produits WHERE (nom LIKE ? OR description LIKE ?) AND quantite_stock > 0";
    $stmt = $conn->prepare($query);
    $searchTerm = "%" . $searchQuery . "%";  // Ajoute les wildcards pour la recherche SQL
    $stmt->bind_param("ss", $searchTerm, $searchTerm);  // Bind les paramètres de recherche

    $stmt->execute();
    $result = $stmt->get_result();

    // Affichage des résultats
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-item'>";
            echo "<img src='" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['nom']) . "'>";
            echo "<h3>" . htmlspecialchars($row['nom']) . "</h3>";
            echo "<p>Prix : " . htmlspecialchars($row['prix']) . "€</p>";

            // Formulaire pour ajouter au panier
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='product_id' value='" . $row['product_id'] . "'>";
            echo "<input type='number' name='quantity' value='1' min='1' max='" . $row['quantite_stock'] . "'>";
            echo "<button type='submit' class='add-to-cart-btn'>Ajouter au panier</button>";
            echo "</form>";

            echo "</div>";
        }
    } else {
        echo "<p>Aucun produit trouvé.</p>";
    }
}

// Gestion de l'ajout au panier
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Vérifie si le panier existe déjà dans la session, sinon le créer
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Si le produit est déjà dans le panier, on augmente la quantité
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // Sinon, on l'ajoute au panier
        $_SESSION['cart'][$product_id] = $quantity;
    }

    // Rediriger pour éviter la soumission du formulaire plusieurs fois
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

