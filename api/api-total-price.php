<?php

require_once __DIR__ . '/../_.php';
session_start();

try {
    $db = _db();
    $products = [1, 2, 3];

    //array_fill(start index, how many inserts, what to insert)
    $placeholders = array_fill(0, count($products), '?');
    $placeholders = implode(',', $placeholders);

    $q = $db->prepare("SELECT SUM(price) AS total_price FROM products WHERE product_id IN ($placeholders)");

    // will bind id to ? one by one
    foreach ($products as $key => $product_id) {
        //rows are not 0 indexed so add 1
        $q->bindValue(($key + 1), $product_id);
    }

    $q->execute();
    $selected_products = $q->fetch();

    echo json_encode(['sum' => $selected_products['total_price']]);
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
