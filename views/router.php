<?php 
require_once "./controladores/vistasControlador.php";
$vc= new vistasControlador();
$resp= $vc->obtener_vistas_controlador();
if($resp=="home") include "home.php";
else if($resp=="404") include "404.php";
else if($resp=="products") include "products.php";
else if($resp=="services") include "services.php";
else if($resp=="template") include "template.php";
else if($resp=="test") include "public/test.html";
else if($resp=="login") include "login.php";
else if($resp=="registre") include "registre.php";
else include $resp;