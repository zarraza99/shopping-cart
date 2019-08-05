<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include "../API/query.php";

    
    $table = "category";
    $dato = $_POST['data'];
    
    $query=new query(); 
    $classify = $query->insert($dato,$table);

    if(!$classify) return;

    echo('si');
