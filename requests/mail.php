<?php


set_time_limit(0);
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
die();
}


  $name    = (isset($_POST['name'])) ? $_POST['name'] : '';
  $email   = (isset($_POST['email'])) ? $_POST['email'] : '';
  $message = (isset($_POST['message'])) ? $_POST['message'] : '';
  $subject = (isset($_POST['subject'])) ? $_POST['subject'] : '';

  header('Content-Type: application/json');

  if ($name === '') {
    header("HTTP/1.0 401 Not Found");
    $response =  json_encode(array(
      'message' => 'Name cannot be empty',
      'code' => 0
    ));
    die($response);
  }
  if ($email === '') {
    header("HTTP/1.0 401 Not Found");
    $response =  json_encode(array(
      'message' => 'Email cannot be empty',
      'code' => 0
    ));
    die($response);
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("HTTP/1.0 401 Not Found");
    $response =  json_encode(array(
      'message' => 'Email format invalid.',
      'code' => 0
    ));
    die($response);
  }
  if ($subject === '') {
    header("HTTP/1.0 401 Not Found");
    $response =  json_encode(array(
      'message' => 'Subject cannot be empty',
      'code' => 0
    ));
    die($response);
  }
  if ($message === '') {
    header("HTTP/1.0 401 Not Found");
    $response =  json_encode(array(
      'message' => 'Message cannot be empty',
      'code' => 0
    ));
    die($response);
  }

  $content    = "From: $name \n Email: $email \n Message: $message";
  $recipient  = "info@nutramerican.com";

  $mailheader = array(
    'From' => $email,
    'Content-Type' => 'text/html;charset=UTF-8',
  );


   $success= @mail($recipient, $subject, $content, $mailheader);

   header("HTTP/1.1 200 OK");
  $response =  json_encode(array(
    'message' => 'Email successfully sent!',
    'code' => 1,
    'send'=>$success
  ));



  echo $response;