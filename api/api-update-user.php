<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {
    // TODO: make sure this is the admin user
    // TODO: check in the session the user's role

    $user_id = $_SESSION['user']['user_id'];
    // $user_id = 1;
    $user_name = $_POST['user_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $db = _db();
    $q = $db->prepare("
        UPDATE users2
        SET 
            user_email = :user_email,
            user_last_name = :user_last_name,
            user_name = :user_name
        WHERE user_id = :user_id;
    ");

    $q->bindValue(':user_id', $user_id);
    $q->bindValue(':user_email', $_POST['user_email']);
    $q->bindValue(':user_last_name', $_POST['user_last_name']);
    $q->bindValue(':user_name', $_POST['user_name']);
    $q->execute();

    session_start();
    $_SESSION['user'] = [
        'user_id' => $user_id,
        'user_name' => $_POST['user_name'],
        'user_last_name' => $_POST['user_last_name'],
        'user_email' => $_POST['user_email']
    ];
    echo json_encode($_SESSION['user']);
} catch (Exception $e) {
    $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
    $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
    http_response_code($status_code);
    echo json_encode(['info' => $message]);
}
