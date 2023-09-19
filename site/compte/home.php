<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["username"])) {
    header("Location: index.html"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Inclure le fichier de connexion à la base de données
include("db.php");

// Récupérer le nom d'utilisateur de la session
$username = $_SESSION["username"];

// Vous pouvez ajouter d'autres fonctionnalités ici, comme afficher les données de l'utilisateur, des liens vers d'autres pages, etc.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Page d'accueil</title>
</head>
<body>
    <div class="container">
        <h2>Bienvenue, <?php echo $username; ?> !</h2>
        <p>C'est votre page d'accueil.</p>
        <p><a href="logout.php">Déconnexion</a></p> <!-- Ajoutez un lien pour permettre aux utilisateurs de se déconnecter -->
    </div>
</body>
</html>
