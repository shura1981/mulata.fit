<?php 
class Tb_clientes
{
public function __construct($usuario, $correo, $celular ) {
$this->usuario = $usuario;
$this->correo = $correo;
$this->celular = $celular;
}
public static function get()
{ 
try{
require realpath(__DIR__.'/../').'/connection/connection.php';      
$query="SELECT * FROM tb_clientes_mulata";   
$select=$mysqli->query($query);
$rows= Array();
while($row = $select->fetch_assoc()){
array_push($rows, $row);
}
$result = $rows;
}catch(Exception $e){
$result = array('status' => 'false', 'message' => 'Ocurrió un error: '.$e->getMessage());
}
return json_encode($result, JSON_NUMERIC_CHECK);
}


public static function add(Tb_clientes $cliente)
{ 
try{
require realpath(__DIR__.'/../').'/connection/connection.php';    
$select=$mysqli->query( "SELECT * FROM tb_clientes_mulata WHERE correo='$cliente->correo'"  );
if(  $select->fetch_assoc()){
$result=Array("msg"=>"ya existe");


}else{
$result=Array("msg"=>"no existe");

}



// UPDATE tb_clientes_mulata SET celular= ,correo= ,usuario=  WHERE     
// $query="SELECT nombre, dias, valor, moneda FROM tb_planes_mulata WHERE link='$link'";   
// $select=$mysqli->query($query);
// $row = $select->fetch_assoc();
// $result = $row;
}catch(Exception $e){
$result = array('status' => 'false', 'message' => 'Ocurrió un error: '.$e->getMessage());
}
return json_encode($result, JSON_NUMERIC_CHECK);
}



 



}

$cliente= new Tb_clientes("Steven realpe", "realpelee@gmail.com", 3175346352);

$res= Tb_clientes::add($cliente);
echo $res;

 