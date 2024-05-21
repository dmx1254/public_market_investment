<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <link rel="stylesheet" href="css/navbar.css">

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>
  <nav class="navbar">
    <div class="logo">
      <a href="/">
        <img src="images/logodesk.png" alt="logo" class="logodesk" />
      </a>
      <a href="/">
        <img src="images/logomob.png" alt="logo" class="logomob" />
      </a>
    </div>
    <div class="search">
      <input type="text" id="search-query" placeholder="ex. Travaux..." />
      <button id="search-button"><i class="fas fa-search"></i></button>
    </div>
    <div class="links flex items-center gap-0">
      <?php if (isset($_SESSION["user"])): ?>
        <div class="flex items-center content-links">
          <a href="/profil.php" style="" class="link-img"><img src="images/user.png" id="user-icon" alt="user picture"
              class="w-7 h-7 object-cover object-center rounded-full cursor-pointer"></a>
          <a href="/logout.php" class="mt-1 text-gray-400">
            <i class="fas fa-sign-out-alt text-2xl"></i>
          </a>
        </div>
      <?php else: ?>
        <a href="/signup.php" class="signup">Créer un compte</a>
        <a href="/signin.php">Login</a>
      <?php endif; ?>
    </div>
  </nav>
  <script>
    document.getElementById("user-icon").addEventListener("click", function () {
      var dropdownContent = document.getElementById("dropdown-content");
      dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });

    document.getElementById("search-button").addEventListener("click", function () {
      var query = document.getElementById("search-query").value;
      if (query) {
        window.location.href = "search.php?q=" + encodeURIComponent(query);
      }
    });

    document.getElementById("search-query").addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        var query = document.getElementById("search-query").value;
        if (query) {
          window.location.href = "search.php?q=" + encodeURIComponent(query);
        }
      }
    });

    document.getElementById("user-icon").addEventListener("click", function () {
      var dropdownContent = document.getElementById("dropdown-content");
      dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
  </script>
</body>

</html>