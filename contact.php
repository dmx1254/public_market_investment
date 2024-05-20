<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/contact.css">


</head>

<body>
    <?php include "navbar.php"; ?>
    <main class="content">
        <?php include "sidebar.php"; ?>
        <div class="contact_container">
            <h1>Contactez-Nous</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="contact_form">
                <label for="name">Nom complet :</label>
                <input type="text" id="fullname" name="fullname" placeholder="Prenom et Nom" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <span style="color: red; font-size: 14px;" id="emailError"></span>

                <label for="subject">Sujet :</label>
                <input type="text" id="subject" name="subject" placeholder="sujet" required>

                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" placeholder="message" required></textarea>

                <button type="submit">Envoyer</button>
            </form>
        </div>
    </main>
    <div id="toast" class="fixed bottom-4 right-10 flex items-center gap-1 bg-white text-green-600"
        style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px; padding: 10px 15px; border-radius: 8px; transform: translateY(200%); transition: 2s ease-in-out;">
        <i class="fas fa-check"></i>Message envoyé avec succès !
    </div>
    <?php include 'mobile-sidebar.php'; ?>
    <?php include 'footer.php'; ?>
</body>

</html>

<?php
include_once "db.php";

$fullname = $email = $subject = $message = "";
$fullname_err = $email_err = $subject_err = $message_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = uniqid();
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $errors = [];

    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $errors["emailError"] = "L'adresse email que vous avez saisie est incorrecte";
        echo "<script>
                let emailError = document.getElementById('emailError');
                emailError.textContent = 'L\'adresse email que vous avez saisie est incorrecte';
              </script>";
    }


    if (empty($errors)) {
        try {
            // Préparer la requête d'insertion
            $stmt = $connexion->prepare("INSERT INTO message (id, fullname, email, subject, message) VALUES (?, ?, ?, ?, ?)");

            // Liaison des paramètres
            $stmt->bind_param("sssss", $id, $fullname, $email, $subject, $message);

            // Exécuter la requête
            if ($stmt->execute()) {
                $success["toast"] = "Message envoyé avec succès !";
                echo "<script>
                let toast = document.getElementById('toast');
                toast.style.transition = 'transform 1.5s ease-in-out';
                toast.style.transform = 'translateY(0%)';
                setTimeout(function() {
                    toast.style.transition = 'transform 0.5s ease-in-out';
                    toast.style.transform = 'translateY(200%)';
                  }, 5000); 
              </script>";
                exit(); // Arrêt de l'exécution du script ici
            } else {
                // En cas d'erreur lors de l'insertion
                die("Erreur lors de l'envoie du message: " . $connexion->error); // Utilisation de die() pour arrêter le script et afficher l'erreur
            }
        } catch (mysqli_sql_exception $e) {
            echo "Erreur : " . $e->getMessage();
        }

    }

    // Fermer la connexion
    $connexion->close();
}
?>