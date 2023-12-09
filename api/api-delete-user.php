<?php
require_once __DIR__ . '/../_.php';
try {
    session_start();
    $user_id = $_GET['user_id'];

    // $user_id = $_SESSION['user']['user_id'];
    $db = _db();
    $q = $db->prepare('DELETE FROM users2 WHERE user_id = :user_id');
    $q->bindValue(':user_id', $user_id);
    if ($_SESSION['user']['user_role'] === "admin") {
        $q->execute();
    } elseif ($_SESSION['user']['user_id'] == $user_id) {
        $q->execute();
        session_destroy();
    }

    $counter = $q->rowCount();
    if ($counter != 1) {
        throw new Exception('could not delete user', 500);
    }
    http_response_code(204);
} catch (Exception $e) {
    try {
        if (!$e->getCode() || !$e->getMessage()) {
            throw new Exception();
        }
        http_response_code($e->getCode());
        echo json_encode(['info' => $e->getMessage()]);
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode($ex);
    }
}
