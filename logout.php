<?php  

if(!isset($_SESSION['admin_name'])){
    header("location:login.php");
}


include "config.php";
session_start();
session_unset();
session_destroy();
header("location:login.php");

?>