<?php
include("database.php");
try{
    $pdo = new PDO($servername, $username, $password); 
}
catch(Exception $e){
	die('Erreur : '.$e->getMessage());
}
$requete = "CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$pdo->prepare($requete)->execute(); 
$conn = new PDO($servername.";dbname=".$dbname, $username, $password);
$sql = file_get_contents("setup_mysql.sql");
$conn->prepare($sql)->execute(); 
?>