<?php

include "db.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $pseudo =$_POST["pseudo"];
    $password = $_POST["password"];
    
    
    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données: " . $conn->connect_error);
    }
    
    // Requête pour récupérer l'utilisateur avec le nom d'utilisateur donné
    $sql = "SELECT * FROM compte WHERE pseudo ='$pseudo' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $_SESSION["pseudo"] = $pseudo; // Création de la session
        header("Location: compte.php"); // Redirection vers la page d'accueil
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
    
    // Fermer la connexion à la base de données
    $conn->close();
}
?>