<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["pseudo"])) {
    header("Location: index.html"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Inclure le fichier de connexion à la base de données
include("db.php");

// Récupérer le nom d'utilisateur de la session
$pseudo = $_SESSION["pseudo"];

// Vous pouvez ajouter d'autres fonctionnalités ici, comme afficher les données de l'utilisateur, des liens vers d'autres pages, etc.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="compte.css">
    <title>Gestion Compte</title>
</head>
<body>
    <div class="container">
        <h2>Bienvenue, <?php echo $pseudo; ?>, tu es plus intelligent que Brutus félicitations !</h2>
        <p id="txtpres">C'est votre page de gestion de compte.</p>
        <p id="blocliens">
            <a href="logout.php"id="lienpres">Déconnexion</a>
            <a href="reset-password.html"id="lienpres">Réinitialiser votre mot de passe</a>
            <a href="site\index.html"id="lienpres">Accueil</a>
        </p>
    </div>
</body>
</html>
