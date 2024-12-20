<?php
session_start();
include('includes/db_connection.php');

$order_id = $_GET['order_id'];

// Récupérer les informations de la commande
$query = "SELECT * FROM commandes WHERE order_id = '$order_id'";
$result = mysqli_query($connection, $query);
$order = mysqli_fetch_assoc($result);

// Récupérer les produits associés à cette commande
$query_products = "SELECT * FROM order_products WHERE order_id = '$order_id'";
$result_products = mysqli_query($connection, $query_products);
?>

<h1>Détails de la Commande #<?php echo $order['order_id']; ?></h1>

<p>Date de la commande: <?php echo date('d-m-Y', strtotime($order['date_ordered'])); ?></p>
<p>Status: <?php echo $order['status']; ?></p>
<p>Total: <?php echo number_format($order['total_price'], 2); ?> €</p>

<h2>Produits</h2>
<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($product = mysqli_fetch_assoc($result_products)): ?>
            <?php
            // Récupérer le produit
            $product_query = "SELECT * FROM produits WHERE product_id = '{$product['product_id']}'";
            $product_result = mysqli_query($connection, $product_query);
            $product_info = mysqli_fetch_assoc($product_result);
            ?>
            <tr>
                <td><?php echo $product_info['name']; ?></td>
                <td><?php echo $product['quantity']; ?></td>
                <td><?php echo number_format($product_info['price'], 2); ?> €</td>
                <td><?php echo number_format($product['quantity'] * $product_info['price'], 2); ?> €</td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
