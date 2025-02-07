<?php
session_start();
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un administrateur
if ($_SESSION['role'] !== 'admin') {
    echo "Accès refusé.";
    exit;
}

// Récupérer toutes les commandes
$query = "SELECT * FROM commandes ORDER BY date_ordered DESC";
$result = mysqli_query($connection, $query);
?>

<h1>Gestion des Commandes</h1>

<table>
    <thead>
        <tr>
            <th>ID Commande</th>
            <th>Date</th>
            <th>Status</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($order = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($order['date_ordered'])); ?></td>
                <td>
                    <form action="update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                        <select name="status">
                            <option value="En attente" <?php if ($order['status'] == 'En attente') echo 'selected'; ?>>En attente</option>
                            <option value="Expédiée" <?php if ($order['status'] == 'Expédiée') echo 'selected'; ?>>Expédiée</option>
                            <option value="Livrée" <?php if ($order['status'] == 'Livrée') echo 'selected'; ?>>Livrée</option>
                        </select>
                        <button type="submit">Mettre à jour</button>
                    </form>
                </td>
                <td><?php echo number_format($order['total_price'], 2); ?> €</td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
