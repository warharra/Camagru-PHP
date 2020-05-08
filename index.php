<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Instapouet</title>
	<?php include('css-handler.php');?>
</head>
<body>
<?php include("topmenu.php"); ?>
<div class="main">
  <div class="container">
  <?php
  $images = get_images();
  $imguserpp = './images/user/';
  $imgusercover = './image/user_cover/';
  $imguserimg = './images/user_images/';
      if (isset($_SESSION['id']))
        include("home-user-profil.php");
      include("home-feed.php");
  ?>
  </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>