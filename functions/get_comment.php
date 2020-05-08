<?php
function get_content_by_ID($img_ID) {
    $bdd = db_connect();
    $req = $bdd->prepare('SELECT * FROM `comment`WHERE `img_ID`= ?');
    $req->execute(array($img_ID));
    $rep= array();
    while ($donnees = $req->fetch()){
        $rep[]=$donnees;
    }
    $req->closeCursor();
    return ($rep);
}
function get_content_by_user_ID($user_ID) {
    $bdd = db_connect();
    $req = $bdd->prepare('SELECT * FROM `comment`WHERE `user_ID`= ?');
    $req->execute(array($user_ID));
    $rep= array();
    while ($donnees = $req->fetch()){
        $rep[]=$donnees;
    }
    $req->closeCursor();
    return ($rep);
}