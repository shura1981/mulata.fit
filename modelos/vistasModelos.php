<?php 
class vistasModelos{
protected function obtener_vistas_modelo($vistas)
{
$rutas=["blog", "post","home","products", "services", "template"];   
if(in_array($vistas,$rutas)){
$url=   "views/".$vistas.".php";
if (is_file($url)) {
$contenido= "views/".$vistas.".php";
} else  { $contenido= "home";}
}elseif($vistas=="login"){$contenido= "login";}
else $contenido="404";
return $contenido;
}
}