<?php
session_start();
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un client
if ($_SESSION['role'] !== 'client') {
    echo "Accès refusé.";
    exit;
}

// Récupérer les commandes du client
$query = "SELECT * FROM commandes WHERE client_id = '{$_SESSION['user_id']}'";
$result = mysqli_query($connection, $query);
?>

<h1>Mes Commandes</h1>

<table>
    <thead>
        <tr>
            <th>ID Commande</th>
            <th>Produit(s)</th>
            <th>Quantité</th>
            <th>Prix Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($order = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['products']; ?></td> <!-- Détail des produits -->
                <td><?php echo $order['quantities']; ?></td>
                <td><?php echo number_format($order['total_price'], 2); ?> €</td>
                <td><?php echo $order['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
