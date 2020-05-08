<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Instapouet - Image</title>
	<?php include('css-handler.php');?>
</head>
<body>
<?php include("topmenu.php"); ?>
<?php
$image = get_image_by_ID($_GET['id']);
$author = get_user_by_ID($image['user_ID']);
$postdate = new DateTime($image['img_upload_date']);
$comments = get_content_by_user_ID($me['user_ID']);
if (!$_GET['id'])
  header("Location: post.php");
include("functions/add_comment.php");
?>
<div class="main">
    <div class="container">
      <?php
      if (isset($_SESSION['id']))
        include("home-user-profil.php");
      include("image-core.php");
      ?>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>