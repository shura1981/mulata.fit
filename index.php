<?php 
require_once './global/core.php';
require_once './global/version.php';
require_once './controladores/vistasControlador.php';
$vista=new  vistasControlador();
$vista->obtener_plantilla();
