<?php
function changePhoto($uploadfile, $files ) {
    if (move_uploaded_file($files['image']['tmp_name'], $uploadfile))
        $iurl = $uploadfile;
}
?>