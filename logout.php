<?php
session_start(); // Démarrez la session pour accéder à $_SESSION

function logout() {
    // Détruire toutes les données de session
    $_SESSION = array();
    session_destroy();

    // Supprimer le cookie de session en réglant sa date d'expiration dans le passé
    setcookie(session_name(), '', time() - 3600, '/');

    // Rediriger vers la page de connexion ou une autre page appropriée
    header("Location: index.php");
    exit(); // Assurez-vous de terminer le script après la redirection
}

// Appeler la fonction de déconnexion lors de l'accès à logout.php
logout();