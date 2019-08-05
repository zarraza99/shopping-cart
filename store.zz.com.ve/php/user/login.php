<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "../API/query.php";

$query = new query();

$user = $_POST["user"];
$pass = $_POST["pass"];

//echo($user.' '.$pass);


if ($query->if_exist(array("user" => $user, "pass" => $pass), "user")) 
{
	
	
	session_start();
	$_SESSION = $query->select(array("*"),"user","where user = '".$user."'")[0];
	$_SESSION["menu"] = (array) $query->select(array("*"),"menu");
	$_SESSION["wallet"] = $query->select(array("wallet"),"user","where user = '".$user."'")[0]["wallet"];
	$_SESSION['addtocart'] = 0;
		
	
	echo 'ok';
} 
else
 {
	//header("Location: http://store.zz.com.ve/login.php");
	//exit;
	echo 'no';
}