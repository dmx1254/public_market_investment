<?php
function logout()
{
    // Détruire toutes les données de session
    session_destroy();

    // Détruire le cookie de session en fixant sa date d'expiration dans le passé
    // setcookie(session_name(), '', time() - 3600, '/');

    // Rediriger vers la page de connexion ou une autre page appropriée
    exit(); // Assurez-vous de terminer le script après la redirection
}