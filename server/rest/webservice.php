<?php
//Cargamos el framework
require_once '../../vendor/autoload.php';
// include "../Encrypt/encrypt.php";
require '../connection/connection.php';
// require_once 'curl/firebase.php';
set_time_limit(0);
ini_set('allow_url_fopen', 1);
ini_set('upload_max_filesize', '500M');
ini_set('post_max_size', '500M');
ini_set('max_input_time', 4000); // Play with the values
ini_set('max_execution_time', 4000); // Play with the values
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
date_default_timezone_set('America/Bogota');
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
die();
}
//$dominio="https://mulata.fit/uploads/";
$dominio="http://localhost/mulata.fit/uploads/";
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=UTF-8'); 
//region get json


$app->get('/params', function ()  use($app,$dominio){
try{
$paramname = $app->request()->params('name');
$paramedad = $app->request()->params('edad');
if($paramname && $paramedad){
echo json_encode("Holaaa ". $paramname . ", su edad es : ". $paramedad . "años" . ", dominio: ".$dominio);
} else echo json_encode("hola desconocido");
}catch(Exception $exception){
echo json_encode("Ocurrió un error:" . $exception);
}
});

//region PUT json
$app->put('/users/:id', function ($id) use($app) {
//Request recoge variables de las peticiones http
$request = $app->request;
$body = $request->getBody();
$prueba= json_decode($body); 
try{
$sql = "UPDATE tb_prueba SET
correo = '$prueba->correo',
nombres = '$prueba->nombres',
edad = $prueba->edad,
celular = '$prueba->celular'
WHERE id=$id";
$update = getConnection()->query($sql);
if ($update) {
$app->response()->status(200);
$result = array("status" => "true", "message" => "Usuario modificado correctamente");
} else {
$app->response()->status(400);
$result = array("status" => "false", "message" => "Usuario NO modificado");
}
}catch(Exception $e){
$app->response()->header('X-Status-Reason', $e->getMessage());
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
}
echo json_encode($result);
});

//Cambiar constraseña
$app->put('/changepass', function () use($app) {
try{
$paramCorreo = $app->request()->params('correo');   
$paramClave = $app->request()->params('clave');  
$key= Encriptar($paramClave);
$update = getConnection()->query("UPDATE tb_blue_u SET clave='$key' WHERE correo='$paramCorreo';");
if($update){
$app->response()->status(200);   
$result= array("mensaje" => "Actualizado.");
}else {
$app->response()->status(404);       
$result= array("mensaje" => "no se pudo actualizar");
}
}catch(Exception $e){
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error: ".$e->getMessage());
}
echo  json_encode($result);
});
//validar si el correo existe
$app->get('/lipoblue/validarcorreo/:correo', function ($correo) use($app) {
try{
$select = getConnection()->query("select * from tb_blue_u WHERE correo='$correo' ;");
$dieta=$select->fetchAll(PDO::FETCH_OBJ);
if(count($dieta)>0){
$app->response()->status(200);   
$result = $dieta;
}else {
$app->response()->status(404);       
$result= array("mensaje"=>"no encontrado.");
}
}catch(Exception $e){
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error: ".$e->getMessage());
}
echo  json_encode($result);
});
//endregion 

//region ejemplo Post json con array
$app->post('/lista', function() use($app){
$req = $app->request();
/*
body->
{
"file":{
"name":"texto1.jpg",
"image":"sadfasdfasdfasdfasdf"
},
"data":"2018-01-01"
}
$json = json_decode($req->getBody());
$file= $json->file;
echo json_encode($file->name);
*/
$data= json_decode($req->getBody(),true);
$object=null;
for($i=0;$i<count($data);$i++) 
{ 
$object = $data[$i]['file']; 
}
echo json_encode($object);
});
//endregion 

//Upload json with text base64 and convert to image and save in file.
$app->post('/base64', function() use($app){
try{
$req = $app->request();
$json = json_decode($req->getBody());
$file= $json->file;
$image_base64 = $file->image;
$dir= $_SERVER['DOCUMENT_ROOT'].'/lipoblue/services/uploads/';
define('UPLOAD_DIR',$dir);
$data = base64_decode($image_base64);
$file = UPLOAD_DIR . uniqid() . '.png';
$success = file_put_contents($file, $data);
if($success){
$app->response()->status(201);
$result = array("status" => "true", "message" => "Archivo guardado correctamente.", "file"=>$file);
}else{
$app->response()->status(400);
$result = array("status" => "false", "message" => "No se guardó el archivo");
}
}catch(Exception $e){
$app->response()->header('X-Status-Reason', $e->getMessage());
$app->response()->status(500);
$result = array("status" => "false", "message" =>$dir. " Ocurrió un error.".$e->getMessage());
}
echo json_encode($result);
});

//POST para INSERTAR, recibe un json raw
$app->post('/users', function () use($app) {
//Request recoge variables de las peticiones http
$request = $app->request;
$body = $request->getBody();
$prueba= json_decode($body); 
try{
$insert = getConnection()->query("INSERT INTO tb_pruebas SET
correo = '$prueba->correo',
nombres = '$prueba->nombres',
edad = $prueba->edad,
celular = '$prueba->celular'");
if ($insert) {
$app->response()->status(201);
$result = array("status" => "true", "message" => "Usuario creado correctamente");
} else {
$app->response()->status(400);
$result = array("status" => "false", "message" => "Usuario NO creado");
}
}catch(Exception $e){
$app->response()->header('X-Status-Reason', $e->getMessage());
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
}
echo json_encode($result);
});

//Insertar un usuario
$app->post('/lipoblue', function () use($app) {
//Request recoge variables de las peticiones http
$request = $app->request;
$body = $request->getBody();
$value= json_decode($body); 
$query= getConnection()->query("SELECT correo FROM tb_blue_u WHERE correo='$value->correo'");
$tb_bue_u=$query->fetchAll(PDO::FETCH_OBJ);
$total=count($tb_bue_u);
if($total>0)
{
$app->response()->status(200);
$result = array("status" => "true", "message" => "El correo ya está registrado.");
}
else 
{
try{
$encript_key= Encriptar($value->clave);    
$insert = getConnection()->query("INSERT INTO tb_blue_u SET correo = '$value->correo', clave = '$encript_key'");
if ($insert) {
$app->response()->status(201);
$result = array("status" => "true", "message" => "Usuario creado correctamente");
} else {
$app->response()->status(400);
$result = array("status" => "false", "message" => "Usuario NO creado");
}
}catch(Exception $e){
$app->response()->header('X-Status-Reason', $e->getMessage());
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
}    
}
echo json_encode($result);
});
//POST ordenes de compra
// $app->post('/ordenes_compra', function () use($app,$mysqliMpx90) {
// //Request recoge variables de las peticiones http
// $request = $app->request;
// $body = $request->getBody();
// $orden= json_decode($body); 

// try{
// $insert = $mysqliMpx90->query("INSERT INTO tb_ordenes_compra SET
// referenceCode = '$orden->referenceCode',
// description = '$orden->description',
// amount = '$orden->amount',
// tax = '$orden->tax',
// taxReturnBase='$orden->taxReturnBase',
// signature='$orden->signature',
// currency='$orden->currency',
// buyerFullName='$orden->buyerFullName',
// buyerEmail='$orden->buyerEmail',
// fecha='$orden->fecha'
// ");
// if ($insert) {
// $app->response()->status(201);
// $result = array("status" => "true", "message" => "Orden de compra creada");
// } else {
// $app->response()->status(400);
// $result = array("status" => "false", "message" => "No se pudo crear la orden.");
// }

// }catch(Exception $e){
// $app->response()->header('X-Status-Reason', $e->getMessage());
// $app->response()->status(500);
// $result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
// }
// echo json_encode($result);
// });
// $app->post('/registre', function () use($app,$mysqliMpx90) {
// //Request recoge variables de las peticiones http
// $request = $app->request;
// $body = $request->getBody();
// $prueba= json_decode($body); 

// try{
// //Validar si el correo esta disponible
// $select  =  $mysqliMpx90->query("select * from tb_usuarios where correo= '$prueba->e_mail'");
// $rows= array();
// while($row = $select->fetch_assoc())
// {
// array_push($rows,$row);
// }




// if(count($rows)>0){
// $app->response()->status(404);       
// $result= array("mensaje" => "El correo ya se encuentra registrado.");
// }else {


// $encript_key= Encriptar($prueba->pass);  
// $insert = $mysqliMpx90->query("INSERT INTO tb_usuarios SET
// usuario = '$prueba->user',
// correo = '$prueba->e_mail',
// pass = '$encript_key',
// celular = '$prueba->celular',
// foto='$prueba->image'
// ");
// if ($insert) {
// $app->response()->status(201);
// $result = array("status" => "true", "message" => "Usuario creado correctamente");
// } else {
// $app->response()->status(400);
// $result = array("status" => "false", "message" => "Usuario NO creado");
// }
// }
// }catch(Exception $e){
// $app->response()->header('X-Status-Reason', $e->getMessage());
// $app->response()->status(500);
// $result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
// }
// echo json_encode($result);
// });
//endregion
//region PUT x-www-form-urlencoded
$app->put('/form/:id', function ($id) use($app) {
$request = $app->request;
try{
$sql = "UPDATE tb_prueba SET
correo = '{$request->params("correo")}',
nombres = '{$request->params("nombres")}',
edad = '{$request->params("edad")}',
celular = '{$request->params("celular")}'
WHERE id=$id";
$update = getConnection()->query($sql);
if ($update) {
$app->response()->status(200);
$result = array("status" => "true", "message" => "Usuario modificado correctamente");
} else {
$app->response()->status(400);
$result = array("status" => "false", "message" => "Usuario NO modificado");
}
}catch(Exception $e){
$app->response()->header('X-Status-Reason', $e->getMessage());
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
}
echo json_encode($result);
});
//endregion 
//region Post desde x-www-form-urlencoded
$app->post('/form', function () use($app) {
try{
$request = $app->request;
$sql = "INSERT INTO tb_blue_u SET
correo = '{$request->params("correo")}',
clave = '{$request->params("clave")}'";
$insert= getConnection()->query($sql);
if ($insert) {
$app->response()->status(201);
$result = array("status" => "true", "message" => "Insertado correctamente");
} else {
$app->response()->status(400);
$result = array("status" => "false", "message" => "No insertado");
}
}catch(Exception $e){
$app->response()->header('X-Status-Reason', $e->getMessage());
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
}
echo json_encode($result);
});

$app->post('/payU', function () use($app) {
try{
$request = $app->request;
$merchantId = $request->params("merchantId");
$accountId = $request->params("accountId");
$description = $request->params("description");

$referenceCode = $request->params("referenceCode");
$amount = $request->params("amount");
$tax = $request->params("tax");

$taxReturnBase = $request->params("taxReturnBase");
$currency = $request->params("currency");
$signature = $request->params("signature");

$test = $request->params("test");
$buyerEmail = $request->params("buyerEmail");
$responseUrl = $request->params("responseUrl");

$confirmationUrl = $request->params("confirmationUrl");

$url = 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu';
$data = array('merchantId' => $merchantId, 'accountId' => $accountId,  'description'=>$description, 'referenceCode'=>$referenceCode, 'amount'=>$amount,
'tax'=>$tax, 'taxReturnBase'=>$taxReturnBase, 'currency'=>$currency,'signature'=>$signature,'test'=>$test, 'buyerEmail'=>$buyerEmail, 'responseUrl'=>$responseUrl,
'confirmationUrl'=>$confirmationUrl );

// use key 'http' even if you send the request to https://...
$options = array(
'http' => array(
'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
'method'  => 'POST',
'content' => http_build_query($data)
)
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { 
$app->response()->header('X-Status-Reason', $result);
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error.".$result);
$result= json_encode($result);
}
else  $app->response()->status(200);
}catch(Exception $e){
$app->response()->header('X-Status-Reason', $e->getMessage());
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
$result= json_encode($result);
}
echo $result;
});

//endregion
//region DELETE json
$app->delete('/users/:id', function ($id) use($app) {
$request = $app->request;
try{
$sql = "DELETE FROM tb_prueba WHERE id=$id";
$delete = getConnection()->query($sql);
if ($delete) {
$app->response()->status(200);
$result = array("status" => "true", "message" => "Usuario eliminado correctamente");
} else {
$app->response()->status(400);
$result = array("status" => "false", "message" => "Usuario NO eliminado");
}
}catch(Exception $e){
$app->response()->header('X-Status-Reason', $e->getMessage());
$app->response()->status(500);
$result = array("status" => "false", "message" => "Ocurrió un error.".$e->getMessage());
}
echo json_encode($result);
});
//endregion
//region form-data, subir archivos al servidor
$app->post('/upload-file',function() use($app,$dominio){
$request = $app->request();
$name = $request->post('name');
$lastname = $request->post('lastname');
$id_vendedor = $request->post('id');
$ruta=array();
$hoy = date("Y-m-d");  
$path=$_SERVER['DOCUMENT_ROOT'].'/mulata.fit/uploads/'.$hoy.'/'.$id_vendedor.'/';
$tempPath= $dominio.$hoy.'/'.$id_vendedor.'/';
//Check if the directory already exists.
if(!is_dir($path)){
//Directory does not exist, so lets create it.
mkdir($path, 0777, true);
}
if (isset($_FILES['file'])) {
$countfiles = count($_FILES['file']['name']);
// Looping all files
for($i=0;$i<$countfiles;$i++){
$originalName = $_FILES['file']['name'][$i];
$ext = '.'.pathinfo($originalName, PATHINFO_EXTENSION);
$generatedName = md5($_FILES['file']['tmp_name'][$i]).$ext;
$filePath = $path.$generatedName;
array_push($ruta,$tempPath.$generatedName);
if (!is_writable($path)) {
echo json_encode(array(
'status' => false,
'msg'    => 'Destination directory not writable.'
));
exit;
}
move_uploaded_file($_FILES['file']['tmp_name'][$i], $filePath);
}
echo json_encode(array(
'status'        => true,
'name'          =>$name,
'lastname'      =>$lastname,
'ruta'          =>$ruta
));

}
else { echo json_encode(array('status' => false, 'msg' => 'No file uploaded.'));}
});
//endregion
 
$app->post('/registrocomprobante',function() use($app,$dominio){
$request = $app->request();
$name = $request->post('name');
$lastname = $request->post('lastname');
$id_vendedor = $request->post('id');
$ruta=array();
$hoy = date("Y-m-d");  
$path=$_SERVER['DOCUMENT_ROOT'].'/mulata.fit/uploads/'.$hoy.'/'.$id_vendedor.'/';
$tempPath= $dominio.$hoy.'/'.$id_vendedor.'/';
//Check if the directory already exists.
if(!is_dir($path)){
//Directory does not exist, so lets create it.
mkdir($path, 0777, true);
}
if (isset($_FILES['file'])) {
$countfiles = count($_FILES['file']['name']);
// Looping all files
for($i=0;$i<$countfiles;$i++){
$originalName = $_FILES['file']['name'][$i];
$ext = '.'.pathinfo($originalName, PATHINFO_EXTENSION);
$generatedName = md5($_FILES['file']['tmp_name'][$i]).$ext;
$filePath = $path.$generatedName;
array_push($ruta,$tempPath.$generatedName);
if (!is_writable($path)) {
echo json_encode(array(
'status' => false,
'msg'    => 'Destination directory not writable.'
));
exit;
}
move_uploaded_file($_FILES['file']['tmp_name'][$i], $filePath);
}
echo json_encode(array(
'status'        => true,
'name'          =>$name,
'lastname'      =>$lastname,
'ruta'          =>$ruta
));

}
else { echo json_encode(array('status' => false, 'msg' => 'No file uploaded.'));}
});




//Inicia el Api
$app->run();




//Notas
//1. subir archivos al servidor buscar-> uploadVisitas
//$_POST['observaciones'] y $app->request()->post('observaciones') es lo mismo
// htmlspecialchars() elimina los caracteres especiales que generan error en las consultas update e insert de mysql

//2. query fecha, solo mes y año. En mysql.
// SELECT DATE_FORMAT(fecha, '%Y %m') AS AÑO_MES FROM `tb_maestro_planilla` WHERE `mensajero`->'$.id'=52698507
// GROUP BY AÑO_MES
// clientesxvendedorall clientes por vendedor