<?php

require_once __DIR__ . '/../_.php';

session_start();
try {
    //raw POST data, $_POST works for "Content-Type": "application/x-www-form-urlencoded"
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $db = _db();
    $role = $data->user;
    $q = $db->prepare('SELECT orders.*, restaurants.restaurant_name
            FROM orders
            JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
            WHERE orders.order_id = :fk_user_id
        ');
    // $q->bindValue(':fk_user_id', $_SESSION['user']['user_id']);
    $q->bindValue(':fk_user_id', $_GET['order_id']);
    $q->execute();
    $order = $q->fetch();
    echo json_encode(['order' => $order]);
} catch (Exception $e) {
    try {
        if (!$e->getCode() || !$e->getMessage()) {
            throw new Exception();
        }
        http_response_code($e->getCode());
        echo json_encode(['info' => $e->getMessage()]);
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode($ex);
    }
}
