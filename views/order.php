<?php
require_once __DIR__ . '/../_.php';
$order_id = $_GET['order_id'];

$db = _db();
$q = $db->prepare('SELECT products.product_name, products.price
FROM order_products
JOIN products ON order_products.fk_product_id = products.product_id
WHERE order_products.fk_order_id = :order_id');
$q->bindValue(':order_id', $order_id);
$q->execute();
$products = $q->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php foreach ($products as $product) : ?>
        <p><?= $product['product_name'] ?></p>
        <p><?= $product['price'] ?></p>
    <?php endforeach ?>

</body>

</html>