
<?php
require_once __DIR__ . '/../_.php';

try {

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $search = $data->search;

    if (empty($search)) {
        echo json_encode(['info' => 'Search string is empty']);
        exit;
    }

    $db = _db();
    $q = $db->prepare(
        'SELECT orders.*, restaurants.restaurant_name 
            FROM orders
            JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
            ORDER BY orders.created_at DESC'
    );
    // $q = $db->prepare(
    //     'SELECT orders.*, restaurants.restaurant_name 
    //     FROM orders
    //     JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
    //     WHERE orders.user_fk LIKE :search
    //     AND orders.city LIKE :search
    //     ORDER BY orders.created_at DESC'
    // );

    // $q->bindValue(':search', "%{$search}%");

    $q->execute();
    $result = $q->fetchAll();


    echo json_encode($result);
} catch (Exception $e) {
    $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
    $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
    http_response_code($status_code);
    echo json_encode(['info' => $message]);
}
