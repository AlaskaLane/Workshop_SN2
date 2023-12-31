<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $Pseudo = $_POST["pseudo"];
    $Password = $_POST["password"];
    $Nom = $_POST["nom"];
    $Prenom = $_POST["prenom"];
    $Naissance = $_POST["naissance"];
    $Adresse_1 = $_POST["Adresse_1"];
    $Adresse_2 = $_POST["Adresse_2"];
    $CP = $_POST["CP"];
    $Ville = $_POST["ville"];
    $Tel = $_POST["telephone"];
    $Mail = $_POST["mail"];
    $Sexe = $_POST["sexe"];
    $Niveau = $_POST["niveau"];
    $Auto_Evaluation_Dev = $_POST["auto_evaluation_dev"];
    $Auto_Evaluation_Reseau = $_POST["auto_evaluation_reseau"];
    
    // Validation des données (vous devez ajouter des validations appropriées)
    
    // Hasher le mot de passe avec Bcrypt
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
    
    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données: " . $conn->connect_error);
    }
    
    // Insertion des données dans la table des utilisateurs avec le mot de passe hashé
    $sql = "INSERT INTO compte (pseudo, password, nom, prenom, naissance, adresse_1, adresse_2, cp, ville, tel, mail, sexe, niveau, auto_evaluation_dev, auto_evaluation_reseau) VALUES ('$Pseudo', '$hashedPassword', '$Nom', '$Prenom', '$Naissance','$Adresse_1', '$Adresse_2','$CP', '$Ville','$Tel', '$Mail','$Sexe', '$Niveau', '$Auto_Evaluation_Dev', '$Auto_Evaluation_Reseau' )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Inscription réussie. Vous pouvez vous connecter.";
        header("Location: compte.php");
    } else {
        echo "Erreur lors de l'inscription: " . $conn->error;
    }
    
    // Fermer la connexion à la base de données
    $conn->close();
}
?>
