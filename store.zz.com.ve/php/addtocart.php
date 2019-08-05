<?php
    session_start();
    include "API/query.php";
	$query = new query();
    $temp = $query->select(array("*"),"product","where id = '".$_POST['data']['id']."'")[0];
    $_SESSION['buy'][$_POST['data']['id']] = $temp;
    $_SESSION['buy'][$_POST['data']['id']]['quantity'] = $_POST['data']['quantity'];
    $_SESSION['buy'][$_POST['data']['id']]['total'] = $_POST['data']['total'];
    $_SESSION['addtocart'] = $_SESSION['buy'][1]['quantity'] + $_SESSION['buy'][2]['quantity'] + $_SESSION['buy'][3]['quantity'] + $_SESSION['buy'][4]['quantity'];
    echo json_encode($_SESSION['addtocart']);
?>