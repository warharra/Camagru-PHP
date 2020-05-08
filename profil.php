<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Instapouet - Connexion</title>
  <?php
  include('css-handler.php');
  $bdd = db_connect();
  ?>
</head>

<body>
  <?php
  include("topmenu.php");
  ?>
  <?php
  if (!$_GET['id'] || itsMe($_GET['id']))
    $user = $me;
  else
    $user = get_user_by_ID($_GET['id']);
  if (!$user) {
    header("Location: .");
  }
  include("functions/change_photo.php");
  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['chcover'] || $_POST['chpp']) {
    if (isset($_POST['chcover'])) {
      $uploaddir = './images/user_cover/';
      $type = '_cover.';
      $updatephoto = $bdd->prepare('UPDATE `user` SET `user_cover` = ? WHERE user_pseudo = ?');
    } else if (isset($_POST['chpp'])) {
      $uploaddir = './images/user/';
      $type = '.';
      $updatephoto = $bdd->prepare('UPDATE `user` SET `user_photo` = ? WHERE user_pseudo = ?');
    } else {
      header("Location: post.php");
    }
    $uploadfile = $uploaddir . $user['user_pseudo'] . $type . 'jpg';
    $updatephoto->execute(array($uploadfile, $user['user_pseudo']));
    changePhoto($uploadfile, $_FILES);
  }
  ?>
  <?php
  if (!isset($_SESSION['id']) && !isset($_GET['id']))
    header("location: ./login.php");
  include("profil-header.php");
  ?>
  <div class="container">
    <?php
    include("profil-user.php");
    ?>
  </div>
</body>
<?php include("footer.php"); ?>

</html>