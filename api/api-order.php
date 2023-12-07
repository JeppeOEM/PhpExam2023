<?php

require_once __DIR__ . '/../_.php';

try {
    $db = _db();
    // Log the values before executing the query
    $user_fk = $_POST['user_id'];
    $restaurant_fk = $_POST['restaurant_id'];
    $created_at = time();
    $scheduled_at = $created_at + 3600;
    $comments = $_POST['comments'];
    $amount = $_POST['amount'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];

    $orderData = [
        'user_fk' => $user_fk,
        'restaurant_fk' => $restaurant_fk,
        'created_at' => $created_at,
        'scheduled_at' => $scheduled_at,
        'comments' => $comments,
        'amount' => $amount,
        'city' => $city,
        'address' => $address,
        'zip' => $zip
    ];

    var_dump($orderData);

    $q = $db->prepare(
        '
    INSERT INTO orders
    (
      order_id, 
      user_fk, 
      created_at, 
      scheduled_at,
      comments,
      amount,
      restaurant_fk, 
      address,
      city,
      zip
    )
    VALUES (
      :order_id, 
      :user_fk, 
      :created_at, 
      :scheduled_at,
      :comments,
      :amount,
      :restaurant_fk, 
      :address,
      :city,
      :zip
    )'
    );

    $q->bindValue(':order_id', null);
    $q->bindValue(':user_fk', $user_fk);
    $q->bindValue(':created_at', $created_at);
    $q->bindValue(':scheduled_at', $scheduled_at);
    $q->bindValue(':comments', $comments);
    $q->bindValue(':amount', $amount);
    $q->bindValue(':restaurant_fk', $restaurant_fk);
    $q->bindValue(':address', $address);
    $q->bindValue(':city', $city);
    $q->bindValue(':zip', $zip);

    $q->execute();

    // Log the success message after executing the query
    echo json_encode(['order_id' => $db->lastInsertId()]);
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
