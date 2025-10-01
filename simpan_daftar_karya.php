<?php

include "cms/connection.php";
include "function.php";

if (isset($_POST['draft'])) {
    $status = 'draft';
} else {
    $status = 'submitted';
}

if (isset($_POST['judul_karya'])) {
    $judul_karya = $_POST['judul_karya'];
    $id_user = $_POST['id_user'];
    $deskripsi = $_POST['deskripsi'];
    $pencipta = $_POST['pencipta'];

    $ok = upload_karya();
    if ($ok == 1)
        $foto_karya = $_FILES["fileToUpload"]["name"];
    else
        $foto_karya = "";

    $sql = "";
    $sql = " insert into tb_karya
         (id_user,judul_karya, foto_kaya, deskripsi, pencipta, status)
         values 
         ('$id_user','$judul_karya','$foto_karya','$deskripsi', '$pencipta', '$status')
      ";

    if (mysqli_query($conn, $sql))
        header("Location:pengajuan_karya.php");
}
