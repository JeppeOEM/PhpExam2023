<?php

require_once __DIR__ . '/../_.php';
session_start();

try {
    $order_id = $_GET['order_id'];
    $db = _db();
    $db->beginTransaction();
    $q = $db->prepare(
        "SELECT fk_product_id FROM order_products WHERE fk_order_id = :order_id"
    );
    $q->bindValue(':order_id', $order_id);
    $q->execute();
    // get values from index 0/first value selected of the query
    $products_ids = $q->fetchAll(PDO::FETCH_COLUMN, 0);
    $product_info = [];
    foreach ($products_ids as $product_id) {

        $q = $db->prepare('SELECT price, product_name FROM products WHERE product_id = :fk_product_id');
        $q->bindValue(':fk_product_id', $product_id);
        $q->execute();
        $info = $q->fetch();

        $product_info[] = $info;
    }

    $db->commit();
    // p($products);
    echo json_encode(["product_ids" => $products_ids, "product_info" => $product_info]);
} catch (Exception $e) {
    var_dump($e);
    if ($db) {
        $db->rollBack();
    }
    try {
        if (!ctype_digit($e->getCode())) {
            throw new Exception();
        }
        http_response_code($e->getCode());
        echo json_encode(['info' => $e->getMessage(), 'first' => "first"]);
    } catch (Exception $ex) {
        http_response_code(500);
        var_dump($ex);
        echo json_encode(['info' => json_encode($ex), 'second' => "second"]);
    }
}
