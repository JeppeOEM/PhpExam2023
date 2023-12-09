<?php

require_once __DIR__ . '/../_.php';

session_start();
try {
    //raw POST data, $_POST works for "Content-Type": "application/x-www-form-urlencoded"
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $db = _db();

    // $role = $_SESSION['user']['user_role'];

    // p($_SESSION['user'], "useeeeeeeeeer");
    $role = $data->user;
    if ($role == "user") {
        $q = $db->prepare('SELECT orders.*, restaurants.restaurant_name 
            FROM orders
            JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
            WHERE orders.user_fk = :fk_user_id
        ');
        // $q->bindValue(':fk_user_id', $_SESSION['user']['user_id']);
        $q->bindValue(':fk_user_id', $_SESSION['user']['user_id']);
    } elseif ($role == "partner") {
        // $json = file_get_contents('php://input');
        // $data = json_decode($json);
        // $restaurant_id = $data->restaurant_id;
        // $q = $db->prepare('SELECT * FROM orders WHERE restaurant_fk = :restaurant_id');
        $q = $db->prepare(
            'SELECT orders.*, restaurants.restaurant_name 
            FROM orders
            JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
            WHERE restaurant_fk = :restaurant_id'
        );
        $q->bindValue(':restaurant_id', 1);
        // $q->bindValue(':restaurant_id', $_POST['restaurant_id']);
    } elseif ($role == "admin") {
        $q = $db->prepare(
            'SELECT orders.*, restaurants.restaurant_name 
            FROM orders
            JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id'
        );
    }


    $q->execute();
    $orders = $q->fetchAll();
    echo json_encode(['orders' => $orders]);
} catch (Exception $e) {
    try {
        if (!$e->getCode() || !$e->getMessage()) {
            throw new Exception();
        }
        // var_dump($e);
        http_response_code($e->getCode());
        echo json_encode(['info' => $e->getMessage()]);
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode($ex);
    }
}
