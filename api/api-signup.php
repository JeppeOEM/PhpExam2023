<?php

require_once __DIR__ . '/../_.php';

try {
    $db = _db();

    // Log the values before executing the query
    $name = $_POST['user_name'];
    $last = $_POST['user_last_name'];
    $email = $_POST['user_email'];
    $pass = $_POST['user_password'];
    $role = $_POST['user_role'];
    $address = $_POST['user_address'];
    $city = $_POST['user_city'];
    $zip = $_POST['user_zip'];


    $q = $db->prepare(
        '
    INSERT INTO users2
    (
      user_id, 
      user_name, 
      user_last_name, 
      user_email, 
      user_address,
      user_zip,
      user_city,
      user_password,
      user_role,
      user_blocked
    )
    VALUES (
      :user_id, 
      :user_name, 
      :user_last_name, 
      :user_email, 
      :user_address,
      :user_zip,
      :user_city,
      :user_password,
      :user_role,
      :user_blocked
    )'
    );

    $q->bindValue(':user_id', null);
    $q->bindValue(':user_name', $name);
    $q->bindValue(':user_last_name', $last);
    $q->bindValue(':user_email', $email);
    $q->bindValue(':user_role', $role);
    $q->bindValue(':user_address', $address);
    $q->bindValue(':user_city', $city);
    $q->bindValue(':user_zip', $zip);
    $q->bindValue(':user_blocked', 0);
    $q->bindValue(':user_password', password_hash($_POST['user_password'], PASSWORD_DEFAULT));

    $q->execute();

    // Log the success message after executing the query
    echo json_encode([
        'user_id' => $db->lastInsertId(), 'user_name' => $name, 'user_last_name' => $last,
        'user_email' => $email, 'user_role' => $role, 'user_address' => $address, 'user_city' => $city, 'user_zip' => $zip
    ]);
} catch (Exception $e) {
    try {
        if (!ctype_digit($e->getCode())) {
            throw new Exception();
        }
        http_response_code($e->getCode());
        var_dump($e, "first");
        echo json_encode(['info' => $e->getMessage(), 'first' => "first"]);
    } catch (Exception $ex) {
        http_response_code(500);
        var_dump($ex, "second");
        echo json_encode(['info' => json_encode($ex), 'second' => "second"]);
    }
}
