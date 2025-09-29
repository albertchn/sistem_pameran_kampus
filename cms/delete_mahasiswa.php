<?php
include "connection.php";

$email = $_GET['email'];

$sSQL = " delete from tb_users where email='$email'";
if (mysqli_query($conn, $sSQL))
    header("location:mahasiswa.php");
