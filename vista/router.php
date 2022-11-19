<?php 
require_once "./controladores/vistasControlador.php";
$vc= new vistasControlador();
$resp= $vc->obtener_vistas_controlador();
if($resp=="home") include "./vista/home.php";
else if($resp=="404") include "./vista/404.php";
else if($resp=="products") include "./vista/products.php";
else if($resp=="services") include "./vista/services.php";
else if($resp=="template") include "./vista/template.php";
else include $resp;