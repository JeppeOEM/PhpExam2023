<?php
require_once __DIR__ . '/../_.php';
try {
    //raw POST data, $_POST works for "Content-Type": "application/x-www-form-urlencoded"

    session_start();

    // if ($_SESSION['user']['user_role'] == "user") {
    $db = _db();
    $q = $db->prepare('  SELECT orders.*, restaurants.restaurant_name 
        FROM orders
        JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
        WHERE orders.user_fk = :fk_user_id
        -- AND restaurants.restaurant_name LIKE Burger%
        ');
    var_dump($_SESSION['user'], $_POST['search']);
    $q->bindValue(':fk_user_id', $_SESSION['user']['user_id']);
    // $q->bindValue(':search', $_POST['search']);
    $q->execute();
    $result = $q->fetchAll();
    echo json_encode(['result' => $result]);
    //     } elseif ($_SESSION['user']['user_role'] == "partner") {


    //         $db = _db();
    //         $q = $db->prepare('SELECT orders.*, restaurants.restaurant_name 
    //     FROM orders
    //     JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
    //     WHERE orders.user_fk = :fk_user_id
    //     AND restaurants.restaurant_name LIKE :search
    // ');
    //         $q->bindValue(':fk_user_id', $_SESSION['user']['user_id']);
    //         $q->bindValue(':seach', $_POST['search']);

    //         $q->execute();
    //         $products = $q->fetchAll();
    //         echo json_encode(['products' => $products]);
    //     } elseif ($_SESSION['user']['user_role'] == "admin") {

    //         $db = _db();
    //         $q = $db->prepare('SELECT orders.*, restaurants.restaurant_name 
    //     FROM orders
    //     JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
    //     WHERE orders.user_fk = :fk_user_id
    //     AND restaurants.restaurant_name LIKE :search
    // ');
    //         $q->bindValue(':fk_user_id', $_SESSION['user']['user_id']);
    //         $q->bindValue(':seach', $_POST['search']);

    //         $q->execute();
    //         $products = $q->fetchAll();
    //         echo json_encode(['products' => $products]);
    // }
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
