<?php
$host = 'localhost'; // Ou l'adresse de ton serveur de base de données
$username = 'root';  // Nom d'utilisateur de ta base de données
$password = '';      // Mot de passe de ta base de données
$db_name = 'ecommerce'; // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($host, $username, $password, $db_name);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}
?>
