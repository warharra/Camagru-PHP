<?php
$rep = array();
function get_image_by_ID($img_ID) {
    $bdd = db_connect();
    $req = $bdd->prepare('SELECT * FROM `img`WHERE `img_ID`= ?');
    $req->execute(array($img_ID));
    
    while ($donnees = $req->fetch()){
        $rep = $donnees;
    }
    $req->closeCursor();
    return ($rep);
}
function get_image_by_user_ID($user_ID) {
    $bdd = db_connect();
    $req = $bdd->prepare('SELECT * FROM `img`WHERE `user_ID`= ?');
    $req->execute(array($user_ID));
    
    while ($donnees = $req->fetch()){
        $rep[] = $donnees;
    }
    $req->closeCursor();
    if ($rep)
        return array_reverse($rep);
}
function get_images() {
    $bdd = db_connect();
    $req = $bdd->prepare('SELECT * FROM `img`');
    $req->execute(array());
    
    while ($donnees = $req->fetch()){
        $rep[] = $donnees;
    }
    $req->closeCursor();
    if ($rep)
        return array_reverse($rep);
}
