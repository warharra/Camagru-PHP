<?php
$comments = get_content_by_user_ID($_SESSION['id']);
$user_images = get_image_by_user_ID($_SESSION['id']);
?>
<div class="col-lg-3 col-md-4 wav-left-none">
    <div class="main-left-sidebar no-margin">
        <div class="user-data full-width">
            <div class="user-profile">
                <div class="username-dt" style="background-image:url('<?php echo $me['user_cover']; ?>')">
                    <div class="usr-pic" style="background-image:url('<?php echo $me['user_photo']; ?>')">
                        <img class="none" src="<?php echo $me['user_photo'];?>" alt="">
                    </div>
                </div><!--username-dt end-->
                <div class="user-specs">
                    <h3><?php echo $me['user_pseudo'];?></h3>
                    <span><?php echo $me['user_description'];?></span>
                </div>
            </div><!--user-profile end-->
            <ul class="user-fw-status">
                <li>
                    <h4>Image<?php 
                    if ($user_images)
                        echo(plural(count($user_images)));
                    ?>
                    </h4>
                    <span>
                        <?php
                        if ($user_images)
                            echo (count($user_images));
                        else
                            echo "0";
                        ?>
                    </span>
                </li>
                <li>
                    <h4>Commentaire<?php echo(plural(count($comments))); ?></h4>
                    <span><?php echo (count($comments)); ?></span>
                </li>
                <li>
                    <a href="profil.php" title="">Mon profil</a>
                </li>
            </ul>
        </div><!--user-data end-->
    </div>
</div>