<?php
// $mysqli = new mysqli("localhost","crisenri","].wKbv44W4LW8b","crisenri_intranet"); 
$mysqli = new mysqli("localhost","root","","crisenri_intranet"); 
$mysqli->set_charset("utf8mb4");
if(mysqli_connect_errno()){
echo 'Conexión Fallida : ', mysqli_connect_error();
exit();
} 
