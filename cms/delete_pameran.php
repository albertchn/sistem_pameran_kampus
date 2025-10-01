<?php
include "connection.php";

$id_pameran = $_GET['id_pameran'];

$sSQL = " delete from tb_pameran where id_pameran='$id_pameran'";
if (mysqli_query($conn, $sSQL))
    header("location:pameran.php");
