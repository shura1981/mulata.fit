<?php 
class vistasModelos{
protected function obtener_vistas_modelo($vistas)
{
$rutas=["blog","contact","post","home","products","about","details", "services", "pricing", "details", "staff", "demo-gym-staff-detail"];   
if(in_array($vistas,$rutas)){
$url=   "vista/".$vistas.".php";
if (is_file($url)) {
$contenido= "vista/".$vistas.".php";
} else  { $contenido= "home";}
}elseif($vistas=="login"){$contenido= "login";}
else $contenido="404";
return $contenido;
}

}