<?php

include "db.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"] or $email =$_POST["email"];
    $password = $_POST["password"];
    
    
    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données: " . $conn->connect_error);
    }
    
    // Requête pour récupérer l'utilisateur avec le nom d'utilisateur donné
    $sql = "SELECT * FROM users WHERE username = '$username' OR email ='$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $_SESSION["username"] = $username; // Création de la session
        header("Location: home.php"); // Redirection vers la page d'accueil
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
    
    // Fermer la connexion à la base de données
    $conn->close();
}
?>
