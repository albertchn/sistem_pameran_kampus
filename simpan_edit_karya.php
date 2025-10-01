<?php

include "cms/connection.php";
include "function.php";

if (isset($_POST['draft'])) {
    $status = 'draft';
} else {
    $status = 'submitted';
}

if ($_POST['judul_karya']) {
    $id_karya = $_POST['id_karya'];
    $judul_karya = $_POST['judul_karya'];
    $pencipta = $_POST['pencipta'];
    $deskripsi = $_POST['deskripsi'];
    $foto_karya = $_POST['foto_lama'];

    if ($_POST['fileToUpload'] && !empty($_POST['fileToUpload'])) {
        $ok = upload_karya();
        if ($ok == 1)
            $foto_karya = $_FILES["fileToUpload"]["name"];
    }

    $sql = "";
    $sql = " update tb_karya
             set 
             judul_karya='$judul_karya',
             foto_kaya='$foto_karya',
             deskripsi='$deskripsi',
             pencipta='$pencipta',
             status='$status' 
             where id_karya='$id_karya'
            ";

    if (mysqli_query($conn, $sql))
        header("Location:pengajuan_karya.php");
}
