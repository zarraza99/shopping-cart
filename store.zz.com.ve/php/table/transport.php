<?php 
   
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "../API/query.php";

    $table = "transport";
    $dato = array('description','id','price');
   



    $query=new query(); 
    $result = $query->select($dato, $table);

    echo json_encode($result);

?>