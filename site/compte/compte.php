<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["pseudo"])) {
    header("Location: login.html"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Inclure le fichier de connexion à la base de données
include("db.php");

// Récupérer le nom d'utilisateur de la session
$pseudo = $_SESSION["pseudo"];

// Récupérer le niveau de l'utilisateur depuis la base de données (supposez que vous ayez une table "utilisateurs" avec une colonne "niveau")
$sql = "SELECT niveau FROM utilisateurs WHERE pseudo = '$pseudo'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $niveau = $row["niveau"];
} else {
    $niveau = "N/A"; // En cas d'erreur
}

// Récupérer les badges de récompense de l'utilisateur depuis la base de données (supposez que vous ayez une table "badges" avec une colonne "utilisateur_id" pour lier les badges aux utilisateurs)
$sql_badges = "SELECT nom_badge FROM badges WHERE utilisateur_id = '$pseudo'";
$result_badges = mysqli_query($conn, $sql_badges);
$badges = [];

if ($result_badges) {
    while ($badge_row = mysqli_fetch_assoc($result_badges)) {
        $badges[] = $badge_row["nom_badge"];
    }
} else {
    $badges[] = "Aucun badge pour le moment"; // En cas d'erreur
}

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
        <p>Votre niveau actuel : <?php echo $niveau; ?></p>
        <h3>Vos badges de récompense :</h3>
        <ul>
            <?php foreach ($badges as $badge) { ?>
                <li><?php echo $badge; ?></li>
            <?php } ?>
        </ul>
        <p id="blocliens">
            <a href="logout.php" id="lienpres">Déconnexion</a>
            <a href="reset-password.html" id="lienpres">Réinitialiser votre mot de passe</a>
            <a href="site\index.html" id="lienpres">Accueil</a>
        </p>
    </div>
</body>
</html>
