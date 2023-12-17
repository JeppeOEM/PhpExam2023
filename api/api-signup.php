<?php

require_once __DIR__ . '/../_.php';

try {
    _validate_user_zip();
    _validate_user_city();
    _validate_user_address();
    _validate_user_last_name();
    _validate_user_name();
    _validate_user_email();
    _validate_user_password();
    _validate_user_confirm_password();

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

    $db->beginTransaction();

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
      created_at
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
      :created_at
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
    $q->bindValue(':user_password', password_hash($_POST['user_password'], PASSWORD_DEFAULT));
    $q->bindValue(':created_at', time());
    $q->execute();
    p(isset($_POST['restaurant_name']));
    p($_POST['restaurant_name']);
    if (isset($_POST['restaurant_name'])) {
        $q_restaurant = $db->prepare(
            'INSERT INTO restaurants (restaurant_name, fk_user_id) VALUES (:restaurant_name, :fk_user_id)'
        );

        $fk_user_id = $db->lastInsertId();
        $q_restaurant->bindValue(':fk_user_id', $fk_user_id);
        $q_restaurant->bindValue(':restaurant_name', $_POST['restaurant_name']);
        $q_restaurant->execute();
    }


    $db->commit();

    // Log the success message after executing the query
    echo json_encode([
        'user_id' => $db->lastInsertId(), 'user_name' => $name, 'user_last_name' => $last,
        'user_email' => $email, 'user_role' => $role, 'user_address' => $address, 'user_city' => $city, 'user_zip' => $zip
    ]);
} catch (Exception $e) {
    var_dump($e->getMessage());
    $db->rollBack();
    try {
        if (!ctype_digit($e->getCode())) {
            throw new Exception();
        }
        http_response_code($e->getCode());
        echo json_encode(['info' => $e->getMessage(), 'first' => $e->getMessage()]);
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode(['info' => json_encode($ex), 'second' => $e->getMessage()]);
    }
}
