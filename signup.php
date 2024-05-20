<?php
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION["user"])) {
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
  <title>Sign up</title>
  <link rel="stylesheet" href="css/signup.css">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
</head>

<body>
  <?php include "navbar.php"; ?>
  <main class="content">
    <?php include "sidebar.php"; ?>
    <form id="signupform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
      class="content-container">
      <div class="flex flex-col md:flex-row w-full items-start max-w-xl md:max-w-2xl lg:max-w-4xl ml-0 lg:ml-20"
        style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        <div class="flex flex-col gap-3 items-start justify-center p-8 lg:p-12">
          <div class="flex flex-col items-start gap-1">
            <p class="text-lg font-semibold text-[#1b4332]" style="color: #1b4332; font-size: 24px;">
              Créer un Compte
            </p>
            <p class="text-base text-gray-600">
              Acceder facilement aux offres de marchés
            </p>
          </div>

          <div class="flex flex-col items-start gap-1 w-full relative">
            <label htmlFor="email" class="text-[#1b4332] font-bold">
              Email
            </label>
            <input type="email" name="email" id="email" required placeholder="example@email.com"
              class="input1 w-full text-sm p-2 outline-none border shadow-lg border-green-500 rounded bg-white text-gray-800"
              style="max-width: 360px;" />
            <span style="color: red; font-size: 14px;" id="emailError"></span>
          </div>
          <div class="flex flex-col items-start gap-2 w-full relative">
            <div class="flex items-center gap-2">
              <div class="flex flex-col items-start gap-1">
                <label htmlFor="lastname" class="text-[#1b4332] font-bold">
                  Prénom
                </label>
                <input type="text" name="lastname" id="latname" placeholder="Prénom" required
                  class="input1 w-full text-sm  p-2 outline-none border shadow-lg border-green-500 rounded bg-white text-gray-800" />

              </div>
              <div class="flex flex-col items-start gap-1">
                <label htmlFor="lastname" class="text-[#1b4332] font-bold">
                  Nom
                </label>
                <input type="text" name="firstname" id="firstname" placeholder="Nom" required
                  class="input1 w-full text-sm p-2 outline-none border shadow-lg border-green-500 rounded bg-white text-gray-800" />
              </div>
            </div>
          </div>
          <div class="flex flex-col items-start gap-1 w-full relative">
            <label htmlFor="phone" class="text-[#1b4332] font-bold">
              Téléphone
            </label>
            <input type="phone" name="phone" id="phone" required placeholder="Téléphone"
              class="input1 w-full text-sm p-2 outline-none border shadow-lg border-green-500 rounded bg-white text-gray-800"
              style="max-width: 360px;" />
            <span style="color: red; font-size: 14px;" id="phoneError"></span>
          </div>
          <div class="flex flex-col items-start gap-1 w-full relative">
            <label htmlFor="password" class="text-[#1b4332] font-bold">
              Mot de Passe
            </label>
            <div class="flex  gap-2">
              <div class="flex flex-col items-start gap-1">
                <input type="password" name="password" required id="password"
                  class="input2 w-full text-sm p-2 outline-none border bg-white text-gray-800 border-green-500 rounded shadow-lg"
                  placeholder="Mot de passe" />
                <span style="color: red; font-size: 14px;" id="passwordError"></span>
              </div>

              <div class="flex flex-col items-start gap-1">
                <input type="password" name="confirmpassword" required id="confirmpassword"
                  class="input2 w-full text-sm p-2 outline-none border bg-white text-gray-800 border-green-500 rounded shadow-lg"
                  placeholder="Confirmer le mot de passe" />


                <span style="color: red; font-size: 14px;" id="confirmpassError"></span>

              </div>
            </div>
          </div>
          <div class="flex flex-col items-start gap-1 w-full relative">
            <label htmlFor="password" class="text-[#1b4332] font-bold">
              Entreprise
            </label>

            <input type="text" name="business" id="business" required
              class="input2 w-full text-sm p-2 outline-none border bg-white text-gray-800 border-green-500 rounded shadow-lg"
              placeholder="Ex. Ibytrade S.A." style="max-width: 360px;" />
            <div class="flex flex-col items-start gap-1">

            </div>
          </div>
          <div class="flex flex-col items-start gap-1 w-full relative">
            <label htmlFor="password" class="text-[#1b4332] font-bold">
              Adresse
            </label>

            <textarea class="w-full outline-none border border-green-500 min-h-24 p-4 max-h-40"
              placeholder="RUE 28, AIN SEBAA, Casablanca, Morocco" name="adress" style="max-width: 360px;"
              required></textarea>
            <div class="flex flex-col items-start gap-1">

            </div>
          </div>
          <span class="text-base text-gray-600 w-full max-w-sm">
            Marchés du Maroc a besoin des coordonnées que  vous nous fournissez
            pour vous contacter.
          </span>
          <button type="submit" class="p-2 outline-none w-full rounded text-center text-white bg-green-800"
            style="outline: none;">
            S'inscrire
          </button>
          <span class="flex gap-1 text-base text-gray-600">
            Vous avez déjà un compte?
            <a href="/signin.php" class="text-[#1b4332] underline" style="color:#1b4332">
              Par ici
            </a>
          </span>
        </div>
        <div class="flex flex-col items-start w-full md:w-1/2 p-8 gap-4">
          <div class="flex items-center gap-2">
            🚫​<span class="text-gray-600">24/7 Support Système</span>
          </div>
          <div class="flex items-center gap-2">
            🚫​<span class="text-gray-600">Veille concurrentielle</span>
          </div>
          <span class="font-bold text-[#1b4332] hidden">Free, 7 Credits</span>
          <div class="flex items-center gap-2">
            ✅​
            <span class="text-gray-600">
              Moteur de recherche avancé pour tous
            </span>
          </div>
          <div class="flex items-center gap-2">
            ✅​
            <span class="text-gray-600">Détail de l'annonce</span>
          </div>
          <div class="flex items-center gap-2">
            ✅​
            <span class="text-gray-600">Lots, montants</span>
          </div>
          <div class="flex items-center gap-2">
            ✅​
            <span class="text-gray-600">
              Rectificatifs et résultats du marché
            </span>
          </div>
        </div>
      </div>
    </form>
  </main>
  <?php include 'mobile-sidebar.php' ?>
  <?php include 'footer.php' ?>
  <!-- <script src="js/main.js"></script> -->
</body>

</html>

<?php
// Inclure le fichier de connexion à la base de données une seule fois
include_once "db.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = uniqid();
  $role = "USER";
  $email = $_POST['email'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];
  $entreprise = $_POST['business'];
  $adress = $_POST['adress'];

  // Crypter le mot de passe
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Initialiser un tableau pour stocker les messages d'erreur
  $errors = [];

  if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
    $errors["emailError"] = "L'adresse email que vous avez saisie est incorrecte";
    echo "<script>
                let emailError = document.getElementById('emailError');
                emailError.textContent = 'L\'adresse email que vous avez saisie est incorrecte';
              </script>";
  }

  if (!preg_match("/^\+?[0-9\s-]{7,}$/", $phone)) {
    $errors["phoneError"] = "Le numéro de téléphone que vous avez saisi est incorrect";
    echo "<script>
                let phoneError = document.getElementById('phoneError');
                phoneError.textContent = 'Le numéro de téléphone que vous avez saisi est incorrect';
              </script>";
  }

  if ($password != $confirmpassword) {
    $errors["passwordError"] = "Les mots de passe ne correspondent pas";
    echo "<script>
                let confirmpassError = document.getElementById('confirmpassError');
                confirmpassError.textContent = 'Les mot de passes ne correspondent pas';
            </script>";
  }

  if (strlen($password) < 8) {
    $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
    echo "<script>
                let passwordError = document.getElementById('passwordError');
                passwordError.textContent = 'Le mot de passe doit être d\'au moins 8 caractères';
            </script>";
  }

  if (empty($errors)) {
    try {
      // Préparer la requête d'insertion
      $stmt = $connexion->prepare("INSERT INTO User (id, email, lastname, firstname, role, phone, password, entreprise, address, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

      // Liaison des paramètres
      $stmt->bind_param("sssssssss", $id, $email, $lastname, $firstname, $role, $phone, $hashed_password, $entreprise, $adress);

      // Exécuter la requête
      if ($stmt->execute()) {
        // Redirection en utilisant JavaScript
        echo "<script>window.location.replace('signin.php');</script>";
        exit(); // Arrêt de l'exécution du script ici
      } else {
        // En cas d'erreur lors de l'insertion
        die("Erreur lors de l'inscription : " . $connexion->error); // Utilisation de die() pour arrêter le script et afficher l'erreur
      }
    } catch (mysqli_sql_exception $e) {
      if ($e->getCode() === 1062) { // Code d'erreur pour une entrée dupliquée
        echo "<script>
                        let emailError = document.getElementById('emailError');
                        emailError.textContent = 'L\'adresse email que vous avez saisie est déjà utilisée';
                      </script>";
      } else {
        // Autre traitement en cas d'erreur différente
      }
    }
  }
  // Fermer la requête
  $stmt->close();
}
?>