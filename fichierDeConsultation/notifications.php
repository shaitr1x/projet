<?php
session_start();
include('db_connect.php');

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    echo "Accès interdit.";
    exit();
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer les notifications de l'utilisateur
$query = "SELECT message, date_ajout FROM notifications WHERE id_utilisateur = '$id_utilisateur' ORDER BY date_ajout DESC";
$result = mysqli_query($conn, $query);

echo "<h2>Mes Notifications</h2>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "Message: " . $row['message'] . "<br>";
    echo "Date: " . $row['date_ajout'] . "<br>";
    echo "<hr>";
}
?>
