<?php 
   
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "../API/query.php";

    $table = "transport";
    $where='WHERE id=  "'. $_POST['dato'] . '" ';
    $datos = array('price');
   



    $query=new query(); 
    $result = $query->select($datos, $table,$where);

    echo json_encode($result);

?>