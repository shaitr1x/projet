<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard_commercant.css">
</head>
<body>
    <?php
    session_start();
    echo"<h1>bonjour $_SESSION[nom]</h1>";
    ?>
    <p>qu'allez vous faire aujourd'hui!!!</p>
    <a href="add_product.php">ajouter_produit</a><br>
    <a href="dashboard.php">afficher_produit</a>
</body>
</html>