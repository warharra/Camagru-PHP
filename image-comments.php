<div id="comments" class="post-comment-box">
    <?php
    if ($_SESSION['id'])
        echo '<div id="post-comment">
            <h3>Poster un commentaire</h3>
            <div class="user-poster">
                <div class="usr-post-img">
                    <img src="' . $me['user_photo'] . '" alt="' . $me['user_pseudo'] . '">
                </div>
                <div class="post_comment_sec">
                    <form action="image.php" method="post">
                        <input type="hidden" value="' . $_GET['id'] . '" name="img_ID" />
                        <textarea placeholder="Votre message" name="comment"></textarea>
                        <button type="submit">Envoyer</button>
                    </form>
                </div><!--post_comment_sec end-->
            </div><!--user-poster end-->
        </div>';
?>
</div>
<div class="comment-section">
    <h3><?php echo(count($imgComments)); ?> Commentaire<?php if (count($imgComments) > 1) echo('s') ?></h3>
    <div class="comment-sec">
        <ul>
            <?php
                foreach ($imgComments as $imgComment) {
                    $date = new DateTime($imgComment['comment_date']);
                    $user = get_user_by_ID($imgComment['user_ID']);
                    echo('<li><div class="comment-list">
                    <div class="bg-img">
                        <a href="profil.php?id=' . $user['user_ID'] . '"><img src="' . $user['user_photo'] . '" alt="' . $user['user_pseudo'] .'"></a>
                    </div>
                    <div class="comment">
                        <a href="profil.php?id=' . $user['user_ID'] . '"><h3>' . $user['user_pseudo'] . '</h3></a>
                        <span><i class="far fa-clock"></i> ' . get_time_ago($date->getTimestamp()) .'</span>
                        <p>'. $imgComment['comment_comment'] .'</p>
                    </div>
                </div></li>');
            }
            ?>
            <!--comment-list end-->
        </ul>
    </div><!--comment-sec end-->
</div>
