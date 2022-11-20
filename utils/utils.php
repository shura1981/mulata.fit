<?php
class Utils
{
//Poner esta función en otro archivo. Se usa en la consulta ventas trimestral.
public function nombremes($mes){
setlocale(LC_TIME, 'spanish');  
$nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
return $nombre;
} 

public function delete_directory($dirname) {
if (is_dir($dirname))
$dir_handle = opendir($dirname);
if (!$dir_handle)
return false;
while($file = readdir($dir_handle)) {
if ($file != "." && $file != "..") {
if (!is_dir($dirname."/".$file))
unlink($dirname."/".$file);
else
delete_directory($dirname.'/'.$file);
}
}
closedir($dir_handle);
rmdir($dirname);
return true;
}



public function decodePolyline($string){
$points = array();
$index = $i = 0;
$previous = array(0,0);
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

public function openCypher ($action='encrypt',$string=false)
{
$action = trim($action);
$output = false;
$myKey = 'oW%c76+jb2';
$myIV = 'A)2!u467a^';
$encrypt_method = 'AES-256-CBC';
$secret_key = hash('sha256',$myKey);
$secret_iv = substr(hash('sha256',$myIV),0,16);
if ( $action && ($action == 'encrypt' || $action == 'decrypt') && $string )
{
$string = trim(strval($string));
if ( $action == 'encrypt' )
{
$output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
};

if ( $action == 'decrypt' )
{
$output = openssl_decrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
};
};

return $output;
};

public function Encriptar($value){
$myText_encrypted = openCypher('encrypt',$value);
return $myText_encrypted;
}
public function Desencriptar($value){
$myText_decrypted = openCypher('decrypt',$value);
return $myText_decrypted;
}


}
