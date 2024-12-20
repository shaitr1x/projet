<?php
// Inclure la connexion à la base de données
include('db_connect.php'); // Assurez-vous d'avoir votre fichier de connexion à la DB

// Vérifier si l'ID du produit est passé en paramètre et si le formulaire a été soumis
if (isset($_GET['id'])) {
    $id_produit = $_GET['id'];

    // Si le formulaire est soumis, on met à jour le produit
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $quantite_stock = $_POST['quantite_stock'];
        $categorie = $_POST['categorie'];

        // Préparer la requête SQL pour mettre à jour les informations du produit
        $query = "UPDATE produits SET nom = ?, description = ?, prix = ?, quantite_stock = ?, categorie = ? WHERE id_produit = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdiss", $nom, $description, $prix, $quantite_stock, $categorie, $id_produit);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Le produit a été mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du produit.";
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
    }

    // Récupérer les informations actuelles du produit
    $query = "SELECT * FROM produits WHERE id_produit = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produit);
    $stmt->execute();
    $result = $stmt->get_result();
    $produit = $result->fetch_assoc();
    $stmt->close();

    // Afficher le formulaire de modification avec les valeurs actuelles du produit
    ?>

    <h2>Modifier le produit</h2>
    <form action="update_stock.php?id=<?php echo $id_produit; ?>" method="POST">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $produit['nom']; ?>" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $produit['description']; ?></textarea><br>

        <label for="prix">Prix:</label>
        <input type="number" step="0.01" id="prix" name="prix" value="<?php echo $produit['prix']; ?>" required><br>

        <label for="quantite_stock">Quantité en stock:</label>
        <input type="number" id="quantite_stock" name="quantite_stock" value="<?php echo $produit['quantite_stock']; ?>" required><br>

        <label for="categorie">Catégorie:</label>
        <input type="text" id="categorie" name="categorie" value="<?php echo $produit['categorie']; ?>" required><br>

        <button type="submit" name="submit">Modifier le produit</button>
    </form>

    <?php
} else {
    echo "ID du produit non spécifié.";
}
?>
