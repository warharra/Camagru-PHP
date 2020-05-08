<?php
header('Access-Control-Allow-Origin: http://localhost:8080/');
header('Access-Control-Allow-Credentials: true');
session_start();
include("../config/db_connect.php");
if (isset($_SESSION['id']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    $user_ID = $_SESSION['id'];
    $img_ID = $_POST['image_ID'];
    $bdd = db_connect();
    $req_img = $bdd->prepare("SELECT * FROM `liked` WHERE `user_ID`= ? AND `img_ID`= ?");
    $req_img->execute(array($user_ID, $img_ID)); 
    $img_liked = $req_img->rowCount();
    if($img_liked == 0){
        $insertlike = $bdd->prepare("INSERT INTO `liked`(`user_ID`, img_ID) VALUES(?,?)");
        $insertlike->execute(array($user_ID, $img_ID));  
    }
    else{
        $deletelike = $bdd->prepare("DELETE FROM `liked` WHERE `user_ID`= ? AND `img_ID`= ?");
        $deletelike->execute(array($user_ID, $img_ID));  
    }
}
function get_nb_likes($img_ID) {
    $bdd = db_connect();
    $req_img = $bdd->prepare("SELECT * FROM `liked` WHERE `img_ID`= ?");
    $req_img->execute(array($img_ID));
    $nb_likes = $req_img->rowCount();
    return $nb_likes;
}
?>
