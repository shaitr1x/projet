<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('db_connect.php'); // de connexion à la DB

if (!isset($_SESSION['id_utilisateur']) || $_SESSION['role'] !== 'administrateur') {
    echo "Accès interdit.";
    exit;
}

$id_commercant = $_SESSION['id_utilisateur'];
$query = "SELECT * FROM utilisateurs";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="commercant.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Tableau de Bord</h1>
        </div>
    </header>
    
    <main class="main-content">
        <h2>Vos utilisateurs</h2>
        <div class="table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>id_utilisateur</th>
                        <th>Nom</th>
                        <th>email</th>
                        <th>adresse</th>
                        <th>telephone</th>
                        <th>role</th>
                        <th>date_inscription</th>
                        <th>statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_utilisateur']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['adresse']); ?></td>
                            <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                             <td><?php echo htmlspecialchars($row['date_inscription']); ?></td>
                            <td><?php echo htmlspecialchars($row['statut']); ?></td>
                            <td><a href="delete_utilisateur.php?id=<?php echo $row['id_utilisateur']; ?>"><img src="uploads/poubelle.jpg" alt="supprime" title="supprimer l'utilisateur"></a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>