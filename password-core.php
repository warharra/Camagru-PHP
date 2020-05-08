<?php
$bdd = db_connect();
if (isset($_POST['recup_submit'])) {
   if (!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if (filter_var($recup_mail, FILTER_VALIDATE_EMAIL)) {
         $mailexist = $bdd->prepare('SELECT user_ID, user_pseudo FROM user WHERE user_email = ?');
         $mailexist->execute(array($recup_mail));
         $mailexist_count = $mailexist->rowCount();

         if ($mailexist_count == 1) {
            $pseudo = $mailexist->fetch();
            $pseudo = $pseudo['pseudo'];

            $_SESSION['recup_mail'] = $recup_mail;
            $recup_code = "";
            $i = -1;
            while ($i++ < 8) {
               $recup_code .= mt_rand(0, 9);
            }
            $mail_recup_exist = $bdd->prepare('SELECT id FROM recuperation WHERE user_email = ?');
            $mail_recup_exist->execute(array($recup_mail));
            $mail_recup_exist = $mail_recup_exist->rowCount();
            if ($mail_recup_exist == 1) {
               $recup_insert = $bdd->prepare('UPDATE recuperation SET code = ? WHERE user_email = ?');
               $recup_insert->execute(array($recup_code, $recup_mail));
               $recup_insert = $bdd->prepare('UPDATE recuperation SET confirme = ? WHERE user_email = ?');
               $recup_insert->execute(array(0, $recup_mail));
            } else {
               $recup_insert = $bdd->prepare('INSERT INTO recuperation(user_email,code, confirme) VALUES (?, ?, ?)');
               $recup_insert->execute(array($recup_mail, $recup_code, 0));
            }
            $header = "MIME-Version: 1.0\r\n";
            $header .= 'From:"Camagru"<camagru@42.fr>' . "\n";
            $header .= 'Content-Type:text/html; charset="utf-8"' . "\n";
            $header .= 'Content-Transfer-Encoding: 8bit';
            $sujet  =  "Récupération de mot de passe ";
            $message = '
         <html>
         <head>
           <title>Récupération de mot de passe</title>
           <meta charset="utf-8" />
         </head>
         <body>
           <font color="#303030";>
             <div align="center">
               <table width="600px">
                 <tr>
                   <td>
                     
                     <div align="center">Bonjour <b>' . $pseudo . '</b>,</div>
                     Voici votre code de récupération: <b>' . $recup_code . '</b>
                     À utiliser sur <a href="http://localhost:8080/camagru/recuperation.php">la page de récupération</a> !
                     
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
         </html>
         ';
            mail($recup_mail, $sujet, $message, $header);
            header("localhost:8080/camagru/recuperation.php?section=code");
            $success = "Un mail vient de vous être envoyé.";
         } else {
            $error = "Cette adresse mail n'est pas enregistrée.";
         }
      } else {
         $error = "Adresse mail invalide.";
      }
   } else {
      $error = "Veuillez entrer votre adresse mail.";
   }
}
?>
<div class="col-lg-6 center">
   <form method="POST" action="password.php">
      <?php
      if (isset($error)) {
         echo '<div class="alert alert-danger">
        <strong>Mince !</strong> <a href="#" class="alert-link">Une erreur est survenue,</a> ' . $error . '
    </div>';
      } else if (isset($success)) {
         echo '<div class="alert alert-success">
        <strong>Super !</strong> <a href="#" class="alert-link">' . $success . '</a>
        </div>';
      }
      ?>
      <label>Recuperation de mot de passe</label>
      <div class="input-group mb-3">
         <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
         </div>
         <input type="email" name="recup_mail" class="form-control" placeholder="Entrez votre adresse email">
      </div>
      <input class="btn btn-primary" type="submit" value="Valider" name="recup_submit" />
   </form>
</div>