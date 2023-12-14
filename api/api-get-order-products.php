<?php

require_once __DIR__ . '/../_.php';
session_start();

try {
    $order_id = $_GET['order_id'];
    $db = _db();
    $q = $db->prepare("SELECT * FROM order_products WHERE fk_product_id = :order_id");
    $q->bindValue(':order_id', $order_id);
    $q->execute();
    $products = $q->fetchAll();
    // p($products);
    echo json_encode(["products" => $products]);
} catch (Exception $e) {
    $db->rollBack();
    try {
        if (!ctype_digit($e->getCode())) {
            throw new Exception();
        }
        http_response_code($e->getCode());
        echo json_encode(['info' => $e->getMessage(), 'first' => "first"]);
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode(['info' => json_encode($ex), 'second' => "second"]);
    }
}
