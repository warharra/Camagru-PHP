<?php
$bdd = db_connect();
if (isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if (!empty($mailconnect) && !empty($mdpconnect)) {
        $requser = $bdd->prepare('SELECT * FROM user WHERE user_email = ?  AND user_password = ? ');
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if ($userexist) {
            $userinfo = $requser->fetch();
            if ($userinfo['user_validated'] == 1) {
                $_SESSION['id'] = $userinfo['user_ID'];
                $_SESSION['pseudo'] = $userinfo['user_pseudo'];
                $_SESSION['mail'] = $userinfo['user_email'];
                $msg = "Vous êtes maintenant connecté !";
                $status = " is-valid";
                header("refresh:2;url=./profil.php");
            } else
                $error = "l'adresse email n'a pas été validée.";
        } else {
            $error = "l'adresse email ou le mot de passe n'existe pas.";
            $status = " is-invalid";
        }
    } else
        $error = "les champs ne peuvent pas être vide.";
}
if (isset($_GET['activation'])) {
    if ($_GET['activation'] == "true")
        $activated = 'Votre compte a bien été activé !';
    else
        $notactivated = 'Votre compte n\'a pas pu être activer';
}
?>
<div class="col-lg-6 center">
    <form action="login.php" method="post">
        <?php
        if (isset($error)) {
            echo '<div class="alert alert-danger">
        <strong>Mince !</strong> <a href="#" class="alert-link">Une erreur est survenue,</a> ' . $error . '
    </div>';
        } else if (isset($msg)) {
            echo '<div class="alert alert-success">
        <strong>Super !</strong> ' . $msg . ' <a href="./profil.php" class="alert-link">Redirection...</a>
    </div>';
        } else if (isset($activated))
            echo '<div class="alert alert-success">
        <strong>Super !</strong> ' . $activated . ' <a href="#" class="alert-link">Vous pouvez vous connecter</a>
        </div>';
        else if (isset($notactivated))
            echo '<div class="alert alert-danger">
        <strong>Mince !</strong> <a href="#" class="alert-link">Une erreur est survenue,</a> ' . $notactivated . '
    </div>';
        ?>
        <fieldset>
            <label>Adresse email</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                    </div>
                    <input type="email" name="mailconnect" class="form-control<?php echo $status; ?>" aria-describedby="emailHelp" placeholder="Entrez votre adresse email">
                </div>
            </div>
            <label>Mot de passe</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="mdpconnect" class="form-control<?php echo $status; ?>" placeholder="Entrez votre mot de passe">
                </div>
            </div>
            <button type="submit" name="formconnexion" class="btn btn-primary">Se connecter</button>
        </fieldset>
        <a href="password.php">Mot de passe oublié </a>
    </form>
</div>