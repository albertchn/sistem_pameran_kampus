<?php
function upload_karya()
{

    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 0;

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    return $uploadOk;
}
