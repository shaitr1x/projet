<?php
session_start();

// Inclure la connexion à la base de données
include('includes/db_connection.php');

// Vérifier si l'utilisateur est un commerçant
if ($_SESSION['role'] != 'commercant') {
    echo "Accès interdit.";
    exit;
}

// Vérifier si l'ID de la commande est passé en paramètre
if (!isset($_GET['order_id'])) {
    echo "Commande non trouvée.";
    exit;
}

$order_id = $_GET['order_id'];

// Récupérer les informations de la commande
$query = "SELECT * FROM commandes WHERE order_id = '$order_id'";
$result = $conn->query($query);
$order = $result->fetch_assoc();

// Traitement de la mise à jour du statut de la commande
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];

    // Mettre à jour le statut de la commande
    $query = "UPDATE commandes SET status = '$status' WHERE order_id = '$order_id'";
    $conn->query($query);

    echo "Statut de la commande mis à jour.";
    header("Location: orders_commercant.php");
    exit();
}
?>

<h2>Mettre à jour le statut de la commande</h2>

<form action="update_order.php?order_id=<?= $order_id ?>" method="POST">
    <label for="status">Statut</label>
    <select name="status">
        <option value="En attente" <?= $order['status'] == 'En attente' ? 'selected' : '' ?>>En attente</option>
        <option value="En préparation" <?= $order['status'] == 'En préparation' ? 'selected' : '' ?>>En préparation</option>
        <option value="Expédiée" <?= $order['status'] == 'Expédiée' ? 'selected' : '' ?>>Expédiée</option>
        <option value="Livrée" <?= $order['status'] == 'Livrée' ? 'selected' : '' ?>>Livrée</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>
