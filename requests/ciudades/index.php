
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=utf-8");
header("HTTP/1.1 200 OK");
// header("HTTP/1.1 500 ERROR SERVER");
$places =  json_decode(file_get_contents('data.json'),true);
echo  json_encode($places,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);