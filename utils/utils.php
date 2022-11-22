<?php
class Utils
{
    //Poner esta función en otro archivo. Se usa en la consulta ventas trimestral.
    public static function nombremes($mes)
    {
        setlocale(LC_TIME, 'spanish');
        $nombre = strftime("%B", mktime(0, 0, 0, $mes, 1, 2000));
        return $nombre;
    }

    public static function delete_directory($dirname)
    {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    public static function decodePolyline($string)
    {
        $points = array();
        $index = $i = 0;
        $previous = array(0, 0);
        while ($i < strlen($string)) {
            $shift = $result = 0x00;
            do {
                $bit = ord(substr($string, $i++)) - 63;
                $result |= ($bit & 0x1f) << $shift;
                $shift += 5;
            } while ($bit >= 0x20);
            $diff = ($result & 1) ? ~($result >> 1) : ($result >> 1);
            $number = $previous[$index % 2] + $diff;
            $previous[$index % 2] = $number;
            $index++;
            $points[] = $number * 1 / pow(10, 5);
        }
        return array_chunk($points, 2);
    }

    public static function openCypher($action = 'encrypt', $string = false)
    {
        $action = trim($action);
        $output = false;
        $myKey = 'oW%c76+jb2';
        $myIV = 'A)2!u467a^';
        $encrypt_method = 'AES-256-CBC';
        $secret_key = hash('sha256', $myKey);
        $secret_iv = substr(hash('sha256', $myIV), 0, 16);
        if ($action && ($action == 'encrypt' || $action == 'decrypt') && $string) {
            $string = trim(strval($string));
            if ($action == 'encrypt') {
                $output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
            }
            ;

            if ($action == 'decrypt') {
                $output = openssl_decrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
            }
            ;
        }
        ;

        return $output;
    }

    public static function Encriptar($value)
    {
        $myText_encrypted = openCypher('encrypt', $value);
        return $myText_encrypted;
    }
    public static function Desencriptar($value)
    {
        $myText_decrypted = openCypher('decrypt', $value);
        return $myText_decrypted;
    }
    public static function groupArray($array, $groupkey)
    {
        if (count($array) > 0) {
            $keys = array_keys($array[0]);
            $removekey = array_search($groupkey, $keys);
            if ($removekey === false)
                return array("Clave \"$groupkey\" no existe");
            else
                unset($keys[$removekey]);
            $groupcriteria = array();
            $return = array();
            foreach ($array as $value) {
                $item = null;
                foreach ($keys as $key) {
                    $item[$key] = $value[$key];
                }
                $busca = array_search($value[$groupkey], $groupcriteria);
                if ($busca === false) {
                    $groupcriteria[] = $value[$groupkey];
                    $return[] = array($groupkey => $value[$groupkey], 'data' => array());
                    $busca = count($return) - 1;
                }
                $return[$busca]['data'][] = $item;
            }
            return $return;
        } else
            return array();
    }

    public static function getFoto($fotoBase64, $id, string $upload = '/uploads/images', string $url = "http://")
    {
        if (strlen($fotoBase64) > 0) {
            //region Comprobar si existe la carpeta.
            $hoy = date("Y-m-d");
            $path = $_SERVER['DOCUMENT_ROOT'] . $upload . $hoy . '/' . $id;
            //Check if the directory already exists.
            if (!is_dir($path)) {
                //Directory does not exist, so lets create it.
                mkdir($path, 0777, true);
            }
            $image_base64 = $fotoBase64;
            $dir = $path . '/';
            define('UPLOAD_DIR', $dir);
            $data = base64_decode($image_base64);
            $urix = uniqid() . '.jpg';
            $file = UPLOAD_DIR . $urix;
            $success = file_put_contents($file, $data);
            $temp = $url . '/uploads/images/' . $hoy . '/' . $id . '/' . $urix;
            if ($success)
                return $temp;
            else
                return '';
        }
        return '';
    }
    public static function resizeImage($filename, $newwidth, $newheight){
        list($width, $height) = getimagesize($filename);
        if($width > $height && $newheight < $height){
            $newheight = $height / ($width / $newwidth);
        } else if ($width < $height && $newwidth < $width) {
            $newwidth = $width / ($height / $newheight);   
        } else {
            $newwidth = $width;
            $newheight = $height;
        }
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return imagejpeg($thumb);
    }

    public static function webpImage($source, $quality = 100, $removeOld = false)
    {
        $dir = pathinfo($source, PATHINFO_DIRNAME);
        $name = pathinfo($source, PATHINFO_FILENAME);
        $destination = $dir . DIRECTORY_SEPARATOR . $name . '.webp';
        $info = getimagesize($source);
        $isAlpha = false;
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($isAlpha = $info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($isAlpha = $info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return $source;
        }
        if ($isAlpha) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }
        imagewebp($image, $destination, $quality);

        if ($removeOld)
            unlink($source);

        return $destination;
    }

    public static function renderImage($img, $imagenNueva, $nAncho = 300, $nAlto = 600)
    {

        // imagecreatefromstring(file_get_contents($path));
        // $imagen = 'mi_foto.jpg'; //Imagen original
        // $imagenNueva = 'mi_foto_resize.jpg'; //Nueva imagen
        //Creamos una nueva imagen a partir del fichero inicial

        $imagen = imagecreatefromjpeg($img);
        //Obtenemos el tamaño 
        $x = imagesx($imagen);
        $y = imagesy($imagen);

        //Validamos los tamaños y calculamos la relación de aspecto
        if ($x >= $y) {
            $nAncho = $nAncho;
            $nAlto = $nAncho * $y / $x;
        } else {
            $nAlto = $nAlto;
            $nAncho = $x / $y * $nAlto;
        }
        // Crear una nueva imagen, copia y cambia el tamaño de la imagen
        $img = imagecreatetruecolor($nAncho, $nAlto);
        imagecopyresampled($img, $imagen, 0, 0, 0, 0, floor($nAncho), floor($nAlto), $x, $y);

        //Creamos el archivo jpg
        imagejpeg($img, $imagenNueva);

    }


    public static function webpImage2($source, $quality = 100, $removeOld = false,  $nAncho = 300, $nAlto = 600)
    {
        $dir = pathinfo($source, PATHINFO_DIRNAME);
        $name = pathinfo($source, PATHINFO_FILENAME);
        $destination = $dir . DIRECTORY_SEPARATOR . $name . '.webp';
        $info = getimagesize($source);
        $isAlpha = false;
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($isAlpha = $info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($isAlpha = $info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return $source;
        }
        if ($isAlpha) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }

        $x = imagesx($image);
        $y = imagesy($image);

        //Validamos los tamaños y calculamos la relación de aspecto
        if ($x >= $y) {
            $nAncho = $nAncho;
            $nAlto = $nAncho * $y / $x;
        } else {
            $nAlto = $nAlto;
            $nAncho = $x / $y * $nAlto;
        }
        // Crear una nueva imagen, copia y cambia el tamaño de la imagen
        $img = imagecreatetruecolor($nAncho, $nAlto);
        imagecopyresampled($img, $image, 0, 0, 0, 0, floor($nAncho), floor($nAlto), $x, $y);

        imagewebp($image, $destination, $quality);

        if ($removeOld)
            unlink($source);

        return $destination;
    }




}



// Utils::renderImage("/opt/lampp/htdocs/mulata.fit/utils/working-hour.jpg","gridsm.jpg" );
// echo Utils::getImage("/opt/lampp/htdocs/mulata.fit/utils/working-hour.jpg");
// Utils::webpImage2("/opt/lampp/htdocs/mulata.fit/utils/working-hour.jpg" );
// echo $_SERVER['DOCUMENT_ROOT'];
