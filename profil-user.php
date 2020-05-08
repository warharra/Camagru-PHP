<div class="row">
    <div class="col-lg-3">
            <div class="user-data full-width">
                <div class="acc-leftbar">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <div class="user-profile">
                            <div class="user-pro-img">
                                <div class="img-pp center" style="background-image:url('<?php echo $user['user_photo']; ?>')">
                                    <img class="none" src="<?php echo $user['user_photo']; ?>" alt="">
                                </div>
                                <?php
                                if (itsMe($user['user_ID']))
                                    echo '<form id="add_pp" enctype="multipart/form-data" action="profil.php" method="post">
                                    <div class="add-dp" id="OpenImgUpload">
                                        <input type="file" id="pp" name="image">
                                        <label for="pp"><i class="fas fa-camera"></i></label>
                                        <input type="submit" name="chpp" value="chpp">
                                    </div>
                                    </form>';
                        echo '</div>
                    </div>
                </div>';

        if (!isset($_GET['id']) || $_GET['id'] == $_SESSION['id']) {
            echo '<div class="list-group"><a class="list-group-item list-group-item-action nav-item nav-link active" id="images-tab" data-toggle="tab" href="#" role="tab" aria-controls="images" aria-selected="true" onclick="showMenu(\'images\')">Mes images</a>
                <a class="list-group-item list-group-item-action nav-item nav-link" id="param-tab" data-toggle="tab" href="#" role="tab" aria-controls="parametres" aria-selected="false" onclick="showMenu(\'parametres\')"></i>Parametres</a>
                </div>';
        }
            ?>
            </div>
        </div>
    </div>
<?php include("profil-core.php"); ?>