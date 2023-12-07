<?php
require_once __DIR__ . '/../_.php';
try {

    $db = _db();
    $q = $db->prepare('SELECT restaurants.*, users2.user_address, users2.user_zip, users2.user_city 
                      FROM restaurants 
                      JOIN users2 ON restaurants.fk_user_id = users2.user_id');

    $q->execute();
    $restaurants = $q->fetchAll();
    echo json_encode(['restaurants' => $restaurants]);
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
