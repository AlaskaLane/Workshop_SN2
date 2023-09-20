<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["pseudo"])) {
    header("Location: login.html"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Inclure le fichier de connexion à la base de données (db.php)
include("db.php");

// Récupérer le nom d'utilisateur de la session
$pseudo = $_SESSION["pseudo"];

// Récupérer le statut de modérateur de l'utilisateur depuis la base de données
$sql = "SELECT moderateur FROM compte WHERE pseudo = '$pseudo'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $statutMod = (int)$row["moderateur"];
    
    if ($statutMod === 1) {
        $statut = "Modérateur";
    } else {
        $statut = "Utilisateur Standard";
    }
} else {
    // En cas d'erreur, considérer l'utilisateur comme un utilisateur standard
    $statut = "Utilisateur Standard";
}
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
        <h2>Bienvenue, <?php echo $pseudo; ?>!</h2>
        <p>Statut : <?php echo $statut; ?></p>
        
        <?php if ($statutMod === 1) { ?>
            <!-- Section pour les modérateurs -->
            <p>Vous avez des fonctionnalités de modérateur.</p>
            <!-- Ajoutez ici les fonctionnalités spécifiques aux modérateurs -->
        <?php } else { ?>
            <!-- Section pour les utilisateurs standards -->
            <p>Vous avez des fonctionnalités d'utilisateur standard.</p>
            <!-- Ajoutez ici les fonctionnalités spécifiques aux utilisateurs -->
        <?php } ?>
        <p id="blocliens">
        <a href="logout.php"id="lienpres">Déconnexion</a>
        <a href="reset-password.html"id="lienpres">Réinitialiser votre mot de passe</a>
        <a href="../felicitation.html"id="lienpres">Validation de module</a>
        <a href="../index.html"id="lienpres">Accueil</a>
        </p>
    </div>
</body>

</html>
