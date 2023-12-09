<?php

$order_id = $_GET['order_id'];
$db = _db();
$q = $db->prepare('SELECT * FROM users2 WHERE user_role = "partner"');
$q->execute();
$partners = $q->fetchAll();
$q = $db->prepare('SELECT * FROM users2 WHERE user_role = "user"');
$q->execute();
$users = $q->fetchAll();
?>



<main id="users_admin" class="page">
    <h2>USERS</h2>
    <?php foreach ($users as $user) : ?>
        <p><?= $user['user_id'] ?></p>
        <p><?= $user['user_name'] ?></p>
        <p><?= $user['user_last_name'] ?></p>
        <p><?= $user['user_email'] ?></p>
        <p><?= $user['user_role'] ?></p>
        <p><?= $user['user_role'] ?></p>
        <button onclick="toggle_blocked(event, <?= $user['user_id'] ?>,<?= $user['user_blocked'] ?>)">
            <?= $user['user_blocked'] == 0 ? "unblocked" : "blocked" ?>
        </button>
        <button onclick="delete_user(<?= $user['user_id'] ?>)">
            delete user
        </button>
    <?php endforeach ?>
    <h2>
        PARTNERS
    </h2>
    <?php foreach ($partners as $partner) : ?>
        <p><?= $partner['user_id'] ?></p>
        <p><?= $partner['user_name'] ?></p>
        <p><?= $partner['user_last_name'] ?></p>
        <p><?= $partner['user_email'] ?></p>
        <p><?= $partner['user_role'] ?></p>
        <p><?= $partner['user_role'] ?></p>
        <button onclick="toggle_blocked(event, <?= $user['user_id'] ?>,<?= $user['user_blocked'] ?>)">
            <?= $user['user_blocked'] == 0 ? "unblocked" : "blocked" ?>
        </button>
        <button onclick="delete_user(<?= $user['user_id'] ?>)">
            delete user
        </button>
    <?php endforeach ?>

</main>