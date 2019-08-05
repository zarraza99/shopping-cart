<?php 
session_start();
session_destroy();
$_SESSION = '';
//setcookie("BASE", "", time()-3600,"/base");
header("Location: ../../login.php");
?>
