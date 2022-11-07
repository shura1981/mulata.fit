<?php 
require_once 'core.php';
require_once './controladores/vistasControlador.php';
$vista=new  vistasControlador();
$vista->obtener_plantilla();

?>