<?php
session_start();
session_destroy();
$_SESSION["email"] = "";
$_SESSION['isLoggedin'] = 0;
$_SESSION['LoginGagal'] = 0;


header("location:login.php");
