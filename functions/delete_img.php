<?php
include("image-core.php");
function delete()
{

if (!isset($_SESSION['id'])){
header('Location:connexion.php');
exit();
}
$user_ID = $_SESSION['id'];
$img_ID = $_POST['img_ID'];
$req = $bdd->prepare('SELECT `user_ID` FROM `img` WHERE `img_ID`= ?');
$req->execute(array($img_ID)) && $user_Id = $req->fetch();
$user_id = $user_Id['user_ID']; //celui qui a poster img
if($user_ID == $user_id)
{
$deletelike = $bdd->prepare("DELETE FROM `liked` WHERE `user_ID`= ? AND `img_ID`= ?");
$deletelike->execute(array($user_ID, $img_ID));  

$deletecomment = $bdd->prepare("DELETE FROM `comment` WHERE `user_ID`= ? AND `img_ID`= ?");
$deletecomment->execute(array($user_ID, $img_ID));  

$deleteimg = $bdd->prepare("DELETE FROM `img` WHERE `user_ID`= ? AND `img_ID`= ?");
$deleteimg->execute(array($user_ID, $img_ID));  
}
}
?>