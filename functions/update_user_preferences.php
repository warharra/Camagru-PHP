<?php
header('Access-Control-Allow-Origin: http://localhost:8080/');
header('Access-Control-Allow-Credentials: true');
session_start();
include("../config/db_connect.php");
if (isset($_SESSION['id']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    $user_ID = $_POST['user_ID'];
    $bdd = db_connect();
    $req_user = $bdd->prepare("SELECT `user_preferences` FROM `user` WHERE `user_ID`= ? ");
    $req_user->execute(array($user_ID)); 
    $pass = $req_user->fetch();
    
    if ($pass['user_preferences'] == 0) {
        $user_preferences = 1;
    }
    else 
        $user_preferences = 0;

    $req_userm = $bdd->prepare("UPDATE `user` SET user_preferences = ? WHERE `user_ID`= ?");
    $req_userm->execute(array($user_preferences,$user_ID)); 
}
function get_user_pref($user_ID)
    {
        $bdd = db_connect();
        $req_user = $bdd->prepare("SELECT `user_preferences` FROM `user` WHERE `user_ID`= ? ");
        $req_user->execute(array($user_ID)); 
        $pass = $req_user->fetch();
        
        if ($pass['user_preferences'] == 1) 
            return(1);
        else
            return(0);
    }

?>
