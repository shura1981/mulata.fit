<?php 
require_once './modelos/vistasModelos.php';
class vistasControlador extends vistasModelos{
public function obtener_plantilla()
{
 return require_once './vista/router.php';
}

public function obtener_vistas_controlador()
{
if(isset($_GET['ruta'])){
$ruta= explode("/",$_GET['ruta'])[0];
$respuesta=vistasModelos::obtener_vistas_modelo($ruta);
}else{
$respuesta="home";
}
return $respuesta;
}

}