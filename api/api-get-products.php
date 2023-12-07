<?php
require_once __DIR__ . '/../_.php';
try {
    //raw POST data, $_POST works for "Content-Type": "application/x-www-form-urlencoded"
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $restaurant_id = $data->restaurant_id;
    $db = _db();
    $q = $db->prepare('SELECT * FROM products WHERE fk_restaurant_id = :restaurant_id');
    $q->bindValue(':restaurant_id', $restaurant_id);

    $q->execute();
    $products = $q->fetchAll();
    echo json_encode(['products' => $products]);
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
