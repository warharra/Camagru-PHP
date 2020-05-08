<?php
$adminMail = 'camagru@42.fr';
$bdd = db_connect();
if (isset($_POST['register'])) {
    $mdp = $_POST['mdp'];
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $isvalid = preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\W])(?=\S*[\d])\S*$/', $mdp);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    $reqmail = $bdd->prepare('SELECT * FROM user WHERE user_email = ?');
    $reqmail->execute(array($mail));
    $mailexist = $reqmail->rowCount();
    if (strlen($mdp) < 8)
        $error = "votre mot de passe doit comporter au minimum 8 caractères.";
    else if (!$isvalid)
        $error = "votre mot de passe doit comporter au moins un chiffre, une majuscule et un caractère spécial.";
    else if (empty($_POST['pseudo']) || empty($_POST['mail']) || empty($_POST['mail2']) || empty($_POST['mdp']) || empty($_POST['mdp2']))
        $error = "tous les champs doivent être remplis.";
    else if (strlen($pseudo) > 255)
        $error = "votre pseudo est trop long.";
    else if ($mail != $mail2)
        $error = "les adresses email ne correspondent pas.";
    else if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
        $error = "votre adresse email n'est pas valide.";
    else if ($mailexist != 0)
        $error = "l'adresse email existe déjà.";
    else if ($mdp != $mdp2)
        $error = "les mots de passe ne correspondent pas.";
    else {
        $insertmbr = $bdd->prepare("INSERT INTO user(user_pseudo, user_email, user_password, user_preferences) VALUES(?,?,?,?)");
        $insertmbr->execute(array($pseudo, $mail, $mdp, 0));
        $reqid = $bdd->prepare('SELECT `user_ID` FROM user WHERE user_pseudo = ? and user_email = ?');
        $reqid->execute(array($pseudo, $mail)) && $row = $reqid->fetch();
        $cle = $row['user_ID'];
        $destinataire = $mail;
        $sujet = "Activez votre compte";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: "Camagru"<' . $adminMail . '>' . "\n";
        $message = '<html>
                <head>
                <title>Bienvenue sur VotreSite,</title>
                <meta charset="utf-8" />
                </head>
                <body>
                <font color="#303030";>
                    <div align="center">
                    <table width="600px">
                        <tr>
                        <td>
                            
                            <div align="center">Bonjour <b>' . $pseudo . '</b>,</div>
                            Pour activer votre compte, veuillez cliquer sur le lien ci dessous.
                            À bientôt sur <a href=" http://localhost:8080/camagru/activation.php?log=' . urlencode($pseudo) . '&cle=' . urlencode($cle) . '">Instapouet</a> ! 
                        </td>
                        </tr>
                        <tr>
                        <td align="center">
                            <font size="2">
                            Ceci est un email automatique, merci de ne pas y répondre
                            </font>
                        </td>
                        </tr>
                    </table>
                    </div>
                </font>
                </body>
                </html>';
        mail($destinataire, $sujet, $message, $headers);
        $msg = "Votre compte a bien été créé.";
    }
}
?>
<div class="col-lg-6 center">
    <form action="register.php" method="post">
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
        <fieldset>
            <label>Pseudo</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="pseudo" class="form-control" aria-describedby="emailHelp" placeholder="Entrez votre adresse email">
                </div>
            </div>
            <label>Adresse email</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                    </div>
                    <input type="email" name="mail" class="form-control" aria-describedby="emailHelp" placeholder="Entrez votre adresse email">
                </div>

            </div>
            <label>Confirmer l'adresse email</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                    </div>
                    <input type="email" name="mail2" class="form-control" aria-describedby="emailHelp" placeholder="Entrez votre adresse email">
                </div>
            </div>
            <label>Mot de passe</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="mdp" class="form-control" placeholder="Entrez votre mot de passe">
                </div>
            </div>
            <label>Confirmer le mot de passe</label>
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="mdp2" class="form-control" placeholder="Entrez votre mot de passe">
                </div>
            </div>
        </fieldset>
        <button type="submit" name="register" class="btn btn-primary">S'inscrire</button>
        </fieldset>
    </form>
</div>