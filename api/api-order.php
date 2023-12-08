<?php

require_once __DIR__ . '/../_.php';
session_start();

    try {
        $db = _db();
        $json = file_get_contents('php://input');
        #decoce outer json layer
        $data = json_decode($json);
        #decocde  array
        $products = json_decode($data->total_products);
        p($products, "olololooolol");
        // var_dump($data->restaurant_id, $data->total_products);

        $restaurant_fk = $data->restaurant_id;
        // Log the values before executing the query
        // $user_fk = $_POST['user_id'];
        $user_fk = $_SESSION['user']['user_id'];

        // $restaurant_fk = $_POST['restaurant_id'];
        $restaurant_fk = 1;
        $restaurantQuery = $db->prepare('SELECT fk_user_id FROM restaurants WHERE restaurant_id = :restaurant_id');
        $restaurantQuery->bindValue(':restaurant_id', $restaurant_fk);
        $restaurantQuery->execute();
        $restaurantInfo = $restaurantQuery->fetch();
        if (!$restaurantInfo) {
            throw new Exception('Restaurant not found', 404);
        }
        $user_fk_restaurant = $restaurantInfo['fk_user_id'];
        $userQuery = $db->prepare('SELECT * FROM users2 WHERE user_id = :user_id');
        $userQuery->bindValue(':user_id', $user_fk_restaurant);
        $userQuery->execute();
        $userInfo = $userQuery->fetch();
        if (!$userInfo) {
            throw new Exception('User not found', 404);
        }

        $zip = $userInfo['user_zip'];

        $address = $userInfo['user_address'];
        $city = $userInfo['user_city'];
        $created_at = time();
        $scheduled_at = $created_at + 3600;

        $orderData = [
            'user_fk' => $user_fk,
            'restaurant_fk' => $restaurant_fk,
            'created_at' => $created_at,
            'scheduled_at' => $scheduled_at,
            'city' => $city,
            'address' => $address,
            'zip' => $zip
        ];

        p($orderData);
        $db->beginTransaction();
        $q = $db->prepare(
            '
    INSERT INTO orders
    (
      order_id, 
      user_fk, 
      created_at, 
      scheduled_at,
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
        $q->bindValue(':restaurant_fk', $restaurant_fk);
        $q->bindValue(':address', $address);
        $q->bindValue(':city', $city);
        $q->bindValue(':zip', $zip);
        $q->execute();
        $order_id = $db->lastInsertId();
        p($order_id);
        foreach ($products as $product_id) {
            $q = $db->prepare('INSERT INTO order_products (fk_order_id, fk_product_id) VALUES (:fk_order_id, :fk_product_id)');
            $q->bindValue(':fk_order_id', $order_id);
            $q->bindValue(':fk_product_id', $product_id);
            $q->execute();
        }
        $db->commit();

        echo json_encode(['order_id' => $order_id]);
    } catch (Exception $e) {
        $db->rollBack();
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

