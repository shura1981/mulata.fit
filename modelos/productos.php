<?php  
 
class Productos
{
    // Declaración de una propiedad
    public $message = 'un valor predeterminado';
//    public $query="SELECT codigo,ruta, orden,producto, imageswebp, tablasjpg, images, intro, thumbnails, descuento, promo, bestsale, valor, category, description
//     FROM tb_productos_megaplexstars WHERE  activo=1 ORDER BY orden";
    // Declaración de un método
    public function mostrarVar() {
        echo $this->message;
    }

 public function ProductosDisponibles()
{ 
   
    require 'connection/connection.php'; 

    try{
        $query="SELECT codigo,ruta, orden,producto, imageswebp, tablasjpg, images, intro, thumbnails, descuento, promo, bestsale, valor, category, description
        FROM tb_productos_megaplexstars WHERE  activo=1 ORDER BY orden";   
        $select=$mysqli->query($query);
        $rows= array();
        while($row = $select->fetch_assoc())
        {
        $row['tablasjpg']=json_decode($row['tablasjpg']);
        $row['images']=json_decode($row['images']);
        $row['imageswebp']=json_decode($row['imageswebp']);
        array_push($rows,$row);
        }
        $result = $rows;
        }catch(Exception $e){
        $result = array('status' => 'false', 'message' => 'Ocurrió un error: '.$e->getMessage());
        }
        
        
        // header("Content-type: application/json; charset=utf-8");
       return json_encode($result, JSON_NUMERIC_CHECK);
}


}

