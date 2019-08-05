<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include "../API/query.php";

    
    $id_user = $_POST['id'];
    $table_purchases = "purchases";
    $dato_buy = $_POST['data'];
    $dat_id = array('ID');
    $where = 'ORDER BY ID DESC LIMIT 0,1';
    $table_detail = "details";

    $datos_price =$_POST['price'];

    $query=new query(); 
    $buy = $query->insert($dato_buy,$table_purchases);
    $buy_id=$query->select($dat_id, $table_purchases, $where);
    if(!$buy_id) return;
    echo json_encode($datos_price);


    foreach ($datos_price as $key => $value) 
    {
        $datos= array(
            'id_purchases' => $buy_id[0]['ID'],
            'id_product' => $value['id_product'],
            'quantity' => $value['quantity'],
            'only_price' => $value['only_price'],
            'total_price' => $value['total_price'],
            'id_user' => $id_user
        );
        $listdetail = $query->insert($datos,$table_detail);

    }
    echo json_encode($listdetail);

