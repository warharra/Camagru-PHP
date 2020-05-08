<?php
include("functions/img_liked_by_user.php");
include("functions/like.php");
if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 1;
$nbPostsPerPage = 5;
if ($images) {
    $nbPosts = count($images);
    $nbPages = ceil($nbPosts / $nbPostsPerPage);
} else {
    $nbPosts = 0;
    $nbPages = 1;
}
echo $_SESSION['img_id2'] = $images[$c]['img_ID'];
?>
<div class="col-lg-9 col-md-8 center">
    <div class="main-feed">
        <div class="post-topbar">
            <div class="user-picy usy-dt">
                <img src="<?php echo $me['user_photo']; ?>" alt="">
            </div>
            <div class="post-st">
                <ul>
                    <li><a class="post-jb active" href="post.php" title="Poster une photo">Poster une photo</a></li>
                </ul>
            </div>
            <!--post-st end-->
        </div>
        <!--post-topbar end-->
        <?php
        for ($post = 0; $post < $nbPostsPerPage; $post++) {
            $c = (($page * $nbPostsPerPage) - $nbPostsPerPage) + $post;
            if (!$images[$c])
                break;
            $user = get_user_by_ID($images[$c]['user_ID']);
            if (img_liked_by_user($user['user_ID'], $images[$c]['img_ID']))
                $liked = ' liked';
            else
                $liked = '';
            $nbLikes = get_nb_likes($images[$c]['img_ID']);
            $nbComments = count(get_content_by_ID($images[$c]['img_ID']));
            $date = new DateTime($images[$c]['img_upload_date']);
            if ($_SESSION['id'])
                $likeid = $images[$c]['img_ID'];
            else
                $likeid = -1;
            echo '<div class="posts-section">
                <div class="post-bar">
                    <div class="post_topbar">
                        <div class="usy-dt">
                            <img src="' . $user['user_photo'] . '" alt="">
                            <div class="usy-name">
                                <h3><a href="profil.php?id=' . $images[$c]['user_ID'] . '">' . $user['user_pseudo'] . '</a></h3>
                                <span><i class="far fa-clock"></i> le ' . $date->format('d/m/Y') . ' à ' . $date->format('H:i') . '</span>
                            </div>
                        </div>';
            if (itsMe($user['user_ID']))
                echo '<form method="post" action="delete_img.php">
                    <div class="ed-opts">
                    <span class="ed-opts-open" onclick="showOptions(' . $images[$c]['img_ID'] . ')"><i class="la la-ellipsis-v"></i></span>
                    <ul id="delete-' . $images[$c]['img_ID'] . '" class="ed-options hidden">
                    <button class="btn" value="' . $images[$c]['img_ID'] . '" name="delete_img">Supprimer</button>
                    </ul>
                    </div>
                    </form>';
            echo '</div>
                <div class="post_content">                    
                    <a class="center" href="./image.php?id=' . $images[$c]['img_ID'] . '"><img class="post_img" src="' . $images[$c]['img_path'] . '" alt="sample image" \></a>
                </div>
                <div class="post-status-bar">
                    <ul id="like-com-' . $images[$c]['img_ID'] . '" class="like-com">
                        <li>
                            <span onclick="like(' . $likeid . ')" onmouseover="chcl(\'#e44b4b\', \'heart-' . $images[$c]['img_ID'] . '\')" onmouseout="chcl(\'#b2b2b2\', \'heart-' . $images[$c]['img_ID'] . '\')"><i id="heart-' . $images[$c]['img_ID'] . '" class="fas fa-heart' . $liked . '"></i> Like <span id="likes-' . $images[$c]['img_ID'] . '">' . $nbLikes . '</span></span>
                        </li> 
                            <li><a href="./image.php?id=' . $images[$c]['img_ID'] . '#comments" class="com" onmouseover="chcl(\'#4582EC\', \'com-' . $images[$c]['img_ID'] . '\')" onmouseout="chcl(\'#b2b2b2\', \'com-' . $images[$c]['img_ID'] . '\')"><i id="com-' . $images[$c]['img_ID'] . '" class="fas fa-comment"></i> Commentaire' . plural($nbComments) . ' ' . $nbComments . '</a></li>
                    </ul>
                </div>
            </div><!--post-bar end-->
        </div>';
        }
        ?>
    </div>
    <!--main-feed end-->
    <?php include("pagination.php"); ?>
</div>