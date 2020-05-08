<?php
include("functions/update_user_preferences.php");
if (isset($_GET['id'])) {
    $images = get_image_by_user_ID($_GET['id']);
} else
    $images = get_image_by_user_ID($_SESSION['id']);
if (($_GET['id'] && $_GET['id'] == $_SESSION['id']) || !$_GET['id'])
    $title = 'Mes images';
else
    $title = 'Images de ' . $user['user_pseudo'];

?>
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_param'])) {
    $bdd = db_connect();
    $id = $_SESSION['id'];
    if (isset($_POST['submit_param'])) {

        $mail = htmlspecialchars($_POST['newemail']);
        $pseudo = htmlspecialchars($_POST['newusername']);
        $old_pass = sha1($_POST['old-password']);
        $new_pass = sha1($_POST['new-password']);
        $req_user = $bdd->prepare("SELECT * FROM `user` WHERE `user_ID` = ?");
        $req_user->execute(array($id));
        $pass = $req_user->fetch();
        $user_password = $pass['user_password'];
        $email_bas = $pass['user_email'];
        $mailexist = $req_user->rowCount();
        if (strlen($new_pass) < 8)
            $error = "votre mot de passe doit comporter au minimum 8 caractères.";
        else if (empty($_POST['newemail']) || empty($_POST['newusername']) || empty($_POST['old-password']) || empty($_POST['new-password']))
            $error = "tous les champs doivent être remplis.";
        else if (strlen($pseudo) > 255)
            $error = "votre pseudo est trop long.";
        else if ($old_pass != $user_password)
            $error = "les mots de passe ne correspondent pas.";
        else if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            $error = "votre adresse email n'est pas valide.";
        else if ($mailexist != 0 && $mail != $email_bas)
            $error = "l'adresse email n'est pas correcte.";
        else {
            $insert = $bdd->prepare('UPDATE `user` SET user_pseudo = ?, user_email = ? , user_password = ? WHERE `user_ID` = ?');
            $insert->execute(array($pseudo, $mail, $new_pass, $id));
            $msg = "Votre modification à bien été prise en compte";
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mail'] = $mail;
        }
        header('Location:./profil.php');
    }
}
?>
<div class="col-lg-9 paddingtop center">
    <div class="fade active show" id="images" aria-labelledby="images-tab">
        <div class="acc-setting">

            <h3><?php echo $title; ?></h3>
            <div class="notbar">
                <div class="row">

                    <?php
                    if (!$images)
                        echo '<div class="center">' . $user['user_pseudo'] . ' n\'a pas encore posté d\'images :(</div>';
                    else
                        foreach ($images as $image)
                            echo ('<div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                        <a href="./image.php?id=' . $image['img_ID'] . '"><img src="' . $image['img_path'] . '" \></a>
                                    </div>');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="fade hidden none" id="parametres" aria-labelledby="parametres-tab">
        <div class="acc-setting">
            <h3>Paramètres</h3>
            <form method="post" action="profil.php">
                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger">
                        <strong>Mince !</strong> <a href="#" class="alert-link">Une erreur est survenue,</a> ' . $error . '
                    </div>';
                } else if (isset($msg)) {
                    echo '<div class="alert alert-success">
                        <strong>Super !</strong> ' . $msg . ' <a href="./login.php" class="alert-link">Vous pouvez maintenant vous connecter</a>.
                    </div>';
                }
                ?>
                <div class="notbar">
                    <h4>Notifications par mail</h4>
                    <p>Activer les notifications par email lorsque quelqu'un commente une de vos images.</p>
                    <div class="toggle-btn">
                        <div class="custom-control custom-switch">
                            <input onclick="update_user_preferences(<?php echo $_SESSION['id'] ?>)" type="checkbox" class="custom-control-input" id="customSwitch1" <?php
                                                                                                                                                                    if (get_user_pref($_SESSION['id'])) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    }
                                                                                                                                                                    echo ">"; ?> <label class="custom-control-label" for="customSwitch1"></label>

                        </div>
                    </div>
                </div>
                <div class="cp-field">
                    <h5>Changer le nom d'utilisateur</h5>
                    <div class="cpp-fiel">
                        <input type="text" name="newusername" placeholder="Nouveau nom d'utilisateur" value=<?php echo $_SESSION['pseudo']; ?>>
                        <i class="fa fa-user"></i>
                    </div>
                </div>
                <div class="cp-field">
                    <h5>Changer l'adresse email</h5>
                    <div class="cpp-fiel">
                        <input type="email" name="newemail" placeholder="Nouvelle adresse email" value=<?php echo $_SESSION['mail']; ?>>
                        <i class="fa fa-envelope"></i>
                    </div>
                </div>
                <div class="cp-field">
                    <h5>Ancien mot de passe</h5>
                    <div class="cpp-fiel">
                        <input type="password" name="old-password" placeholder="Ancien mot de passe">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="cp-field">
                    <h5>Nouveau mot de passe</h5>
                    <div class="cpp-fiel">
                        <input type="password" name="new-password" placeholder="Nouveau mot de passe">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>

                <div class="save-stngs">
                    <ul>
                        <li><button type="submit" name="submit_param">Sauvegarder</button></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>
</div>