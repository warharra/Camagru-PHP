<?php session_start();?>
<?php
$loginpage = 'login.php';
$registerpage = 'register.php';
function redirectTo( $url ) {
    if (!isset($_SESSION['id']))
        header('Location: '.$url);
}
include("functions/get_comment.php");
include("functions/get_image.php");
include("functions/get_user.php");
if (isset($_SESSION['id']))
  $me = get_user_by_ID($_SESSION['id']);

function itsMe( $user ) {
    if ($user == $_SESSION['id'])
        return 1;
    else
        return 0;
}
function plural( $n ) {
  if ($n > 1)
    return 's';
  else
    return '';
}
?>
<nav class="site-header sticky-top py-1">
  <div class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="py-2" href=".">
    <i class="fab fa-instagram" style="font-size:30px;"></i>
        </a>
        <span></span>
    <a class="py-2 d-md-inline-block" href=".">Accueil</a>
    <?php 
    if (!$me)
        echo '<a class="py-2 d-md-inline-block" href="./login.php">Connexion</a>
        <a class="py-2 d-md-inline-block" href="./register.php">Inscription</a>';
    else
            echo '<a class="py-2 d-md-inline-block" href="./profil.php">Profil</a>
            <a class="py-2 d-md-inline-block" href="./logout.php">Déconnexion</a>';
    ?>
<span></span>
  </div>
</nav>