<?php

include "cms/connection.php";
include "function.php";

if (isset($_POST['draft'])) {
    $status = 'draft';
} else {
    $status = 'submitted';
}

if (isset($_POST['skor'])) {
    $skor = $_POST['skor'];
    $catatan = $_POST['catatan'];
    $id_user = $_POST['id_user'];
    $id_karya = $_POST['id_karya'];

    $sql = "";
    $sql = " update tb_kurasi
            set
            skor='$skor',
            catatan='$catatan',
            status='$status'
            where id_user='$id_user' and id_karya='$id_karya'";

    if (mysqli_query($conn, $sql))
        header("Location:kurasi.php");
}
