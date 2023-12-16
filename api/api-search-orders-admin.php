
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

    $q = $db->prepare('SELECT DISTINCT 
            orders.*, restaurants.restaurant_name, users2.user_name, users2.user_last_name
            FROM orders
            JOIN restaurants ON orders.restaurant_fk = restaurants.restaurant_id
            JOIN users2 ON orders.user_fk = users2.user_id
            WHERE restaurants.restaurant_name LIKE :search 
            OR orders.address LIKE :search
            OR orders.city LIKE :search
            OR orders.zip LIKE :search
            OR users2.user_name LIKE :search
            OR users2.user_last_name LIKE :search
            ORDER BY orders.created_at DESC');

    $q->bindValue(':search', "%{$search}%");

    $q->execute();
    $result = $q->fetchAll();


    echo json_encode($result);
} catch (Exception $e) {
    $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
    $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
    http_response_code($status_code);
    echo json_encode(['info' => $message]);
}
