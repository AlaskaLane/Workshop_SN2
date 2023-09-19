<?php 

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

if(empty($errors)){

    // On enregistre les informations dans la base de données 
    $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
    // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // On génère le token qui servira à la validation du compte 
    $token = str_random(60);
    $req->execute([$_POST['username'], $password, $_POST['email'], $token]);
    $user_id = $pdo->lastInsertId();
    // On envoit l'email de confirmation
    mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://local.dev/Lab/Comptes/confirm.php?id=$user_id&token=$token");
    // On redirige l'utilisateur vers la page de login avec un message flash
    $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
    header('Location: login.php');
    exit();

}