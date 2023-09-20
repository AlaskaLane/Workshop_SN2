<?php
session_start();

// Vérifiez si le modérateur est connecté
if (!isset($_SESSION["pseudo_mod"])) {
    header("Location: login.html"); // Redirigez vers la page de connexion si le modérateur n'est pas connecté
    exit();
}

// Incluez le fichier de connexion à la base de données (db.php)
include("db.php");

// Récupérez le nom d'utilisateur du modérateur depuis la session
$pseudo_mod = $_SESSION["pseudo_mod"];

// Récupérez les informations du modérateur depuis la base de données
$sql = "SELECT * FROM utilisateurs WHERE pseudo = '$pseudo_mod'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    // Affichez les informations spécifiques aux modérateurs
    echo "<h1>Bienvenue, " . $row["pseudo"] . " (Modérateur)</h1>";
    // Affichez ici les fonctionnalités spécifiques aux modérateurs
    echo "<p>Fonctionnalités pour les modérateurs.</p>";
} else {
    echo "Erreur de base de données.";
}
?>
<!-- Ajoutez ici le reste du contenu de la page -->
