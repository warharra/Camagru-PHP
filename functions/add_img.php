<?php

function add_image($user_ID, $img_path) {
    $bdd = db_connect();
    $addlike = $bdd->prepare("INSERT INTO `img`(`user_ID`, `img_path`) VALUES(?,?)");
    $addlike->execute(array($user_ID, $img_path)); 
}