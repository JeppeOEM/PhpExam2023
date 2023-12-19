<?php
session_start();

header('Content-Type: application/json');
require_once __DIR__ . '/../_.php';
try {
    // TODO: make sure this is the admin user
    // TODO: check in the session the user's role
    $user_id = $_POST['user_id'];
    // $user_id = 1;
    $user_name = $_POST['user_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_city = $_POST['user_city'];
    $user_zip = $_POST['user_zip'];
    p($user_email);
    p($user_name);
    p($user_last_name);
    p($user_id);
    $db = _db();
    $q = $db->prepare("
        UPDATE users2
        SET 
            user_email = :user_email,
            user_last_name = :user_last_name,
            user_name = :user_name
            user_name = :user_address
            user_name = :user_city
            user_name = :user_zip
        WHERE user_id = :user_id;
    ");

    $q->bindValue(':user_id', $user_id);
    $q->bindValue(':user_email', $_POST['user_email']);
    $q->bindValue(':user_last_name', $_POST['user_last_name']);
    $q->bindValue(':user_name', $_POST['user_name']);
    $q->bindValue(':user_address', $_POST['user_address']);
    $q->bindValue(':user_city', $_POST['user_city']);
    $q->bindValue(':user_zip', $_POST['user_zip']);
    $q->execute();

    $_SESSION['user'] = [
        'user_id' => $user_id,
        'user_name' => $user_name,
        'user_last_name' => $user_last_name,
        'user_email' => $user_email,
        'user_address' => $user_address,
        'user_city' => $user_city,
        'user_zip' => $user_zip,
    ];
    echo json_encode($_SESSION['user']);
} catch (Exception $e) {
    $status_code = !ctype_digit($e->getCode()) ? 500 : $e->getCode();
    $message = strlen($e->getMessage()) == 0 ? 'error - ' . $e->getLine() : $e->getMessage();
    http_response_code($status_code);
    echo json_encode(['info' => $message]);
}
