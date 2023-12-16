<?php

// session_start();
error_reporting(1);


function search_users_admin($search)
{
  try {
    $search = trim($search);
    if (empty($search)) {
      throw new Exception('Search string is empty');
    }

    $db = _db();

    $q = $db->prepare("SELECT DISTINCT users2.*, restaurants.*
            FROM users2
            JOIN restaurants
            WHERE users2.user_email LIKE :user_email 
            OR users2.user_name LIKE :user_name
            OR users2.user_last_name LIKE :user_last_name
            OR users2.user_address LIKE :user_address
            OR users2.user_zip LIKE :user_zip
            OR users2.user_city LIKE :user_city
            OR users2.user_id = restaurants.fk_user_id AND restaurants.restaurant_name LIKE :restaurant_name
        ");

    $q->bindValue(':user_email', "%{$search}%");
    $q->bindValue(':user_name', "%{$search}%");
    $q->bindValue(':user_last_name', "%{$search}%");
    $q->bindValue(':user_address', "%{$search}%");
    $q->bindValue(':user_zip', "%{$search}%");
    $q->bindValue(':user_city', "%{$search}%");
    $q->bindValue(':restaurant_name', "%{$search}%");

    $q->execute();
    $result = $q->fetchAll();
    header("Location: /search-result");
    exit();
    return $result;
  } catch (Exception $e) {
    return ['error' => $e->getMessage()];
  }
}


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


// ##############################
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

// ##############################
define('USER_NAME_MIN', 2);
define('USER_NAME_MAX', 20);
function _validate_user_name()
{

  $error = 'user_name min ' . USER_NAME_MIN . ' max ' . USER_NAME_MAX;

  if (!isset($_POST['user_name'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_name'] = trim($_POST['user_name']);

  if (strlen($_POST['user_name']) < USER_NAME_MIN) {
    throw new Exception($error, 400);
  }

  if (strlen($_POST['user_name']) > USER_NAME_MAX) {
    throw new Exception($error, 400);
  }
}

// ##############################
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

// ##############################
function _validate_user_email()
{
  $error = 'user_email invalid';
  if (!isset($_POST['user_email'])) {
    throw new Exception($error, 400);
  }
  $_POST['user_email'] = trim($_POST['user_email']);
  if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    throw new Exception($error, 400);
  }
}

// ##############################
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

// ##############################
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
