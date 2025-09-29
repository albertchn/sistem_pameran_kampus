<?php
include "connection.php";

if ($_POST['nama']) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];

    // encrypt into MD5 
    if (!empty($_POST['password']))
        $password = md5(trim($_POST['password']));
    else
        $password = $_POST['old_password'];

    $sql = "";
    $sql = " update tb_users set nama = '$nama', password='$password' where email='$email'";

    if (mysqli_query($conn, $sql))
        header("Location:kurator.php");
}
