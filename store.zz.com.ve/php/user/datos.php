<?php
 include "../API/query.php";
 include "../API/connection.php";
 $query = new query();
 //$_POST['id']=1;
 $wher = 'WHERE id="'. $_POST['id'].'" ';
 $table= 'user';
 $inf = $query->select(array("*"),$table,$wher);
echo json_encode($inf);
