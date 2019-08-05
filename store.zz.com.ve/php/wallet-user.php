<?php
    session_start();
    

    if(!$_SESSION['buy'])
    {
        echo json_encode('void');
    }
    else
    {
        if($_SESSION['wallet'] >= $_POST['data']['buyed'])
        {
            $_SESSION['wallet'] = $_SESSION['wallet'] - $_POST['data']['buyed'];
            $_SESSION['addtocart'] =  0;
            unset($_SESSION['buy']);
            echo json_encode(number_format($_SESSION['wallet'],2));
        }
        else
        {
            echo json_encode('no');
        }
    }
    
?>