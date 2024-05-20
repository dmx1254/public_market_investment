<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/lateral.css">
</head>

<body>
  <div class="lateral">
    <a href="/index.php"><i class="fas fa-home"
        style="<?php echo $current_page == 'index.php' ? 'background-color: #1f2937; color: white;' : ''; ?>"></i></a>
    <a href="/faq.php"><i class="fas fa-lightbulb"
        style="<?php echo $current_page == 'faq.php' ? 'background-color: #1f2937; color: white;' : ''; ?>"></i></a>
    <a href="/calendar.php"><i class="fas fa-calendar"
        style="<?php echo $current_page == 'calendar.php' ? 'background-color: #1f2937; color: white;' : ''; ?>"></i></a>
    <a href="/update-profil.php"><i class="fas fa-cog"
        style="<?php echo $current_page == 'update-profil.php' ? 'background-color: #1f2937; color: white;' : ''; ?>"></i></a>
  </div>
</body>

</html>