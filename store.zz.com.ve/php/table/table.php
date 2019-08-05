<?php
        session_start();
        include "../php/API/query.php";
     foreach($_SESSION['buy'] as $indice => $valor)
     {
        $sum += $_SESSION['buy'][$indice]['total'];
        echo '<tr>';
            echo '<td style="text-align:center; border: 1px solid; width:5%; ">'.$_SESSION['buy'][$indice]['id'].'</td>';
            echo '<td style="text-align:center;border: 1px solid; width:20%; ">'.$_SESSION['buy'][$indice]['name'].'</td>';
            echo '<td style="text-align:center; border: 1px solid; width:20%;">'.$_SESSION['buy'][$indice]['price'].'</td>';
            echo '<td style="text-align:center; border: 1px solid; width:20%; "><input onkeypress="return sonum(event)" onpaste="return false" placeholder="Quantity" type="number" min="1" style="border:none;text-align:center;width:100%" class="quantity" value="'.$_SESSION['buy'][$indice]['quantity'].'"  ></td>';
            echo '<td style="text-align:center; border: 1px solid; width:20%; ">'.number_format($_SESSION['buy'][$indice]['total'],2).'</td>';
            echo '<td class=" center vertical-center" style="text-align:center; border: 1px solid; width:15%;"><button  onclick="deleteun(this)" name="delete" class="btn btn-danger" ><i class="fa fa-trash-o" ></i></button></td>';
            echo '</tr>';
    }
?>