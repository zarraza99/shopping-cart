<?php
        session_start();
    include "../php/API/query.php";
     foreach($_SESSION['buy'] as $indice => $valor)
     {
        $curr += $_SESSION['buy'][$indice]['total'];
     }
      echo($curr);
?>