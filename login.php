<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "ecommerce");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Ajoute un diagnostic pour afficher les erreurs MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $sql = "SELECT nom,mot_de_passe,role,id_utilisateur FROM utilisateurs WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Vérifie si la préparation a échoué
    if (!$stmt) {
        die("Erreur dans la préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nom, $hashedPassword, $role,$id);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["nom"] = $nom;
            $_SESSION["role"]=$role;
            $_SESSION["id_utilisateur"]=$id;

            if ($role === "client") {
                header("Location: Espaceclient.php");
                exit;
            } elseif ($role === "commercant") {
                header("Location: dashboard_commercant.php");
                exit;
            }
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Email ou mot de passe incorrect.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="banner">
        <h1>Connexion</h1>
    </div>
    <div class="container">
        <h2>Se connecter</h2>
        <form action="login.php" method="POST">
            <label for="email">Adresse Email :</label>
            <input type="email" id="email" name="email" placeholder="Votre adresse email" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            
            <button type="submit">Se connecter</button>
            
            <p>Vous n'avez pas de compte ? <a href="register.php">Inscrivez-vous</a></p>
        </form>
    </div>
</body>
</html>