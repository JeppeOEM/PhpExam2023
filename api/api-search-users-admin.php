
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

    $q = $db->prepare("SELECT DISTINCT 
            users2.*
        FROM 
            users2
        LEFT JOIN (
            SELECT 
                fk_user_id, 
                GROUP_CONCAT(restaurant_name SEPARATOR ', ') AS restaurant_names
            FROM 
                restaurants
            GROUP BY 
                fk_user_id
        ) AS grouped_restaurants ON users2.user_id = grouped_restaurants.fk_user_id
        WHERE 
            users2.user_email LIKE :search 
            OR users2.user_name LIKE :search
            OR users2.user_last_name LIKE :search
            OR users2.user_address LIKE :search
            OR users2.user_zip LIKE :search
            OR users2.user_city LIKE :search
            OR grouped_restaurants.restaurant_names LIKE :search
    ");

    $q->bindValue(':search', "%{$search}%");

    $q->execute();
    $result = $q->fetchAll();

    // $q = $db->prepare("SELECT DISTINCT users2.*, restaurants.*
    //     FROM users2
    //     JOIN restaurants
    //     WHERE users2.user_email LIKE :user_email 
    //     OR users2.user_name LIKE :user_name
    //     OR users2.user_last_name LIKE :user_last_name
    //     OR users2.user_address LIKE :user_address
    //     OR users2.user_zip LIKE :user_zip
    //     OR users2.user_city LIKE :user_city
    //     OR users2.user_id = restaurants.fk_user_id AND restaurants.restaurant_name LIKE :restaurant_name
    // ");

    // $q->bindValue(':user_email', "%{$search}%");
    // $q->bindValue(':user_name', "%{$search}%");
    // $q->bindValue(':user_last_name', "%{$search}%");
    // $q->bindValue(':user_address', "%{$search}%");
    // $q->bindValue(':user_zip', "%{$search}%");
    // $q->bindValue(':user_city', "%{$search}%");
    // $q->bindValue(':restaurant_name', "%{$search}%");

    // $q->execute();
    // $result = $q->fetchAll();

    echo json_encode($result);
} catch (Exception $e) {
    $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
    $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
    http_response_code($status_code);
    echo json_encode(['info' => $message]);
}
