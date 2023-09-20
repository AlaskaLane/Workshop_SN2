<?php 
function isStrongPassword($password) {
    // Ajoutez votre logique de vérification ici (par exemple, longueur minimale, caractères spéciaux, etc.)
    return strlen($password) >= 8;
}