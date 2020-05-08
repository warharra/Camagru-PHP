<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Instapouet - Connexion</title>
	<?php include('css-handler.php');?>
</head>
<body>
<?php include("topmenu.php"); ?>
<div class="main">
    <div class="container">
    <?php
    if (isset($_SESSION['id']))
      header("Location: ./profil.php");
    include("login-core.php");
    ?>
</div>
</div>
<?php include("footer.php"); ?>
</body>
</html>