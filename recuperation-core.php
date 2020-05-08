<?php
$bdd = db_connect();
function debug_to_console($data)
{
   $output = $data;
   if (is_array($output))
      $output = implode(',', $output);
}
if (isset($_POST['verif_submit'])) {
   if (!empty($_POST['verif_code']) && !empty($_POST['recup_mail'])) {
      $verif_code = htmlspecialchars($_POST['verif_code']);

      $verif_email = htmlspecialchars($_POST['recup_mail']);
      $verif_req = $bdd->prepare('SELECT * FROM `recuperation` WHERE user_email = ? AND code = ?');
      $verif_req->execute(array($verif_email, $verif_code)) && $row = $verif_req->fetch();
      $confirme = $row['confirme'];
      $verif_req = $verif_req->rowCount();
      if ($verif_req == 1 && $confirme == 0) {
         $up_req = $bdd->prepare('UPDATE `recuperation` SET confirme = 1 WHERE user_email = ?');
         $up_req->bindParam(array($verif_email));
         $up_req->execute(array($verif_email));
         header('Location: ./recuperation.php?section=changemdp');
      } else {
         $erreur = "Code invalide";
      }
   } else {
      $erreur = "Veuillez entrer votre code de confirmation";
   }
}
if (isset($_POST['nvmdp_submit'])) {
   $email = htmlspecialchars($_POST['recup1_mail']);
   $nvmdp = htmlspecialchars($_POST['nv_mdp']);
   $len_mdp = strlen($nvmdp);
   if ($len_mdp > 9) {
      if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $nvmdp)) {
         if (isset($_POST['nv_mdp'], $_POST['cnv_mdp'])) {
            $mdp = htmlspecialchars($_POST['nv_mdp']);
            $mdpc = htmlspecialchars($_POST['cnv_mdp']);
            if (!empty($mdp) && !empty($mdpc)) {
               if ($mdp == $mdpc) {
                  $mdp = sha1($mdp);
                  debug_to_console($mdp);
                  $ins_mdp = $bdd->prepare('UPDATE `user` SET user_password = ? WHERE user_email = ?');
                  $ins_mdp->bindParam(array($mdp, $email));
                  $ins_mdp->execute(array($mdp, $email));
                  header('Location:http://localhost:8080/camagru/login.php');
               } else {
                  $erreur = "Vos mots de passe ne correspondent pas";
               }
            } else {
               $erreur = "Veuillez remplir tous les champs";
            }
         } else {
            $erreur = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
         }
      } else {
         $erreur = "Votre mot de passe doit se composer de chiffres et de lettres et comprendre des majuscules/minuscules ou des caractères spéciaux";
      }
   } else {
      $erreur = "Votre mot de passe doit comporter un minimum de 8 caractères";
   }
}

?>
<body>
   <div class="col-lg-6 center">
   <?php
      if (isset($erreur)) {
         echo '<div class="alert alert-danger">
        <strong>Mince !</strong> <a href="#" class="alert-link">Une erreur est survenue,</a> ' . $erreur . '
    </div>';
      } ?>
   <label>Recuperation de mot de passe</label>
      <?php
      if (isset($_GET['section'])) {
         $section = $_GET['section'];
         if ($section == "changemdp") { ?>
            <form method="POST">
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                  </div>
               <input type="email" name="recup1_mail" class="form-control" placeholder="Votre adresse mail">
               </div>
               <div class="input-group-prepend">
                  <div>
                     <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  </div>
                  <input type="password" name="nv_mdp" class="form-control" placeholder="Nouveau mot de passe">
               </div>
               <div class="input-group-prepend">
                  <div>
                     <span class="input-group-text"><i class="fa fa-lock"></i></span>
                  </div>
                  <input type="password" name="cnv_mdp" class="form-control" placeholder="Confirmation du mot de passe">
               </div>
               <div>
                  <input class="btn btn-primary" type="submit" value="Valider" name="nvmdp_submit" />
               </div>
            </form>

         <?php }
      } else { ?>
          <form method="POST">
         <div class="input-group mb-3">
         <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
         </div>
         <input type="email" name="recup_mail" class="form-control" placeholder="Votre adresse mail">
        </div>
        <div class="input-group-prepend">
         <div>
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
         </div>
         <input type="texte" name="verif_code" class="form-control" placeholder="Votre Code">
      </div>
      <div>
      <input class="btn btn-primary" type="submit" value="Valider" name="verif_submit" />
   </div>
   </form>
      
      <?php  }
      ?>
   </div>
</body>