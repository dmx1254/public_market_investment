<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once "db.php"; // Inclure le fichier de connexion à la base de données

// Initialisation de $id_annonce à partir de $_POST ou $_GET
$id_annonce = isset($_POST["id_annonce"]) ? $_POST["id_annonce"] : (isset($_GET['numero_annonce']) ? $_GET['numero_annonce'] : null);

if ($id_annonce) {
    // Requête SQL pour récupérer les détails de l'annonce à partir de son ID
    $sql = "SELECT * FROM Annonce WHERE id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("s", $id_annonce);
    $stmt->execute();
    $result = $stmt->get_result();
    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        // Récupérer les données de l'annonce
        $annonce = $result->fetch_assoc();
        // Fermer la requête
        $stmt->close();
    } else {
        // Si aucune annonce trouvée avec cet ID, rediriger vers une page d'erreur ou afficher un message d'erreur
        echo "Aucune annonce trouvée avec cet ID.";
        exit();
    }
} else {
    echo "<script>window.location.href='page_d_erreur.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    <link rel="icon" href="images/logodesk.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/apply-candidancy.css" />

</head>

<body>
    <?php include "navbar.php"; ?>
    <main class="apply">
        <?php include "sidebar.php"; ?>
        <div class="content-container">
            <div class="annonce-details">
                <h2>Détails de l'annonce</h2>
                <p><span class="annonce-details-title">Titre de l'annonce:</span> <?php echo $annonce['titre']; ?></p>
                <p><span class="annonce-details-title">Catégorie:</span> <?php echo $annonce['category']; ?></p>
                <p><span class="annonce-details-title">Référence:</span> <?php echo $annonce['numero_reference']; ?></p>
                <p><span class="annonce-details-title">Date de publication:</span> <?php $start_date_obj = new DateTime($annonce['date_publication']);
                $formatted_date = $start_date_obj->format('Y-m-d');
                echo $formatted_date; ?></p>

                <p><span class="annonce-details-title">Date d'expiration:</span>
                    <?php echo $annonce['date_expiration']; ?></p>

                <?php
                if (file_exists($annonce['file_path'])) {
                    $nom_fichier = basename($annonce['file_path']);
                    ?>
                    <p>
                        <span class="annonce-details-title">Fichier joint:</span>
                        <?php
                        // Vérifier si le fichier existe avant d'afficher le lien de téléchargement
                        // Extraire l'extension du fichier
                        $extension = pathinfo($annonce['file_path'], PATHINFO_EXTENSION);

                        // Vérifier l'extension et afficher le lien de téléchargement
                        if (in_array($extension, ['pdf', 'doc', 'docx', 'txt'])) {
                            echo "<div class='flex items-center gap-4'>";
                            echo '<a href="dossier/upload/' . $nom_fichier . '"download class="inline-flex items-center justify-center text-base text-white" style="color: #1b4332; font-weight: bold; font-size: 18px; border-radius: 4px;">Télécharger</a>';
                            echo "<span style='font-size: 18px; color: #1f2937; font-weight: 600;'>ou</span>";
                            echo '<a href="dossier/upload/' . $nom_fichier . '"class="inline-flex items-center justify-center text-base text-white" style="color: #1b4332; font-weight: bold; font-size: 18px; border-radius: 4px;">Ouvrir le fichier</a>';
                            echo "</div>";
                        }
                        ?>
                    </p>
                    <?php
                } else {
                    echo "<span style='font-size: 18px; font-weight: 700; color: #1b4332'>Aucun fichier joint trouvé.</span>";
                }
                ?>
            </div>
            <div class="application-form">
                <h2>Formulaire de candidature</h2>
                <form id="apply-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id_annonce" value="<?php echo $annonce["id"]; ?>">
                    <input type="hidden" name="id_annonceur" value="<?php echo $annonce["annonceur_id"]; ?>">
                    <label for="nom">Nom</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Nom" required>
                    <label for="prenom">Prénom</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Prénom" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <label for="phone">Téléphone</label>
                    <input type="tel" id="phone" name="phone" placeholder="Téléphone" required>
                    <label for="entreprise">Entreprise</label>
                    <input type="text" id="entreprise" name="entreprise" placeholder="Entreprise" required>
                    <label for="cv">CV ou Autre (fichier)</label>
                    <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.txt" required> <span id="uploadError"
                        style="display: flex; margin-top: -4px; margin-bottom: 4px; color: #dc2626; font-size: 15px">
                    </span>
                    <label for="lettre_motivation">Motivation</label>
                    <textarea id="lettre_motivation" name="lettre_motivation" placeholder="Motivation"></textarea>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </main>
    <div id="toast" class="fixed bottom-4 right-10 flex items-center gap-1 bg-white text-green-600"
        style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px; padding: 10px 15px; border-radius: 8px; transform: translateY(200%); transition: 2s ease-in-out;">
        <i class="fas fa-check"></i>Votre candidature a été envoyée avec succès.
    </div>
    <div id="toastError" class="fixed bottom-4 right-10 flex items-center gap-1 bg-white text-red-600"
        style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px; padding: 10px 15px; border-radius: 8px; transform: translateY(200%); transition: 2s ease-in-out;">
        <i class="fas fa-times-circle"></i>Veuillez vous connecter d'abord.
    </div>
    <?php include 'mobile-sidebar.php' ?>
    <?php include 'footer.php' ?>
    <!-- <script>
        let formPrevent = document.getElementById("apply-form");
        form.addEventListener("submit", function (event) {
            event.preventDefault();
        });
    </script> -->
</body>

</html>


<?php

include_once ("db.php");

if (!isset($_SESSION['user'])) {
    $success["toastError"] = "Veuillez vous connecter d'abord.";
    echo "<script>
    let toastError = document.getElementById('toastError');
    toastError.style.transition = 'transform 1.5s ease-in-out';
    toastError.style.transform = 'translateY(0%)';
    setTimeout(function() {
        toastError.style.transition = 'transform 0.5s ease-in-out';
        toastError.style.transform = 'translateY(200%)';
      }, 5000); 
      window.history.replaceState(null, null, '?numero_annonce=" . $id_annonce . "');
  </script>";
    exit(); // Arrêt de l'exécution du script ici
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selfUser = $_SESSION["user"];
    $id = uniqid();
    $id_apply = $selfUser["id"];
    $id_annonceur = $_POST["id_annonceur"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $id_annonce = $_POST["id_annonce"];
    $phone = $_POST["phone"];
    $entreprise = $_POST["entreprise"];
    $motivation = $_POST["lettre_motivation"];

    // var_dump($user);
    // echo($annonceur_id );

    // Initialiser un tableau pour stocker les messages d'erreur
    $errors = [];
    $success = [];

    // Chemin où vous souhaitez stocker les fichiers téléchargés sur votre serveur
    $upload_directory = "C:\\xampp\\htdocs\\dossier\\apply\\";

    // Récupérer le nom du fichier et son chemin temporaire
    $file_name = $_FILES["cv"]["name"];
    $file_tmp_name = $_FILES["cv"]["tmp_name"];
    $file_error = $_FILES['cv']['error'];

    // Vérifier si un fichier a été téléchargé
    if (!empty($_FILES["cv"]["name"])) {
        // Récupérer le nom du fichier et son chemin temporaire
        $file_name = $_FILES["cv"]["name"];
        $file_tmp_name = $_FILES["cv"]["tmp_name"];
        $file_error = $_FILES['cv']['error'];

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
            $cv_path = $upload_directory . $file_name;
            if (!move_uploaded_file($file_tmp_name, $cv_path)) {
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
            $stmt = $connexion->prepare("INSERT INTO Apply (id, firstname, lastname, email, phone, entreprise, motivation, cv_path, id_annonceur, id_apply, id_annonce) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Liaison des paramètres
            $stmt->bind_param("sssssssssss", $id, $firstname, $lastname, $email, $phone, $entreprise, $motivation, $cv_path, $id_annonceur, $id_apply, $id_annonce);

            // Exécuter la requête
            if ($stmt->execute()) {
                // Redirection en utilisant JavaScript
                $success["toast"] = "Votre candidature a été envoyée avec succès.";
                echo "<script>
                let toast = document.getElementById('toast');
                toast.style.transition = 'transform 1.5s ease-in-out';
                toast.style.transform = 'translateY(0%)';
                setTimeout(function() {
                    toast.style.transition = 'transform 0.5s ease-in-out';
                    toast.style.transform = 'translateY(200%)';
                  }, 5000); 
                  window.history.replaceState(null, null, '?numero_annonce=" . $id_annonce . "');
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