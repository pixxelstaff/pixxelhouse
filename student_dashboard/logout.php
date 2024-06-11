<?php
session_start();
$log=$_GET['log'];
if($log="logout"){
    session_destroy();
header("Location:index.php");
}
?>