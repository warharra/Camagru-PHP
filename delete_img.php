<?php
session_start();
include("config/db_connect.php");
$bdd = db_connect();
$id = $_SESSION['id'];
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_img'])) {
        $me = $_SESSION['id'];
        $img_ID = $_SESSION['img_id'];
        $req = $bdd->prepare('SELECT * FROM `img` WHERE `img_ID`= ?');
        $req->execute(array($img_ID)) && $user = $req->fetch();
        $user_id = $user['user_ID'];
        $path_id = $user['img_path'];
        if ($me == $user_id) {
            $deletelike = $bdd->prepare("DELETE FROM `liked` WHERE `user_ID`= ? AND `img_ID`= ?");
            $deletelike->execute(array($me, $img_ID));
            $deletecomment = $bdd->prepare("DELETE FROM `comment` WHERE `user_ID`= ? AND `img_ID`= ?");
            $deletecomment->execute(array($me, $img_ID));
            $deleteimg = $bdd->prepare("DELETE FROM `img` WHERE `user_ID`= ? AND `img_ID`= ?");
            $deleteimg->execute(array($me, $img_ID));
            unlink($path_id);
            header("Location: ./index.php");
        }
    }
}
