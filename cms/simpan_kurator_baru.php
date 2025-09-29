<?php

include "connection.php";
if ($_POST['nama']) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $role = 'kurator';

  // encrypt into MD5 
  $password = md5(trim($_POST['password']));

  $sql = "";
  $sql = " insert into tb_users 
         (nama, email,password,role)
         values 
         ('$nama', '$email', '$password', '$role')
      ";

  if (mysqli_query($conn, $sql))
    header("Location:kurator.php");
}
