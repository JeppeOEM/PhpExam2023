<?php
header('Content-Type: application/json');
require_once __DIR__.'/../_.php';
try{

  // TODO : validate the user name
  // if not valid, send a message that the toast will display
  _validate_user_name();

  echo json_encode(['info'=>'User created :)']);

}catch(Exception $e){
    $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
    $message = strlen($e->getMessage()) == 0 ? 'error - '.$e->getLine() : $e->getMessage();
    http_response_code($status_code);
    echo json_encode(['info'=>$message]);
}