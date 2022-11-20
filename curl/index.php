<?php

class Curl 
{

public function PostRaw($url,$data){
$payload = json_encode($data);
// Prepare new cURL resource
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($payload))
);
// Submit the POST request
$result = curl_exec($ch);
// Close cURL session handle
curl_close($ch);
return $result;
}


public function PostUrlEncode($url,$body){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
// curl_setopt($ch, CURLOPT_TIMEOUT_MS, 10000);
$result = curl_exec($ch);
$curl_errno = curl_errno($ch);
$curl_error = curl_error($ch);
curl_close ($ch);
if ($curl_errno > 0) {
$errorMessage= "cURL Error ($curl_errno): $curl_error";
throw new Exception($errorMessage);
} else  return  $result;
}

public function PutRaw($url,$data){
$payload = json_encode($data);
// Prepare new cURL resource
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($payload))
);
// Submit the POST request
$result = curl_exec($ch);
// Close cURL session handle
curl_close($ch);
return $result;
}



public function Delete($url){
$ch = curl_init();   
curl_setopt($ch, CURLOPT_URL, $url);   
curl_setopt($ch, CURLOPT_HEADER, false);   
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');   
$data = curl_exec($ch);   
curl_close($ch);   
return $data;
}




public function Get($url){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_TIMEOUT, 30);
// curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 20);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Key=AAAAl46i4OM:APA91bE3LkR4EeGs_ob9ngW48dpdrZHODpXQgMp1Ca-IlJNk-xinOlFewlNzZakT6KI6XeayiPW22fBvKpQi1pkKld9sqCBarXgM81YLhckrP3AqdF5oWMDx98LcKmMmhOsuPNz2kmL7' ));
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
$http_code = curl_getinfo($curl , CURLINFO_HTTP_CODE);
$response = curl_exec($curl);
curl_close($curl);    
return $response;
}
   
 


}

 
// $response= Curl::Get("https://nutramerican.com/api_MegaplexStar/api/webservice.php/v2/findProducts?user=ck_dbc029e06ebfe7f689b2fe4b8bd78c5a279a7b1b&pass=cs_488c93c99a9179787587f46b3bb25fdc3fc7ed0c");
// echo $response;

 