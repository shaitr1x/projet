<?php
session_start();
// Inclure la connexion à la base de données
include('../db_connect.php'); // Assurez-vous d'avoir votre fichier de connexion à la DB

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérer les valeurs du formulaire
    $id=$_SESSION["id_utilisateur"];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $quantite_stock = $_POST['quantite_stock'];
    $categorie = $_POST['categorie'];
    $image = $_FILES['image']['name']; // Nom de l'image téléchargée
    $image_tmp = $_FILES['image']['tmp_name']; // Temporaire image

    // Déplacer l'image téléchargée vers le dossier souhaité (par exemple "uploads/")
    if ($image) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($image_tmp, $target_file);
    }

    // Préparer la requête SQL pour insérer le produit dans la base de données
    $query = "INSERT INTO produits (id_commercant,nom, description, prix, quantite_stock, categorie, image) 
              VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issdiss", $id,$nom, $description, $prix, $quantite_stock, $categorie, $image);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Le produit a été ajouté avec succès.";
        header("location:dashboard.php");
    } else {
        echo "Erreur lors de l'ajout du produit.";
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="add_produit.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <h1>Ajouter un Produit</h1>
        </div>
        <a href="dashboard.php">afficher_produit</a>
    </header>

    <!-- Formulaire -->
    <section class="form-section">
        <form action="add_product.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label for="nom">Nom du produit</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="input-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="input-group">
                <label for="prix">Prix</label>
                <input type="number" id="prix" name="prix" step="0.01" required>
            </div>

            <div class="input-group">
                <label for="quantite_stock">Quantité en stock</label>
                <input type="number" id="quantite_stock" name="quantite_stock" required>
            </div>

            <div class="input-group">
                <label for="categorie">Catégorie</label>
                <input type="text" id="categorie" name="categorie">
            </div>

            <div class="input-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" required>
            </div>

            <button type="submit" class="submit-btn" name="submit">Ajouter</button>
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Mon E-commerce</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>

