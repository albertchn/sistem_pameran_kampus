<?php

include "cms/connection.php";
include "function.php";

if (isset($_POST['draft'])) {
    $status = 'draft';
    $tenggat_kurasi = '';
} else {
    $status = 'submitted';
    $today = date('Y-m-d');
    $tenggat_kurasi = date('Y-m-d', strtotime($today . '+ 7 days'));
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
    $sql = " insert into tb_karya
         (id_user,judul_karya, foto_kaya, deskripsi, pencipta, tenggat_kurasi ,status)
         values 
         ('$id_user','$judul_karya','$foto_karya','$deskripsi', '$pencipta','$tenggat_kurasi', '$status')
      ";

    if (mysqli_query($conn, $sql))
        header("Location:pengajuan_karya.php");
}
