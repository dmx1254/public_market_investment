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
    echo "<script>window.location.replace('signin.php');</script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/update-profil.css">
</head>

<body>
    <?php include "navbar.php"; ?>
    <main class="content">
        <?php include "sidebar.php"; ?>
        <div class="container">
            <h1 class="text-3xl font-bold mb-6">User Profile</h1>
            <div class="profile-info shadow-lg p-6 rounded-lg">
                <div class="flex items-center gap-4">
                    <label style="color: #1b4332;" class="font-semibold">Nom:</label>
                    <p class="text-gray-600 text-lg"><?php echo htmlspecialchars($user['lastname']); ?></p>
                </div>
                <div class="flex items-center gap-4">
                    <label style="color: #1b4332;" class="font-semibold">Prénom:</label>
                    <p class="text-gray-600 text-lg"><?php echo htmlspecialchars($user['firstname']); ?></p>
                </div>
                <div class="flex items-center gap-4">
                    <label style="color: #1b4332;" class="font-semibold">Email:</label>
                    <p class="text-gray-600 text-lg"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="flex items-center gap-4">
                    <label style="color: #1b4332;" class="font-semibold">Téléphone:</label>
                    <p class="text-gray-600 text-lg"><?php echo htmlspecialchars($user['phone']); ?></p>
                </div>
                <div class="flex items-center gap-4">
                    <label style="color: #1b4332;" class="font-semibold">Entreprise:</label>
                    <p class="text-gray-600 text-lg"><?php echo htmlspecialchars($user['entreprise']); ?></p>
                </div>
                <div class="flex items-center gap-4">
                    <label style="color: #1b4332;" class="font-semibold">Adresse:</label>
                    <p class="text-gray-600 text-lg"><?php echo nl2br(htmlspecialchars($user['address'])); ?></p>
                </div>
            </div>
            <h2 class="text-2xl font-bold mb-4">Update Profile</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname"
                        value="<?php echo htmlspecialchars($user['lastname']); ?>">
                </div>
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname"
                        value="<?php echo htmlspecialchars($user['firstname']); ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                </div>
                <div class="form-group">
                    <label for="entreprise">Entreprise:</label>
                    <input type="text" id="entreprise" name="entreprise"
                        value="<?php echo htmlspecialchars($user['entreprise']); ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address"><?php echo htmlspecialchars($user['address']); ?></textarea>
                </div>
                <button type="submit" style="margin-bottom: 50px;">Update Profile</button>
            </form>
        </div>
    </main>
    <div id="toast" class="fixed bottom-4 right-10 flex items-center gap-1 bg-white text-green-600"
        style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px; padding: 10px 15px; border-radius: 8px; transform: translateY(200%); transition: 2s ease-in-out;">
        <i class="fas fa-check"></i>​Mise à jour du profil réussie
    </div>
    <div id="updateError" class="fixed bottom-4 right-10 flex items-center gap-1 bg-white text-red-600"
        style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px; padding: 10px 15px; border-radius: 8px; transform: translateY(200%); transition: 2s ease-in-out;">
        <i class="fas fa-times-circle"></i>Erreur lors de la mise à jour du profil.
    </div>
    <?php include 'mobile-sidebar.php' ?>
</body>

</html>

<?php
include_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION["user"];
    $email = !empty($_POST['email']) ? $_POST['email'] : $user['email'];
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : $user['lastname'];
    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : $user['firstname'];
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : $user['phone'];
    $entreprise = !empty($_POST['entreprise']) ? $_POST['entreprise'] : $user['entreprise'];
    $address = !empty($_POST['address']) ? $_POST['address'] : $user['address'];

    $stmt = $connexion->prepare("UPDATE User SET email=?, lastname=?, firstname=?, phone=?, entreprise=?, address=?, updatedAt=CURRENT_TIMESTAMP WHERE id=?");
    $stmt->bind_param("ssssssi", $email, $lastname, $firstname, $phone, $entreprise, $address, $user['id']);

    if ($stmt->execute()) {
        $stmt->close();

        $stmt = $connexion->prepare("SELECT * FROM User WHERE id=?");
        $stmt->bind_param("s", $user['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $_SESSION['user'] = $result->fetch_assoc();
            echo "<script>
                let toast = document.getElementById('toast');
                toast.style.transition = 'transform 2s ease-in-out';
                toast.style.transform = 'translateY(0%)';
                setTimeout(function() {
                    toast.style.transition = 'transform 0.5s ease-in-out';
                    toast.style.transform = 'translateY(200%)';
                  }, 5000);
              </script>";
        } else {
            echo "<script>
            let updateError = document.getElementById('updateError');
            updateError.style.transition = 'transform 1.5s ease-in-out';
            updateError.style.transform = 'translateY(0%)';
            setTimeout(function() {
                updateError.style.transition = 'transform 0.5s ease-in-out';
                updateError.style.transform = 'translateY(200%)';
              }, 5000); 
          </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
        let updateError = document.getElementById('updateError');
        updateError.style.transition = 'transform 1.5s ease-in-out';
        updateError.style.transform = 'translateY(0%)';
        setTimeout(function() {
            updateError.style.transition = 'transform 0.5s ease-in-out';
            updateError.style.transform = 'translateY(200%)';
          }, 5000); 
      </script>";
    }
}


?>