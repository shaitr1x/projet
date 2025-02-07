<?php
session_start();

// Vérification de la session
if (!isset($_SESSION['role']) || !isset($_SESSION['nom'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Commerçant</title>
    <link rel="stylesheet" href="dashboard_commercant.css">
</head>
<body>
    <h1>Bonjour, <?php echo htmlspecialchars($_SESSION['role']); ?> <?php echo htmlspecialchars($_SESSION['nom']); ?>!</h1>
    <p>Qu'allez-vous faire aujourd'hui ?</p>
    <a href="liste_utilisateur.php">Voir la liste des utilisateurs</a><br>
    <a href="liste_produit.php">Liste des produits</a><br>
</body>
</html>
