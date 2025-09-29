<?php

include "connection.php";
if ($_POST['id_karya']) {
  $id_karya = $_POST['id_karya'];
  $tanggal = $_POST['tanggal'];
  $lokasi = $_POST['lokasi'];
  $ruang_display = $_POST['ruang_display'];
  $status = 'scheduled';

  $sql = "";
  $sql = " insert into tb_pameran 
         (id_karya, tanggal,lokasi,ruang_display,status)
         values 
         ('$id_karya', '$tanggal','$lokasi', '$ruang_display','$status')
      ";

  if (mysqli_query($conn, $sql))
    header("Location:pameran.php");
}
