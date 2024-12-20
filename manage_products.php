<?php
session_start();
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un commerçant
if ($_SESSION['role'] !== 'commercant') {
    echo "Accès refusé.";
    exit;
}

// Récupérer les produits du commerçant
$query = "SELECT * FROM produits WHERE merchant_id = '{$_SESSION['user_id']}'";
$result = mysqli_query($connection, $query);
?>

<h1>Mes Produits</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($product = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><?php echo number_format($product['price'], 2); ?> €</td>
                <td><?php echo $product['stock']; ?></td>
                <td><?php echo $product['category_id']; ?></td>
                <td>
                    <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Modifier</a> |
                    <a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="add_product.php">Ajouter un nouveau produit</a>
