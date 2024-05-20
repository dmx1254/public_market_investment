<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["q"])) {
    $search_query = htmlspecialchars($_GET["q"]);

    include "db.php";

    $stmt = $connexion->prepare("SELECT * FROM Annonce WHERE titre LIKE ?");
    $search_term = "%" . $search_query . "%";
    $stmt->bind_param("s", $search_term);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $search_results = "";
        while ($row = $result->fetch_assoc()) {
            $search_results .= "<a href='apply.php?numero_annonce=" . $row["id"] . "' class='annonce-item'>";
            $search_results .= "<p class='annonce-title'>Titre: " . $row["titre"] . "</p>";
            $search_results .= "<p class='annonce-reference'>Numéro de référence: " . $row["numero_reference"] . "</p>";
            $search_results .= "<p class='annonce-category'>Catégorie: " . $row["category"] . "</p>";
            $search_results .= "</a>";
        }
    } else {
        $search_results = "<p class='no-annonces'>Aucune annonce trouvée.</p>";
    }
} else {
    $search_results = "Veuillez saisir un terme de recherche.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="css/search.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include "navbar.php"; ?>
    <main class="content">
        <?php include "sidebar.php"; ?>
        <div class="container">
            <div class="search-results-container">
                <h1>Résultats de la recherche</h1>
                <div class="search-results">
                    <?php echo $search_results; ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>