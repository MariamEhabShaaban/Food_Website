<?php
require '../config/constants.php';
if(!isset($_SESSION['username'])){
    $_SESSION['no-login-ms']="<div class='error text-center'>Please login to access admin panel</div>";

header("location:".SITEURL."admin/login.php");
}

?>