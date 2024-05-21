<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["user"])) {
    // L'utilisateur est connecté, vous pouvez accéder à ses données via $_SESSION["user"]
    $user = $_SESSION["user"];
    // var_dump($user);
} else {
    // L'utilisateur n'est pas connecté, vous pouvez rediriger vers la page d'accueil
    echo "<script>window.location.replace('index.php');</script>";
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/profil.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="custom-container">
    <?php include "navbar.php"; ?>
    <main class="content">
        <?php include "sidebar.php"; ?>
        <div class="profil-container">
            <div class="container">
                <div class="flex items-center justify-center gap-4 mb-4 btn-container">
                    <button class="btn active" id="btn-profile" onclick="showSection('profile')">Profil</button>
                    <button class="btn" id="btn-annonces" onclick="showSection('annonces')">Annonces</button>
                    <button class="btn" id="btn-candidatures"
                        onclick="showSection('candidatures')">Candidatures</button>
                </div>
            </div>

            <div id="profile-section" style="width: 100%;">
                <div class="profile-info">
                    <div class="flex items-center gap-4">
                        <label style="color: #1b4332;">Nom:</label>
                        <p class="text-gray-600 text-base"><?php echo $user['lastname']; ?></p>
                    </div>
                    <div class="flex items-center gap-4">
                        <label style="color: #1b4332;">Prénom:</label>
                        <p class="text-gray-600 text-base"><?php echo $user['firstname']; ?>
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <label style="color: #1b4332;">Email:</label>
                        <p class="text-gray-600 text-base"><?php echo $user['email']; ?></p>
                    </div>
                    <div class="flex items-center gap-4">
                        <label style="color: #1b4332;">Téléphone:</label>
                        <p class="text-gray-600 text-base"><?php echo $user['phone']; ?></p>
                    </div>
                    <div class="flex items-center gap-4">
                        <label style="color: #1b4332;">Entreprise:</label>
                        <p class="text-gray-600 text-base"><?php echo $user['entreprise']; ?>
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <label style="color: #1b4332;">Adresse:</label>
                        <p class="text-gray-600 text-base"><?php echo $user['address']; ?></p>
                    </div>
                    <div class="flex items-center gap-4">
                        <label style="color: #1b4332;">Membre depuis:</label>
                        <p class="text-gray-600 text-base"><?php
                        $createdAt = $user['createdAt'];
                        $monthNum = date("m", strtotime($createdAt));
                        $mois = array(
                            "01" => "Janvier",
                            "02" => "Février",
                            "03" => "Mars",
                            "04" => "Avril",
                            "05" => "Mai",
                            "06" => "Juin",
                            "07" => "Juillet",
                            "08" => "Août",
                            "09" => "Septembre",
                            "10" => "Octobre",
                            "11" => "Novembre",
                            "12" => "Décembre"
                        );
                        $monthName = $mois[$monthNum];
                        echo date("d") . " " . $monthName . " " . date("Y", strtotime($createdAt));
                        ?>
                        </p>
                    </div>
                </div>
            </div>

            <div id="annonces-section" class="hidden">
                <h2 class="text-xl font-bold mb-4" style="color: #1b4332;">Dernières Annonces</h2>
                <div class="annonces-list">
                    <?php
                    // Requête pour récupérer les trois dernières annonces
                    include "db.php";
                    $sql = "SELECT * FROM Annonce ORDER BY date_publication DESC LIMIT 3";
                    $result = $connexion->query($sql);

                    // Vérifier s'il y a des résultats
                    if ($result->num_rows > 0) {
                        // Parcourir chaque ligne de résultat
                        while ($row = $result->fetch_assoc()) {
                            // Afficher les détails de chaque annonce avec un lien
                            echo "<a class='annonce-item' href='apply.php?numero_annonce=" . $row["id"] . "'>";
                            echo "<p class='annonce-title'>Titre: " . $row["titre"] . "</p>";
                            echo "<p class='annonce-reference'>Numéro de référence: " . $row["numero_reference"] . "</p>";
                            echo "<p class='annonce-category'>Catégorie: " . $row["category"] . "</p>";
                            echo "</a>";
                        }
                    } else {
                        echo "<p class='no-annonces'>Aucune annonce trouvée.</p>";
                    }
                    ?>
                </div>

                <div class="form-container">
                    <h2 class="flex items-center justify-center text-xl font-bold my-2" style="color: #1b4332;">Créer
                        une Annonce</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        enctype="multipart/form-data">
                        <!-- Formulaire de création d'annonce -->
                        <label for="category" style="color: #1b4332;">Catégorie:</label>
                        <input type="text" id="category" name="category" placeholder="Catégorie" required>
                        <label for="title" style="color: #1b4332;">Titre:</label>
                        <input type="text" id="title" name="titre" placeholder="Titre" required>
                        <label for="numero_reference" style="color: #1b4332;">Numéro de référence:</label>
                        <input type="text" id="numero_reference" name="numero_reference" placeholder="Numero référence"
                            required>
                        <label for="description" style="color: #1b4332;">Description:</label>
                        <textarea id="description" name="description" placeholder="Description" rows="4"
                            required></textarea>
                        <label for="file" style="color: #1b4332;">Fichier:</label>
                        <div class="file-input-wrapper">
                            <label class="file-input-label">
                                <span class="file-input-label-text">Choisir un fichier</span>
                                <input type="file" class="file-input" id="file" name="file"
                                    accept=".pdf,.doc,.docx,.txt">
                            </label>
                        </div>
                        <span id="uploadError"
                            style="display: flex; margin-top: 4px; margin-bottom: 4px; color: #dc2626; font-size: 15px"></span>
                        <label for="date_expiration" style="color: #1b4332;">Date d'expiration:</label>
                        <input type="date" id="date_expiration" name="date_expiration" required>
                        <input type="submit" value="Créer Annonce">
                        <span id="successAnnonce"
                            style="display: flex; margin-top: 4px; margin-bottom: 4px; color: #16a34a; font-size: 15px"></span>
                    </form>
                </div>
            </div>

            <div id="candidatures-section" class="hidden">
                <h2 class="text-xl font-bold mb-4" style="color: #1b4332;">Candidatures</h2>
                <div class="candidatures-list">
                    <?php
                    include "db.php";
                    $user = $_SESSION["user"];
                    $sql = "SELECT a.titre, a.numero_reference, ap.firstname, ap.lastname, ap.email, ap.phone, ap.id_annonce
                            FROM Apply ap
                            JOIN Annonce a ON ap.id_annonce = a.id
                            WHERE a.annonceur_id = ?";
                    $stmt = $connexion->prepare($sql);
                    $stmt->bind_param("s", $user['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='candidature-item'>";
                            echo "<p class='candidature-title'>Annonce: " . $row["titre"] . " (Réf: " . $row["numero_reference"] . ")</p>";
                            echo "<p class='candidature-name'>Prenom et Nom: " . $row["lastname"] . " " . $row["firstname"] . "</p>";
                            echo "<p class='candidature-email'>Email: " . $row["email"] . "</p>";
                            echo "<p class='candidature-email'>Téléphone: " . $row["phone"] . "</p>";
                            echo "<a class='candidature-link' href='apply.php?numero_annonce=" . $row["id_annonce"] . "'>Voir l'annonce</a>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p class='no-candidatures'>Aucune candidature trouvée.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>


        </div>
    </main>
    <div id="toast" class="fixed bottom-4 right-10 flex items-center gap-1 bg-white text-green-600"
        style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px; padding: 10px 15px; border-radius: 8px; transform: translateY(150%); transition: 2s ease-in-out;">
        <i class="fas fa-check"></i> Annonce créée avec succès.
    </div>
    <?php include 'mobile-sidebar.php' ?>

    <script>
        // Obtenez la date d'aujourd'hui
        var today = new Date();

        // Ajoutez un jour à la date d'aujourd'hui
        var tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        // Formattez la date de demain au format YYYY-MM-DD
        var tomorrowFormatted = tomorrow.toISOString().split('T')[0];

        // Définissez la date minimale pour le champ de saisie
        document.getElementById("date_expiration").min = tomorrowFormatted;

        function showSection(section) {
            document.getElementById('profile-section').classList.add('hidden');
            document.getElementById('annonces-section').classList.add('hidden');
            document.getElementById('candidatures-section').classList.add('hidden');
            document.getElementById('btn-profile').classList.remove('active');
            document.getElementById('btn-annonces').classList.remove('active');
            document.getElementById('btn-candidatures').classList.remove('active');

            if (section === 'profile') {
                document.getElementById('profile-section').classList.remove('hidden');
                document.getElementById('btn-profile').classList.add('active');
            } else if (section === 'annonces') {
                document.getElementById('annonces-section').classList.remove('hidden');
                document.getElementById('btn-annonces').classList.add('active');
            } else if (section === 'candidatures') {
                document.getElementById('candidatures-section').classList.remove('hidden');
                document.getElementById('btn-candidatures').classList.add('active');
            } else {

            }
        }
    </script>
</body>


</html>

<?php

include_once ("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = uniqid();
    $selfUser = $_SESSION["user"];
    $annonceur_id = $selfUser["id"];
    $numero_reference = $_POST["numero_reference"];
    $category = $_POST["category"];
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $date_expiration = $_POST["date_expiration"];

    // var_dump($user);
    // echo($annonceur_id );

    // Initialiser un tableau pour stocker les messages d'erreur
    $errors = [];
    $success = [];

    // Chemin où vous souhaitez stocker les fichiers téléchargés sur votre serveur
    $upload_directory = "C:\\xampp\\htdocs\\dossier\\upload\\";

    // Récupérer le nom du fichier et son chemin temporaire
    $file_name = $_FILES["file"]["name"];
    $file_tmp_name = $_FILES["file"]["tmp_name"];
    $file_error = $_FILES['file']['error'];

    // Vérifier si un fichier a été téléchargé
    if (!empty($_FILES["file"]["name"])) {
        // Récupérer le nom du fichier et son chemin temporaire
        $file_name = $_FILES["file"]["name"];
        $file_tmp_name = $_FILES["file"]["tmp_name"];
        $file_error = $_FILES['file']['error'];

        // Vérification des erreurs d'upload
        if ($file_error !== UPLOAD_ERR_OK) {
            $errors["uploadError"] = "Une erreur s'est produite lors du téléchargement du fichier.";
            // Afficher l'erreur (vous pouvez également utiliser JavaScript pour afficher une alerte)
            echo "<script>
                let uploadError = document.getElementById('uploadError');
                uploadError.textContent = 'Une erreur s\'est produite lors du téléchargement du fichier.';
              </script>";
        } else {
            // Déplacement du fichier téléchargé vers le dossier de destination sur le serveur
            $file_path = $upload_directory . $file_name;
            if (!move_uploaded_file($file_tmp_name, $file_path)) {
                $errors["fileError"] = "Une erreur s'est produite lors du déplacement du fichier téléchargé.";
                // Afficher l'erreur
                echo "<script>
                let uploadError = document.getElementById('uploadError');
                uploadError.textContent = 'Une erreur s\'est produite lors du déplacement du fichier téléchargé.';
              </script>";
            }
        }
    }
    if (empty($errors)) {
        try {
            // Préparer la requête d'insertion
            $stmt = $connexion->prepare("INSERT INTO Annonce (id, annonceur_id, numero_reference, category, titre, description, file_path, date_expiration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            // Liaison des paramètres
            $stmt->bind_param("ssssssss", $id, $annonceur_id, $numero_reference, $category, $titre, $description, $file_path, $date_expiration);

            // Exécuter la requête
            if ($stmt->execute()) {
                // Redirection en utilisant JavaScript
                $success["toast"] = "Annonce creer avec succès";
                echo "<script>
                let toast = document.getElementById('toast');
                toast.style.transition = 'transform 2s ease-in-out';
                toast.style.transform = 'translateY(0%)';
                setTimeout(function() {
                    toast.style.transition = 'transform 0.5s ease-in-out';
                    toast.style.transform = 'translateY(200%)';
                  }, 5000); 
              </script>";
                exit(); // Arrêt de l'exécution du script ici
            } else {
                // En cas d'erreur lors de l'insertion
                die("Erreur lors de la creation de l'annonce : " . $connexion->error); // Utilisation de die() pour arrêter le script et afficher l'erreur
            }
        } catch (mysqli_sql_exception $e) {
            echo "Erreur : " . $e->getMessage();
        } finally {
            // Fermer la requête
            if (isset($stmt)) {
                $stmt->close();
            }
        }

    }
}

?>