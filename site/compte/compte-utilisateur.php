<?php
session_start();

// Vérifiez si l'utilisateur standard est connecté
if (!isset($_SESSION["pseudo"])) {
    header("Location: login.html"); // Redirigez vers la page de connexion si l'utilisateur standard n'est pas connecté
    exit();
}

// Incluez le fichier de connexion à la base de données (db.php)
include("db.php");

// Récupérez le nom d'utilisateur de l'utilisateur standard depuis la session
$pseudo = $_SESSION["pseudo"];

// Récupérez les informations de l'utilisateur standard depuis la base de données
$sql = "SELECT * FROM utilisateurs WHERE pseudo = '$pseudo'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    // Affichez les informations spécifiques aux utilisateurs standards
    echo "<h1>Bienvenue, " . $row["pseudo"] . " (Utilisateur Standard)</h1>";
    // Affichez ici les fonctionnalités spécifiques aux utilisateurs standards
    echo "<p>Fonctionnalités pour les utilisateurs standards.</p>";
} else {
    echo "Erreur de base de données.";
}
?>
<!-- Ajoutez ici le reste du contenu de la page -->
