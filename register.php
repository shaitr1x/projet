<?php
session_start();

// Inclure la connexion à la base de données
include('db_connect.php');

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Choix entre 'client' ou 'commercant'
    $nom = $_POST['nom'];
    $numero=$_POST['numero'];
    $adresse=$_POST['adresse'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    // Insérer l'utilisateur dans la base de données
    $query = "INSERT INTO utilisateurs (nom,email,mot_de_passe,role,telephone,adresse) VALUES ('$nom','$email','$hashedPassword','$role','$numero','$adresse')";
    if ($conn->query($query)) {
        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="banner">
        <h1>Inscription</h1>
    </div>
    <div class="container">
        <h2>Créer un compte</h2>
        <form action="register.php" method="POST">
            <label for="role">Rôle :</label>
            <select name="role" id="role">
                <option value="client">Client</option>
                <option value="commercant">Commerçant</option>
                <option value="administrateur">Administrateur</option>
            </select>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Votre adresse email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Créer un mot de passe" required>
            <label for="adresse">Adresse :</label>
            <select name="adresse" id="adresse">
                <option value="yaounde">Yaoundé</option>
                <option value="douala">Douala</option>
                <option value="bertoua">Bertoua</option>
                <option value="ngaoundere">Ngaoundéré</option>
            </select>
            <label for="numero">Numéro de téléphone :</label>
            <input type="text" id="numero" name="numero" placeholder="Votre numéro de téléphone" required>
            <button type="submit">Créer un compte</button>
            <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous</a></p>
        </form>  
    </div>
</body>
</html>

