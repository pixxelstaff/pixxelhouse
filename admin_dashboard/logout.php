<?php
session_start();
$log=$_GET['log'];
if($log="logout"){
    unset($_SESSION['admin_login']);
header("Location:index.php");
}
?>