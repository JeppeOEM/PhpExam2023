<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {
  // TODO: validate $_POST['query']
  $db = _db();
  $q = $db->prepare('SELECT orders.*, users2.*
    FROM orders
    JOIN users2 
    ON users2.user_id = orders.user_fk
    WHERE LOWER(users2.user_name) LIKE :username
    OR LOWER(users2.user_last_name) LIKE :user_last_name 
  ');
  $q->bindValue(':username', "%{$_POST['query']}%");
  $q->bindValue(':user_last_name', "%{$_POST['query']}%");
  $q->execute();
  $result = $q->fetchAll();
  echo json_encode($result);
} catch (Exception $e) {
  $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
  $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
  http_response_code($status_code);
  echo json_encode(['info' => $message]);
}
