<?php
session_start();
date_default_timezone_set('europe/paris');
// Connexion bdd en dur car il faut pouvoir l'atteindre avant d'afficher la page
include("config/database.php");
try {
    $bdd = new PDO($servername . ";dbname=" . $dbname, $username, $password);
} catch (PDOException $e) {
    die('Erreur:' . $e->getMessage());
}
$id = $_SESSION['id'];
$id_img = $_SESSION['id_img'];

if (isset($_POST['webcam']))
    $onload = "openWebcam()";
else
    $onload = "uploadImage()";

    function last_img_ID() {
        include("config/database.php"); 
        try {
            $bdd = new PDO($servername . ";dbname=" . $dbname, $username, $password);
        } catch (PDOException $e) {
            die('Erreur:' . $e->getMessage());
        }
        if (isset($bdd))
            echo "pouet";
        $req = $bdd->prepare("SELECT * FROM `img`");
        $req->execute(array($img_ID));
        
        while ($donnees = $req->fetch()){
            $rep = $donnees;
        }
        $req->closeCursor();
        return ($rep['img_ID']);
    }

if (isset($_POST['webcamuploaded'])) {
    $data = $_POST['webcamuploaded'];
    list($data, $src) = explode('http', $data);
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $_SESSION['data'] = $data;
    if ($src != "")
        $_SESSION['img_src'] = "http" . $src;
    else
        $_SESSION['img_src'] = "";

    $data = base64_decode($data);

    $i = last_img_ID()+1;

    $uploadfile = file_put_contents('./images/user_images/' . $i, $data);
    $uploaddir = './images/user_images/' . $i;
    $iurl = $uploaddir;
    $_SESSION['iurl'] = $iurl;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploaddir = './images/user_images/';
    $uploadfile = $uploaddir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
        $iurl = $uploadfile;
        $_SESSION['iurl'] = $uploadfile;
    }
    if (isset($_POST['poster_img'])) {
        $img_uploade_date = date("Y-m-d H:i:s");
        $req = $bdd->prepare('INSERT INTO `img`(`user_ID`, `img_name`, `img_upload_date`, `img_path`) VALUES(?,?,?,?)');
        $req->execute(array($id, "default", $img_uploade_date, $_SESSION['iurl']));
        $iurl = $_SESSION['iurl'];
        $req = $bdd->prepare('SELECT `img_ID` FROM `img`WHERE `img_path`= ?');
        $req->execute(array($iurl)) && $img_id = $req->fetch();
        $id = $img_id['img_ID'];
        $_SESSION['id_img'] = $id;
        $_SESSION['iurl'] += 1;
        header("Location: ./image.php?id=" . $id);
    }
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Instapouet - Poster une photo</title>
    <?php include('css-handler.php'); ?>
</head>

<body onload="<?php echo $onload; ?>">
    <?php
    include("topmenu.php");
    redirectTo($loginpage);
    ?>
    <div class="main">
        <div class="container">
            <?php
            $images = get_images();
            include("post-image.php");
            if (!$uploadfile || !$_POST['webcam'])
                include("home-user-profil.php");
            else
                include("post-stickers.php");
            ?>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>