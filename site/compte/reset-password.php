<?php
include "db.php";
session_start(); // Démarrez la session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $pseudo = $_POST["pseudo"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    // Vérifier si les mots de passe correspondent
    if ($newPassword === $confirmPassword) {
        // Vérifier si le nouveau mot de passe est différent de l'ancien
        $sql_check_password = "SELECT password FROM compte WHERE pseudo = '$pseudo'";
        $result_check_password = $conn->query($sql_check_password);
        if ($result_check_password->num_rows == 1) {
            $row = $result_check_password->fetch_assoc();
            $oldPassword = $row["password"];
            if (password_verify($newPassword, $oldPassword)) {
                echo "Tu ne peux pas utiliser un mot de passe que tu as déjà utilisé.";
            } else {
                // Générer le hachage du nouveau mot de passe avec bcrypt
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Mise à jour du mot de passe haché dans la base de données
                $sql_update_password = "UPDATE compte SET password = '$hashedPassword' WHERE pseudo = '$pseudo'";
                if ($conn->query($sql_update_password) === TRUE) {
                    // Réinitialisation réussie, rediriger l'utilisateur vers l'espace compte
                    $_SESSION["pseudo"] = $pseudo; // Créez une session pour stocker le nom d'utilisateur
                    header("Location: compte.php"); // Redirigez l'utilisateur vers l'espace compte
                } else {
                    echo "Erreur lors de la réinitialisation du mot de passe: " . $conn->error;
                }
            }
        } else {
            echo "Nom d'utilisateur non trouvé.";
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
