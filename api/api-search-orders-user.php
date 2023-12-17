<?php

require_once __DIR__ . '/../_.php';

session_start();
try {
    //raw POST data, $_POST works for "Content-Type": "application/x-www-form-urlencoded"
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $db = _db();
    $user_id = $data->user_id;
    $search = $data->search;
    // $role = $_SESSION['user']['user_role'];

    // p($_SESSION['user'], "useeeeeeeeeer");

    $q = $db->prepare(
        'SELECT orders.*, restaurants.restaurant_name 
            FROM orders
            JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
            WHERE orders.user_fk = :fk_user_id
            AND orders.city LIKE :search
            ORDER BY orders.created_at DESC
        '
    );
    // $q->bindValue(':fk_user_id', $_SESSION['user']['user_id']);
    $q->bindValue(':fk_user_id', 77);
    $q->bindValue(':search', "%{$search}%");



    $q->execute();
    $orders = $q->fetchAll();
    echo json_encode(['orders' => $orders]);
} catch (Exception $e) {
    try {
        if (!$e->getCode() || !$e->getMessage()) {
            throw new Exception();
        }
        var_dump($e);
        http_response_code($e->getCode());
        echo json_encode(['info' => $e->getMessage()]);
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode($ex);
    }
}
