<?php
function get_user_by_ID($user_ID) {
    $bdd = db_connect();
    $rep = array();
    $req = $bdd->prepare('SELECT * FROM `user`WHERE `user_ID`= ?');
    $req->execute(array($user_ID));
    
    while ($donnees = $req->fetch()){
        $rep = $donnees;
    }
    $req->closeCursor();
    return ($rep);
}
