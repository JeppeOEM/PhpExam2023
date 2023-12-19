<?php

// session_start();
error_reporting(1);



function is_logged_in()
{
  if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    // must be small letters
    return true;
  } else {
    return false;
  }
}

function logout()
{
  session_destroy();
  header("Location: /");
  exit();
}

//php console.log
function p($data)
{
  $output = $data;
  if (is_array($output))
    $output = implode(',', $output);

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}




define('USER_ADDRESS_MIN', 2);
define('USER_ADDRESS_MAX', 30);
function _validate_user_address()
{

  $error = 'Address min ' . USER_ADDRESS_MIN . ' max ' . USER_ADDRESS_MAX . ' characters';

  if (!isset($_POST['user_address'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_address'] = trim($_POST['user_address']);

  if (strlen($_POST['user_address']) < USER_ADDRESS_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_address']) > USER_ADDRESS_MAX) {
    throw new Exception($error, 400);
  }
}





define('USER_CITY_MIN', 2);
define('USER_CITY_MAX', 30);
function _validate_user_city()
{

  $error = 'City min ' . USER_CITY_MIN . ' max ' . USER_CITY_MAX . ' characters';

  if (!isset($_POST['user_city'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_city'] = trim($_POST['user_city']);

  if (strlen($_POST['user_city']) < USER_CITY_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_city']) > USER_CITY_MAX) {
    throw new Exception($error, 400);
  }
}


define('USER_ZIP_MIN', 4);
define('USER_ZIP_MAX', 5);
function _validate_user_zip()
{

  $error = 'ZIP code must be  ' . USER_ZIP_MAX . ' characters';

  if (!isset($_POST['user_zip'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_zip'] = trim($_POST['user_zip']);

  if (strlen($_POST['user_zip']) < USER_ZIP_MIN || !ctype_digit($_POST['user_zip'])) {
    return $error;
  }

  if (strlen($_POST['user_zip']) > USER_ZIP_MAX) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_zip']) > USER_ZIP_MAX) {
    throw new Exception($error, 400);
  }
}



define('USER_RESTAURANT_MIN', 2);
define('USER_RESTAURANT_MAX', 40);
function _validate_user_restaurant()
{

  $error = 'Restaurant name must be min ' . USER_CITY_MIN . ' max ' . USER_CITY_MAX . ' characters';


  if (!isset($_POST['user_restaurant'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_restaurant'] = trim($_POST['user_restaurant']);

  if (strlen($_POST['user_restaurant']) < USER_RESTAURANT_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_restaurant']) > USER_RESTAURANT_MAX) {
    throw new Exception($error, 400);
  }
}




define('USER_NAME_MIN', 2);
define('USER_NAME_MAX', 20);

function _validate_user_name()
{
  $error = 'user_name min ' . USER_NAME_MIN . ' max ' . USER_NAME_MAX . ' and should not contain numbers';

  if (!isset($_POST['user_name'])) {
    return $error;
  }
  $_POST['user_name'] = trim($_POST['user_name']);

  if (strlen($_POST['user_name']) < USER_NAME_MIN) {
    return $error;
  }

  if (strlen($_POST['user_name']) > USER_NAME_MAX) {
    return $error;
  }
}



define('USER_LAST_NAME_MIN', 2);
define('USER_LAST_NAME_MAX', 20);
function _validate_user_last_name()
{

  $error = 'user_last_name min ' . USER_LAST_NAME_MIN . ' max ' . USER_LAST_NAME_MAX;

  if (!isset($_POST['user_last_name'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_last_name'] = trim($_POST['user_last_name']);

  if (strlen($_POST['user_last_name']) < USER_LAST_NAME_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_last_name']) > USER_LAST_NAME_MAX) {
    throw new Exception($error, 400);
  }
}


function _validate_user_email()
{
  $error = 'user_email invalid';
  if (!isset($_POST['user_email'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_email'] = trim($_POST['user_email']);
  #inbuilt php validation of email
  if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    throw new Exception($error, 400);
  }
}


define('USER_PASSWORD_MIN', 6);
define('USER_PASSWORD_MAX', 50);
function _validate_user_password()
{

  $error = 'user_password min ' . USER_PASSWORD_MIN . ' max ' . USER_PASSWORD_MAX;

  if (!isset($_POST['user_password'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_password'] = trim($_POST['user_password']);

  if (strlen($_POST['user_password']) < USER_PASSWORD_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_password']) > USER_PASSWORD_MAX) {
    throw new Exception($error, 400);
  }
}


function _validate_user_confirm_password()
{
  $error = 'user_confirm_password must match the user_password';
  if (!isset($_POST['user_confirm_password'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_confirm_password'] = trim($_POST['user_confirm_password']);
  if ($_POST['user_password'] != $_POST['user_confirm_password']) {
    throw new Exception($error, 400);
  }
}


function _db()
{
  try {
    $user_name = "root";
    $user_password = "";
    // $db_connection = 'sqlite:' . __DIR__ . '/database/data.sqlite';
    $db_connection = "mysql:host=localhost; dbname=delivery_app; charset=utf8mb4";

    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    //   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ   [{}]    $user->id
    $db_options = array(
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // [['id'=>1, 'name'=>'A'],[]]  $user['id']
    );
    return new PDO($db_connection, $user_name, $user_password, $db_options);
  } catch (PDOException $e) {
    throw new Exception('ups... system under maintainance', 500);
    exit();
  }
}
