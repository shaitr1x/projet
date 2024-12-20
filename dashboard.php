<?php
session_start();
include('db_connect.php');

// Vérification du rôle
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['role'] !== 'commercant') {
    echo "Accès interdit.";
    exit;
}

$id_commercant = $_SESSION['id_utilisateur'];
$query = "SELECT * FROM produits WHERE id_commercant = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_commercant);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="commercant.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Tableau de Bord</h1>
        </div>
    </header>
    
    <main class="main-content">
        <div class="actions">
            <a href="add_product.php" class="btn">Ajouter un nouveau produit</a>
        </div>

        <h2>Vos Produits</h2>
        <div class="table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nom']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['prix']); ?>€</td>
                            <td><?php echo htmlspecialchars($row['quantite_stock']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Produit"></td>
                            <td>
                                <a href="update_stock.php?id=<?php echo $row['id_produit']; ?>" class="btn">Modifier</a>
                                <a href="delete_product.php?id=<?php echo $row['id_produit']; ?>" class="btn">Supprimer</a>
                            </td>
                        </tr>
                        <?php if ($row['quantite_stock'] < 5): ?>
                            <tr class="low-stock-warning">
                                <td colspan="6">Attention : Stock faible (<?php echo $row['quantite_stock']; ?>)</td>
                            </tr>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
