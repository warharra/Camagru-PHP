<div class="col-lg-3 col-md-4 wav-left-none">
    <div class="main-left-sidebar no-margin">
        <div class="user-data full-width">
            <div class="user-profile">
                <div class="username-dt">
                    <div class="usr-pic">
                        <img src="<?php echo $me['user_photo'];?>" alt="<?php echo $me['user_pseudo'];?>">
                    </div>
                </div><!--username-dt end-->
                <div class="user-specs">
                    <h3><?php echo $me['user_pseudo'];?></h3>
                    <span><?php echo $me['user_description'];?></span>
                </div>
            </div><!--user-profile end-->
           
            <ul class="user-fw-status"><h4>Stickers</h4>
                    <li>
                        <?php
                        echo '<img  onclick="test(this, 1);display_capture_btn();" src="images/stickers/icon.png"  style="width:50px; height:50px; margin-left:30px;"  name="filtre_respons4" alt="366/16">
                        <img  onclick="test(this, 1);display_capture_btn();" src="images/stickers/icon2.jpg"   style="width:50px; height:50px; margin-left:30px;"  name="filtre_respons4" alt="366/16">
                        <img  onclick="test(this, 1);display_capture_btn();" src="images/stickers/icon3.png"   style="width:50px; height:50px; margin-left:30px;"  name="filtre_respons4" alt="366/16">
                        <img  onclick="test(this, 1);display_capture_btn();" src="images/stickers/icon4.png"   style="width:50px; height:50px; margin-left:30px;"  name="filtre_respons4" alt="366/16">
                        <img  onclick="test(this, 1);display_capture_btn();" src="images/stickers/icon11.png"   style="width:50px; height:50px; margin-left:30px;"  name="filtre_respons4" alt="366/16">                  
                        <canvas id="canvas"></canvas>';
                        ?>
                <li>
                    <a href="profil.php" title="">Mon profil</a>
                </li>
            </ul>
           
        </div><!--user-data end-->
    </div>
</div>