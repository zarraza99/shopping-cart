<?php
    session_start();
    include "../php/API/query.php";
    unset($_SESSION['buy'][$_POST['data']['id']]);
    $_SESSION['addtocart']= $_SESSION['addtocart'] - $_POST['data']['quantity'];
    echo json_encode($_SESSION['addtocart']);
    