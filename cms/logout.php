<?php
   session_start();
   $_SESSION["email"]="";
   $_SESSION['isLoggedin']=0;

   header("location:login.php");

?>