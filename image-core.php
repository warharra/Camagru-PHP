<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        add_comment($me['user_ID'], $_POST['img_ID'], $_POST['comment']);
        $redirect = 'image.php?id='.$_POST['img_ID'];
        header("Location: ".$redirect);
    }
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $imgComments = get_content_by_ID($_GET['id']);
        $nbComments = count($imgComments);
        include("functions/get_time_ago.php");
    }
    include("functions/img_liked_by_user.php");
    include("functions/like.php");

    
$img_id = $_GET['id'];
$_SESSION['img_id'] = $img_id;
?>
<div class="col-lg-9 col-md-8 center">
        <div class="main-feed">
            <div class="posts-section">
                <div class="post-bar">
                    <div class="post_topbar">
                        <div class="usy-dt">
                            <a href="profil.php?id=<?php echo $author['user_ID']; ?>"><img src="<?php echo $author['user_photo'] ?>" alt="<?php echo $author['user_pseudo'];?>"></a>
                            <div class="usy-name">
                                <h3><a href="profil.php?id=<?php echo $author['user_ID']; ?>"><?php echo $author['user_pseudo'];?></a></h3>
                                <span><i class="far fa-clock"></i> le <?php echo $postdate->format('d/m/Y') .' à '. $postdate->format('H:i');?></span>
                            </div>
                        </div>
                        <form method="post" action="delete_img.php">
                        <?php
                        if (itsMe($author['user_ID']))
                            echo '<div class="ed-opts">
                            <span class="ed-opts-open" onclick="showOptions(' . $_GET['id'] .')"><i class="la la-ellipsis-v"></i></span>
                            <ul id="delete-' . $image['img_ID'] .'" class="ed-options hidden">
                                <button class="btn" value="' . $image['img_ID'] .'" name="delete_img">Supprimer</button>
                            </ul>
                        </div>
                    </div>';
                    ?>
                    </form>
                    <div class="post_content">
                        <img class="post_img" src="<?php echo($image['img_path']); ?>" alt="sample image" \>
                    </div>
                    <div class="post-status-bar">
                        <ul id="like-com" class="like-com">
                            <li>
                                <span onclick="like(<?php if ($_SESSION['id']) { echo $_GET['id']; } else { echo '-1'; }?>)" onmouseover="chcl('#e44b4b', 'heart-<?php echo $img_id;?>')" onmouseout="chcl('#b2b2b2', 'heart-<?php echo $img_id;?>')">
                                <i id="heart-<?php echo $img_id;?>" class="fas fa-heart <?php if (img_liked_by_user($me['user_ID'], $_GET['id']) == 1) { echo 'liked';}?>"></i> 
                                Like <span id="likes-<?php echo $img_id;?>"><?php echo(get_nb_likes($_GET['id']));?></span></span>
                            </li> 
                            <li><a href="#comments" class="com" onmouseover="chcl('#4582EC', 'com-<?php echo $img_id;?>')" onmouseout="chcl('#b2b2b2', 'com-<?php echo $img_id;?>')"><i id="com-<?php echo $img_id;?>" class="fas fa-comment"></i> Commentaire<?php echo plural($nbComments).' '.$nbComments;?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php include("image-comments.php"); ?>
    </div>
</div>
