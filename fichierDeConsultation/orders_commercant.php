<?php
session_start();
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un commerçant
if ($_SESSION['role'] !== 'commercant') {
    echo "Accès refusé.";
    exit;
}

// Récupérer les commandes du commerçant
$query = "SELECT * FROM commandes WHERE merchant_id = '{$_SESSION['user_id']}'";
$result = mysqli_query($connection, $query);
?>

<h1>Mes Commandes</h1>

<table>
    <thead>
        <tr>
            <th>ID Commande</th>
            <th>Client</th>
            <th>Produit(s)</th>
            <th>Quantité</th>
            <th>Prix Total</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($order = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['client_id']; ?></td>
                <td><?php echo $order['products']; ?></td> <!-- Vous pouvez détailler les produits ici -->
                <td><?php echo $order['quantities']; ?></td> <!-- Détails de la quantité -->
                <td><?php echo number_format($order['total_price'], 2); ?> €</td>
                <td><?php echo $order['status']; ?></td>
                <td>
                    <?php if ($order['status'] == 'en attente'): ?>
                        <a href="update_order.php?order_id=<?php echo $order['order_id']; ?>&status=acceptee">Accepter</a> |
                        <a href="update_order.php?order_id=<?php echo $order['order_id']; ?>&status=refusee">Refuser</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
