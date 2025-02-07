<?php
session_start();

// Inclure la connexion à la base de données
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un administrateur
if ($_SESSION['role'] != 'admin') {
    echo "Accès interdit.";
    exit;
}

// Ajouter une catégorie
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];

    $query = "INSERT INTO categories (name) VALUES ('$category_name')";
    $conn->query($query);
    echo "Catégorie ajoutée avec succès!";
}

// Récupérer les catégories existantes
$query = "SELECT * FROM categories";
$result = $conn->query($query);
?>

<h2>Gestion des Catégories</h2>

<!-- Formulaire pour ajouter une catégorie -->
<form method="POST">
    <input type="text" name="category_name" placeholder="Nom de la catégorie" required>
    <button type="submit" name="add_category">Ajouter la catégorie</button>
</form>

<!-- Afficher la liste des catégories -->
<h3>Catégories existantes</h3>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($category = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $category['name'] ?></td>
                <td>
                    <a href="delete_category.php?id=<?= $category['id'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
