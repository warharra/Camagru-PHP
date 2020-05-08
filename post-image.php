    <div class="col-lg-9 col-md-8 no-pd">
        <div class="main-feed">
            <div class="posts-section">
                <div class="post-bar">
                    <div class="post_topbar">
                        <div class="usy-dt">
                            <img src="<?php echo $me['user_photo']; ?>" alt="<?php echo $me['user_pseudo']; ?>">
                            <div class="usy-name">
                                <h3>Poster une nouvelle photo</h3>
                            </div>
                        </div>
                    </div>
                    <div class="post_content">
                        <?php

                        if ($uploadfile)
                            $alt = $_FILES['image']['name'];
                        else
                            $alt = 'image description';
                        if ($iurl) {
                            if (isset($_POST['webcamuploaded'])) {
                                $ourl = $_POST['webcamuploaded'];
                                $img_src = $_SESSION['img_src'];
                                $dest = imagecreatefrompng($_SESSION['iurl']);
                                $src = imagecreatefrompng($img_src);
                                imagealphablending($dest, true);
                                imagesavealpha($dest, true);
                                $alt = "photo_perso";

                                echo '<img class="post_img" src="' . $_SESSION['iurl'] . '" alt="' . $alt . '" \>
                        </div>';

                                imagecopy($dest, $src, 0, 0, 0, 0, 95, 95);

                                imagepng($dest, $_SESSION['iurl']);
                                imagedestroy($dest);
                                imagedestroy($src);
                            } else
                                echo '<img class="post_img" src="' . $iurl . '" alt="' . $alt . '" \>';
                        } else {
                            echo '<div>
                                <div style="position:absolute;width:100%;height:100%;"><img id="filter_webcam" src="" class=""></div>
                                <video class="center" autoplay="true" id="videoElement"></video>
                                <canvas id="canvas" class="none" width="640" height="480"></canvas>
                                </div>';
                        }
                        if (!isset($_POST['webcamuploaded']))
                            echo "</div>";
                        ?>
                        <div class="post-st">
                            <ul>
                                <form enctype="multipart/form-data" id="upload" action="post.php" method="post">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <ul>
                                                    <?php
                                                    if (!$uploadfile)
                                                        echo '<input type="file" class="custom-file-input post_image" id="select-img" name="image">
                                                        <li><a href="#"><label class="" for="select-img">Selectionner une image</label></a></li>
                                                        <input type="submit" class="custom-file-input post_image" id="webcam" name="webcam" />
                                                        <li><a href="post.php" class="active"><label class="" for="webcam">Activer la webcam</label></a></li>';
                                                    else if ($_POST['webcam']) {
                                                        echo '<li><a class="post_image" href="post.php" title="">Annuler</a></li>
                                                            <li><button id="capture" onclick=test(0,0) name="webcamuploaded" value="">Prendre une photo</button></li>';
                                                    } else
                                                        echo '<li><a class="post_image" href="post.php" title="">Annuler</a></li>
                                                        <li><input type="submit" class="btn post-img active" name="poster_img" value= "Poster l\'image" title="Poster l\'image"></li>';
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </ul>
                        </div>
                    </div>
                    <!--post-bar end-->
                </div>
            </div>
            <!--main-feed end-->
        </div>