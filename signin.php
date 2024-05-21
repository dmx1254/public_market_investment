<?php
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION["user"])) {
  // L'utilisateur n'est pas connecté, vous pouvez rediriger vers la page d'accueil
  echo "<script>window.location.replace('index.php');</script>";
  exit();
}
// Inclure le fichier de connexion à la base de données une seule fois
include_once "db.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $errors = [];

  // Requête pour récupérer l'utilisateur à partir de son email
  $stmt = $connexion->prepare("SELECT * FROM User WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    $errors["emailError"] = "L'adresse email que vous avez saisie est incorrecte";
  } else {
    $user = $result->fetch_assoc();
    if (!password_verify($password, $user['password'])) {
      $errors["passwordError"] = "Le mot de passe que vous avez saisi est incorrect.";
    } else {
      session_set_cookie_params([
        'lifetime' => 3600, // Durée de vie de la session en secondes (1 heure)
        'httponly' => true,// Empêcher l'accès aux cookies via JavaScript
        'secure' => true,
      ]);
      session_start();
      $_SESSION['user'] = $user;
      header("Location: profil.php");
      exit();
    }
  }

  // Fermer la requête
  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in</title>
  <link rel="icon" href="images/logodesk.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css/signin.css">
</head>

<body>
  <?php include "navbar.php"; ?>
  <main class="content">
    <?php include "sidebar.php"; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="content-container">
      <div class="flex flex-col lg:flex-row w-full items-center shadow-2xl h-[410px] h-[400px] max-w-3xl lg:max-w-4xl md:ml-12"
        style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        <div class="flex items-center justify-center h-full max-w-sm lg:w-1/2 bg-[#F4F6FD] p-8">
          <span class="text-[#1b4332] text-xl lg:text-4xl leading-[47px]">
            Au Maroc, la Commande Publique s'élève à
            <span class="text-3xl lg:text-4xl font-extrabold" style="color: #1b4332;">
              +335 milliards
            </span>
            DHS / an
          </span>
        </div>
        <div
          class="flex flex-col gap-2 items-center lg:items-start justify-center max-w-sm lg:w-1/2 p-4 sm:p-8">
          <p class="text-2xl font-bold" style="color: #1b4332;">Login</p>
          <div class="group flex flex-col items-start gap-1 w-full relative group">
            <label htmlFor="email" class="font-bold" style="color: #1b4332;">
              Email
            </label>
            <input type="email" name="email" required id="email" placeholder="example@email.com"
              class="input1 w-full text-sm  pl-10 pt-2 pb-2 pr-2.5 outline-none border shadow-lg border-green-500 rounded bg-white text-gray-800" />
            <!-- <Mail
              class="icon1 absolute top-[56%] left-[2%] opacity-50 group-focus:opacity-100"
              size={20}
            /> -->
            <i class="fas fa-envelope opacity-50 icon1"
              style="position: absolute; top: 59%; left: 2%; font-size: 18px;"></i>
          </div>
          <?php if (isset($errors["emailError"])): ?>
            <span style="color: red; font-size: 14px;" id="emailError">
              <?php echo $errors["emailError"]; ?>
            </span>
          <?php endif; ?>

          <div class="flex flex-col items-start gap-1 w-full relative">
            <label htmlFor="password" class="font-bold" style="color: #1b4332;">
              Mot de Passe
            </label>
            <input type="password" name="password" id="password" required
              class="input2 w-full text-sm pl-10 pt-2 pb-2 pr-2.5 outline-none border bg-white text-gray-800 border-green-500 rounded shadow-lg"
              placeholder="Mot de passe..." />
            <!-- <Lock
              class="icon2 absolute top-[56%] left-[2%] opacity-50"
              size={20}
            /> -->
            <i class="fas fa-lock opacity-50 icon2"
              style="position: absolute; top: 56%; left: 2%; font-size: 18px;"></i>
          </div>
          <?php if (isset($errors["passwordError"])): ?>
            <span style="color: red; font-size: 14px;" id="passwordError">
              <?php echo $errors["passwordError"]; ?>
            </span>
          <?php endif; ?>
          <!-- <span class="text-base text-gray-600">
            Vous avez oublié votre mot de passe?
            <a href="/reset-password.php" class="underline" style="color: #1b4332;">
              Par ici
            </a>
          </span> -->
          <button type="submit" class="p-2 mt-2 outline-none w-full rounded text-center text-white bg-green-800">
            Se connecter
          </button>
          <span class="text-base text-gray-600">
            Vous n'avez pas de compte? Pas de soucis,
            <a href="/signup.php" class="underline" style="color: #1b4332;">
              Par ici
            </a>
          </span>
        </div>
      </div>
    </form>
  </main>
  <?php include 'mobile-sidebar.php' ?>
  <?php include 'footer.php' ?>
</body>

</html>