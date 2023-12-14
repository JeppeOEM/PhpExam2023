<?php

require_once __DIR__ . '/../_.php';
session_start();

try {
    $db = _db();
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $products = $data->products;
    // $products = [1, 1, 2];

    $db->beginTransaction();
    $total_price = 0; // Initialize total price outside the loop
    $all_products = [];
    foreach ($products as $key) {
        $q = $db->prepare("SELECT * FROM products WHERE product_id = :product");
        $q->bindValue(':product', $key);
        $q->execute();
        $selected_product = $q->fetch();
        $total_price += $selected_product['price'];
    }
    $db->commit();

    echo json_encode(['sum' => $total_price]);
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
