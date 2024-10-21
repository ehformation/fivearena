<?php

// isConnect() permet de savoir si un utilisateur est connecté au site 
function isConnect(): bool
{
    if (isset($_SESSION["user"])) {
        return true;
    } else {
        return false;
    }
}

// isAdmin() permet de savoir si la personne est admin ou pas
function isAdmin(): bool
{
    if ( isConnect() && $_SESSION["user"]['id_role']==1) {
        return true;
    } else {
        return false;
    }
} 

// je creer une fonction debugArray() qui doit contenir les echo pre et print pour afficher un tableau
function debugArray(array $array){
    echo '<pre>';   // Balise HTML <pre> pour formater l'affichage
    print_r($array); // Utilisation de print_r pour afficher le tableau
    echo '</pre>';  // Fermeture de la balise <pre>
}
?>

