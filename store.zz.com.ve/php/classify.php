<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include "API/query.php";


    $table = "category";
    $dat_clas = array('classify');
    $where = 'WHERE user = "'.$_POST["data"]["user"].'" and product = "'.$_POST["data"]["product"].'" ';
    
    $query=new query(); 
    $classf_id=$query->select($dat_clas, $table, $where);
    echo json_encode($classf_id);