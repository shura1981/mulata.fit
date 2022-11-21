<?php
//Cargamos el framework
require_once '../vendor/autoload.php';
// include "../Encrypt/encrypt.php";
require_once '../connection/connection.php';
require_once '../global/headers_slim.php';
require_once '../modelos/planesMulata.php';

$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=UTF-8');

require_once '../global/core.php';
$dominio = URL_VISTA . 'uploads/';
$upload = $PATH_UPLOAD;


$app->get('/params', function () use ($app, $dominio) {
    try {
        $paramname = $app->request()->params('name');
        $paramedad = $app->request()->params('edad');
        if ($paramname && $paramedad) {
            $response = "Holaaa " . $paramname . ", su edad es : " . $paramedad . "años" . ", dominio: " . $dominio;
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
            // $app->response()->header('Content-Type', 'text/html;charset=UTF-8'); 
// echo "<h1> Holaaa ". $paramname . ", su edad es : ". $paramedad . "años" . ", dominio: ".$dominio. "</h1>";

        } else
            echo json_encode("hola desconocido");
    } catch (Exception $exception) {
        echo json_encode("Ocurrió un error:" . $exception);
    }
});

$app->get('/pagination', function () use ($app, $mysqli) {
    try {
        $page = $app->request()->params('page');
        $limit = $app->request()->params('limit');
        if (is_null($page))
            $page = 1;
        if (is_null($limit))
            $limit = 10;

        $queryLimit = "SELECT COUNT(*) AS total FROM tb_productos_megaplexstars WHERE activo=1";
        $select = $mysqli->query($queryLimit);
        $rows = $select->fetch_assoc();
        $total = $rows["total"];

        if ($limit > $total)
            $limit = 10;
        $countPage = ceil($total / $limit);
        if ($page > $countPage)
            $page = 1;

        $totalPages = $countPage;
        $offset = ($page - 1) * $limit;
        $isNext = ($page < $totalPages) ? true : false;
        $nextPage = ($page < $totalPages) ? ++$page : $totalPages;

        $query = "SELECT codigo, orden, producto, valor,images,ruta,uso, descuento,agotado, promo, category, invima, intro, video, imgtabla, arte, title, description, ingredientes,
presentation, imageswebp, tablasjpg, html FROM tb_productos_megaplexstars WHERE activo=1 ORDER BY orden LIMIT $limit OFFSET $offset";
        $data = array();
        $select = $mysqli->query($query);
        while ($row = $select->fetch_assoc()) {
            $row['images'] = json_decode($row['images']);
            $row['tablasjpg'] = json_decode($row['tablasjpg']);
            $row['imageswebp'] = json_decode($row['imageswebp']);
            array_push($data, $row);
        }
        echo json_encode(
            array(
                "pages" => $totalPages,
                "isNext" => $isNext,
                "nextPage" => $nextPage,
                "total" => $total,
                "data" => $data
            ), JSON_NUMERIC_CHECK);
    } catch (Exception $exception) {
        echo json_encode("Ocurrió un error:" . $exception);
    }
});



//region PUT json
$app->put('/users/:id', function ($id) use ($app) {
    //Request recoge variables de las peticiones http
    $request = $app->request;
    $body = $request->getBody();
    $prueba = json_decode($body);
    try {
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
    } catch (Exception $e) {
        $app->response()->header('X-Status-Reason', $e->getMessage());
        $app->response()->status(500);
        $result = array("status" => "false", "message" => "Ocurrió un error." . $e->getMessage());
    }
    echo json_encode($result);
});

//Cambiar constraseña
$app->put('/changepass', function () use ($app) {
    try {
        $paramCorreo = $app->request()->params('correo');
        $paramClave = $app->request()->params('clave');
        $key = Encriptar($paramClave);
        $update = getConnection()->query("UPDATE tb_blue_u SET clave='$key' WHERE correo='$paramCorreo';");
        if ($update) {
            $app->response()->status(200);
            $result = array("mensaje" => "Actualizado.");
        } else {
            $app->response()->status(404);
            $result = array("mensaje" => "no se pudo actualizar");
        }
    } catch (Exception $e) {
        $app->response()->status(500);
        $result = array("status" => "false", "message" => "Ocurrió un error: " . $e->getMessage());
    }
    echo json_encode($result);
});
//validar si el correo existe
$app->get('/lipoblue/validarcorreo/:correo', function ($correo) use ($app) {
    try {
        $select = getConnection()->query("select * from tb_blue_u WHERE correo='$correo' ;");
        $dieta = $select->fetchAll(PDO::FETCH_OBJ);
        if (count($dieta) > 0) {
            $app->response()->status(200);
            $result = $dieta;
        } else {
            $app->response()->status(404);
            $result = array("mensaje" => "no encontrado.");
        }
    } catch (Exception $e) {
        $app->response()->status(500);
        $result = array("status" => "false", "message" => "Ocurrió un error: " . $e->getMessage());
    }
    echo json_encode($result);
});
//endregion 

//region ejemplo Post json con array
$app->post('/lista', function () use ($app) {
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
    $data = json_decode($req->getBody(), true);
    $object = null;
    for ($i = 0; $i < count($data); $i++) {
        $object = $data[$i]['file'];
    }
    echo json_encode($object);
});
//endregion 

//Upload json with text base64 and convert to image and save in file.
$app->post('/base64', function () use ($app) {
    try {
        $req = $app->request();
        $json = json_decode($req->getBody());
        $file = $json->file;
        $image_base64 = $file->image;
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/lipoblue/services/uploads/';
        define('UPLOAD_DIR', $dir);
        $data = base64_decode($image_base64);
        $file = UPLOAD_DIR . uniqid() . '.png';
        $success = file_put_contents($file, $data);
        if ($success) {
            $app->response()->status(201);
            $result = array("status" => "true", "message" => "Archivo guardado correctamente.", "file" => $file);
        } else {
            $app->response()->status(400);
            $result = array("status" => "false", "message" => "No se guardó el archivo");
        }
    } catch (Exception $e) {
        $app->response()->header('X-Status-Reason', $e->getMessage());
        $app->response()->status(500);
        $result = array("status" => "false", "message" => $dir . " Ocurrió un error." . $e->getMessage());
    }
    echo json_encode($result);
});

//POST para INSERTAR, recibe un json raw
$app->post('/users', function () use ($app) {
    //Request recoge variables de las peticiones http
    $request = $app->request;
    $body = $request->getBody();
    $prueba = json_decode($body);
    try {
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
    } catch (Exception $e) {
        $app->response()->header('X-Status-Reason', $e->getMessage());
        $app->response()->status(500);
        $result = array("status" => "false", "message" => "Ocurrió un error." . $e->getMessage());
    }
    echo json_encode($result);
});

//Insertar un usuario
$app->post('/lipoblue', function () use ($app) {
    //Request recoge variables de las peticiones http
    $request = $app->request;
    $body = $request->getBody();
    $value = json_decode($body);
    $query = getConnection()->query("SELECT correo FROM tb_blue_u WHERE correo='$value->correo'");
    $tb_bue_u = $query->fetchAll(PDO::FETCH_OBJ);
    $total = count($tb_bue_u);
    if ($total > 0) {
        $app->response()->status(200);
        $result = array("status" => "true", "message" => "El correo ya está registrado.");
    } else {
        try {
            $encript_key = Encriptar($value->clave);
            $insert = getConnection()->query("INSERT INTO tb_blue_u SET correo = '$value->correo', clave = '$encript_key'");
            if ($insert) {
                $app->response()->status(201);
                $result = array("status" => "true", "message" => "Usuario creado correctamente");
            } else {
                $app->response()->status(400);
                $result = array("status" => "false", "message" => "Usuario NO creado");
            }
        } catch (Exception $e) {
            $app->response()->header('X-Status-Reason', $e->getMessage());
            $app->response()->status(500);
            $result = array("status" => "false", "message" => "Ocurrió un error." . $e->getMessage());
        }
    }
    echo json_encode($result);
});


//region PUT x-www-form-urlencoded
$app->put('/form/:id', function ($id) use ($app) {
    $request = $app->request;
    try {
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
    } catch (Exception $e) {
        $app->response()->header('X-Status-Reason', $e->getMessage());
        $app->response()->status(500);
        $result = array("status" => "false", "message" => "Ocurrió un error." . $e->getMessage());
    }
    echo json_encode($result);
});
//endregion 
//region Post desde x-www-form-urlencoded
$app->post('/form', function () use ($app) {
    try {
        $request = $app->request;
        $sql = "INSERT INTO tb_blue_u SET
correo = '{$request->params("correo")}',
clave = '{$request->params("clave")}'";
        $insert = getConnection()->query($sql);
        if ($insert) {
            $app->response()->status(201);
            $result = array("status" => "true", "message" => "Insertado correctamente");
        } else {
            $app->response()->status(400);
            $result = array("status" => "false", "message" => "No insertado");
        }
    } catch (Exception $e) {
        $app->response()->header('X-Status-Reason', $e->getMessage());
        $app->response()->status(500);
        $result = array("status" => "false", "message" => "Ocurrió un error." . $e->getMessage());
    }
    echo json_encode($result);
});
//endregion
//region DELETE json
$app->delete('/users/:id', function ($id) use ($app) {
    $request = $app->request;
    try {
        $sql = "DELETE FROM tb_prueba WHERE id=$id";
        $delete = getConnection()->query($sql);
        if ($delete) {
            $app->response()->status(200);
            $result = array("status" => "true", "message" => "Usuario eliminado correctamente");
        } else {
            $app->response()->status(400);
            $result = array("status" => "false", "message" => "Usuario NO eliminado");
        }
    } catch (Exception $e) {
        $app->response()->header('X-Status-Reason', $e->getMessage());
        $app->response()->status(500);
        $result = array("status" => "false", "message" => "Ocurrió un error." . $e->getMessage());
    }
    echo json_encode($result);
});
//endregion
//region form-data, subir archivos al servidor
$app->post('/upload-file', function () use ($app, $dominio) {
    $request = $app->request();
    $name = $request->post('name');
    $lastname = $request->post('lastname');
    $id_vendedor = $request->post('id');
    $ruta = array();
    $hoy = date("Y-m-d");
    $path = $_SERVER['DOCUMENT_ROOT'] . '/mulata.fit/uploads/' . $hoy . '/' . $id_vendedor . '/';
    $tempPath = $dominio . $hoy . '/' . $id_vendedor . '/';
    //Check if the directory already exists.
    if (!is_dir($path)) {
        //Directory does not exist, so lets create it.
        mkdir($path, 0777, true);
    }
    if (isset($_FILES['file'])) {
        $countfiles = count($_FILES['file']['name']);
        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {
            $originalName = $_FILES['file']['name'][$i];
            $ext = '.' . pathinfo($originalName, PATHINFO_EXTENSION);
            $generatedName = md5($_FILES['file']['tmp_name'][$i]) . $ext;
            $filePath = $path . $generatedName;
            array_push($ruta, $tempPath . $generatedName);
            if (!is_writable($path)) {
                echo json_encode(
                    array(
                        'status' => false,
                        'msg' => 'Destination directory not writable.'
                    )
                );
                exit;
            }
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $filePath);
        }
        echo json_encode(
            array(
                'status' => true,
                'name' => $name,
                'lastname' => $lastname,
                'ruta' => $ruta
            )
        );

    } else {
        echo json_encode(array('status' => false, 'msg' => 'No file uploaded.'));
    }
});
//endregion

$app->post('/registrocomprobante', function () use ($app, $dominio, $upload) {
    $request = $app->request();
    $nombre = $request->post('nombre');
    $correo = $request->post('correo');
    $celular = $request->post('celular');
    $dias = $request->post('dias');
    $ruta = array();
    $hoy = date("Y-m-d");
    $path = $upload . $hoy . '/' . $celular . '/';
    $tempPath = $dominio . $hoy . '/' . $celular . '/';
    //Check if the directory already exists.
    if (!is_dir($path)) {
        //Directory does not exist, so lets create it.
        mkdir($path, 0777, true);
    }
    if (isset($_FILES['file'])) {
        $countfiles = count($_FILES['file']['name']);
        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {
            $originalName = $_FILES['file']['name'][$i];
            $ext = '.' . pathinfo($originalName, PATHINFO_EXTENSION);
            $generatedName = md5($_FILES['file']['tmp_name'][$i]) . $ext;
            $filePath = $path . $generatedName;
            array_push($ruta, $tempPath . $generatedName);
            if (!is_writable($path)) {
                echo json_encode(
                    array(
                        'status' => false,
                        'msg' => 'Destination directory not writable.'
                    )
                );
                exit;
            }
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $filePath);
        }
        //add db ' + 30 days'
        $plus = $hoy . ' + ' . $dias . ' days';
        $final = date('Y-m-d', strtotime($plus));
        $planes = new Tb_planes_mulata($hoy, $final, $ruta, $celular);
        $res = Tb_planes_mulata::Pay($planes);
        if ($res['status'] == true) {
            $app->response()->status(201);

        } else {
            $app->response()->status(401);
        }
        // $result= array(
//     'status'        => true,
//     'nombre'          =>$nombre,
//     'correo'      =>$correo,
//     'celular'       =>$celular,
//     'ruta'          =>$ruta
// );

        echo json_encode($res, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    } else {
        $app->response()->status(500);
        echo json_encode(array('status' => false, 'msg' => 'No file uploaded.'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }
});




//Inicia el Api
$app->run();