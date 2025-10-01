<?php
include "connection.php";

if ($_POST['judul_karya']) {
    $id_pameran = $_POST['id_pameran'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $ruang_display = $_POST['ruang_display'];

    $sql = "";
    $sql = " update tb_pameran set tanggal = '$tanggal', lokasi='$lokasi', ruang_display='$ruang_display' where id_pameran='$id_pameran'";

    if (mysqli_query($conn, $sql))
        header("Location:pameran.php");
}
