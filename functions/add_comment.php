<?php
include("update_user_preferences.php");
function add_comment($user_ID, $img_ID, $comment_comment)
{
    $comment_comment = htmlspecialchars($comment_comment);
    $bdd = db_connect();
    $addcomment = $bdd->prepare("INSERT INTO `comment`(`user_ID`, `img_ID`,`comment_comment`) VALUES(?,?,?)");
    if ($comment_comment != "") {
        $addcomment->execute(array($user_ID, $img_ID, $comment_comment));
    }
    $reqid = $bdd->prepare('SELECT `user_ID` FROM img WHERE `img_ID` = ?');
    $reqid->execute(array($img_ID)) && $row = $reqid->fetch();
    $user_id = $row['user_ID'];
    if (get_user_pref($user_id) == 1) {
        $reqemail = $bdd->prepare('SELECT `user_email` FROM user WHERE `user_ID` = ?');
        $reqemail->execute(array($user_id)) && $row = $reqemail->fetch();
        $email = $row['user_email'];
        $destinataire = $email;
        $sujet = "Vous avez reçu un commentaire";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: "Camagru"<camagru@42.fr>' . "\n";
        $message = 'Un utilisateur vient de commenter l\'une de vos photo';
        mail($destinataire, $sujet, $message, $headers);
    }
}
?>