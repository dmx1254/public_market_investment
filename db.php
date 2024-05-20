<?php
$server = "localhost";
$user = "root";
$password = "";
$db_name = "bidding_platform";
$connexion = new mysqli($server, $user, $password, $db_name);
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
} else {
    // echo "Connexion réussie à la base de données!<br>";
}