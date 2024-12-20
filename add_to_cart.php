<?php
session_start();

// Vérifier si le panier existe déjà
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Vérifier si les données sont envoyées via GET
if (isset($_GET['productId'], $_GET['productName'], $_GET['productPrice'])) {
    $productId = $_GET['productId'];
    $productName = $_GET['productName'];
    $productPrice = $_GET['productPrice'];

    // Vérifier si le produit est déjà dans le panier
    $found = false;
    foreach ($_SESSION['cart'] as &$product) {
        if ($product['id'] === $productId) {
            $product['quantity']++;
            $found = true;
            break;
        }
    }

    // Si le produit n'est pas encore dans le panier, l'ajouter
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1
        ];
    }
}

// Retourner le panier actuel
echo json_encode($_SESSION['cart']);
?>
