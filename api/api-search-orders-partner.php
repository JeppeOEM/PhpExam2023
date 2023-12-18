<?php

require_once __DIR__ . '/../_.php';

session_start();
try {
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $db = _db();
    $restaurant_id = $data->restaurant_id;
    $search = $data->search;

    $q = $db->prepare(
        'SELECT DISTINCT restaurants.restaurant_id, orders.*, users2.user_name, users2.user_last_name, users2.user_address, users2.user_city, users2.user_zip
        FROM orders
        JOIN users2 ON orders.user_fk = users2.user_id
        JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
        WHERE orders.restaurant_fk = :restaurant_id
        AND users2.user_name LIKE :search
        OR users2.user_last_name LIKE :search
        OR users2.user_address LIKE :search
        ORDER BY orders.created_at DESC'
    );
    $q->bindValue(':restaurant_id', $restaurant_id);
    $q->bindValue(':search', "%{$search}%");
    $q->execute();
    $orders = $q->fetchAll();

    // $orders1 = array_filter($orders, function ($order) use ($restaurant_id) {
    //     return $order['restaurant_id'] == $restaurant_id;
    // });

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
