<?php
function db_connect(){
    include("database.php");
    try {
        $bdd = new PDO($servername.";dbname=".$dbname, $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }
    return $bdd;
}
?>