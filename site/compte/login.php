<?php
include "db.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $pseudo = $_POST["pseudo"];
    $password = $_POST["password"];
    
    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données: " . $conn->connect_error);
    }
    
    // Requête pour récupérer l'utilisateur avec le nom d'utilisateur donné
    $sql = "SELECT * FROM compte WHERE pseudo ='$pseudo'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        // Utilisateur trouvé, vérifiez le mot de passe avec password_verify
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"]; // Mot de passe haché stocké dans la base de données
        
        if (password_verify($password, $hashedPassword)) {
            $_SESSION["pseudo"] = $pseudo; // Création de la session
            header("Location: compte.php"); // Redirection vers la page d'accueil
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Nom d'utilisateur incorrect.";
    }
    
    // Fermer la connexion à la base de données
    $conn->close();
}
?>