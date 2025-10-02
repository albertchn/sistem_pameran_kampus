<?php
include "cms/connection.php";

$id_karya = $_GET['id_karya'];
$status = 'withdrawn';

$sql = mysqli_query($conn, "select * from tb_pameran where id_karya='$id_karya'");
if (mysqli_num_rows($sql) > 0) {
    mysqli_query($conn, "delete from tb_pameran where id_karya='$id_karya'");
}

$sSQL = "update tb_karya set status='$status' where id_karya='$id_karya'";
if (mysqli_query($conn, $sSQL)) {
    header("location: pengajuan_karya.php");
}
