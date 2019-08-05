<?php
	session_start();
	include "php/conexion.php";
	include "php/API/query.php";
	$query = new query();
if($_SESSION["SESION"][0]["LOCKEO"] == 1)
{
	header("Location: lock.php");
	die();
};
if(!isset($_SESSION["SESION"]))
{ 
	header("Location: login.php");
	die();
}
else
{
	$temp = (array) $query->select(array("*"),"user","where id = ".$_SESSION["SESION"][0]["id"])[0];
    foreach($temp as $indice => $valor)
    {
		$_SESSION["SESION"][0][$indice] = $valor;
	};
}
 ?>