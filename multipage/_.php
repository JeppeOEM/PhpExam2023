<?php

ini_set('display_errors', 1);

// ##############################
$_lan = json_decode(file_get_contents(__DIR__.'/dictionary.json'), true);
$default = ! isset($_GET['lan']) ? 'en' : $_GET['lan'] ;
$_lan = $_lan[$default];


// ##############################
define('USER_NAME_MIN', 2);
define('USER_NAME_MAX', 20);
function _validate_user_name(){
  $error = 'user_name '.USER_NAME_MIN.' to '.USER_NAME_MAX.' characters';

}












