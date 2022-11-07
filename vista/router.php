<?php 
require_once "./controladores/vistasControlador.php";
$vc= new vistasControlador();
$resp= $vc->obtener_vistas_controlador();
if($resp=="home") include "./vista/home.php";
else if($resp=="404") include "./vista/404.php";
else if($resp=="products") include "./vista/products.php";
else if($resp=="about") include "./vista/about.php";
else if($resp=="services") include "./vista/services.php";
else if($resp=="pricing") include "./vista/pricing.php";
else if($resp=="details") include "./vista/details.php";
else if($resp=="staff") include "./vista/staff.php";
else if($resp=="demo-gym-staff-detail") include "./vistademo-gym-staff-detail.php";
else include $resp;








