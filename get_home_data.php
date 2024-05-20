<?php
// Inclure le fichier de connexion à la base de données
include_once "db.php";

// Définir l'offset et la limite par défaut
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

// Requête SQL pour récupérer les éléments suivants en fonction de l'offset et de la limite
$sql = "SELECT * FROM annonce ORDER BY date_publication DESC LIMIT $limit OFFSET $offset";
$result = $connexion->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Créer un tableau associatif pour stocker les données
    $data = array();

    // Parcourir chaque ligne de résultat
    while ($row = $result->fetch_assoc()) {
        // Ajouter les données de la ligne au tableau
        $data[] = $row;
    }

    // Convertir le tableau associatif en JSON et l'afficher
    echo json_encode($data);
} else {
    // Si aucun résultat trouvé
    echo json_encode(array('message' => 'Aucun résultat trouvé.'));
}

// Fermer la connexion à la base de données
$connexion->close();