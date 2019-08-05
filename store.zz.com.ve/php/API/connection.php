<?php 

$mysqli = new mysqli("mysql.zz.com.ve", "zarraza", '$Zarraza19', "zarraza"); 

if ($mysqli->connect_error) {
   die("Connection failed: " . $mysqli->connect_error);
}
?>
