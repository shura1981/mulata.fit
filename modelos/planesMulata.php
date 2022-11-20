<?php 
class Tb_planes_mulata
{
public function getPlanes($link)
{ 
    require 'connection/connection.php'; 
try{
$query="SELECT nombre, dias, valor, moneda FROM tb_planes_mulata WHERE link='$link'";   
$select=$mysqli->query($query);
$row = $select->fetch_assoc();
$result = $row;
}catch(Exception $e){
$result = array('status' => 'false', 'message' => 'Ocurrió un error: '.$e->getMessage());
}
return json_encode($result, JSON_NUMERIC_CHECK);
}
}

 


