<?php
include "cms/connection.php";

$id_karya = $_GET['id_karya'];
$foto_karya = $_GET['foto_karya'];

$sSQL = " delete from tb_karya where id_karya='$id_karya'";
if (mysqli_query($conn, $sSQL)) {
    $foto_link = "images/" . trim($foto_karya);

    // remove pyshical file video
    unlink($foto_link);

    header("location: pengajuan_karya.php");
}
