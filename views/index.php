<?php require_once __DIR__ . '/_header.php'  ?>

<?php

if ($_SESSION['user']['user_role'] == "user") {
    $session = "user";
} elseif ($_SESSION['user']['user_role'] == "partner") {
    $session = "partner";
} elseif ($_SESSION['user']['user_role'] == "admin") {
    $session = "admin";
}


?>

<div id="pages" class="absolute top-0 left-0 w-full h-screen " data-session="<?= $session ?>">
    
    <?php require_once __DIR__ . '/login.php' ?>
    <?php require_once __DIR__ . '/signup.php' ?>
    <?php require_once __DIR__ . '/404.php' ?>
    <?php require_once __DIR__ . '/restaurants.php' ?>
    <?php require_once __DIR__ . '/restaurant.php' ?>
    <?php require_once __DIR__ . '/profile.php' ?>
    <?php require_once __DIR__ . '/orders_partner.php' ?>
    <?php require_once __DIR__ . '/orders_user.php' ?>
    <?php require_once __DIR__ . '/orders_admin.php' ?>
    <?php require_once __DIR__ . '/admin.php' ?>
    <?php require_once __DIR__ . '/users.php' ?>



</div>


<?php require_once __DIR__ . '/_footer.php'  ?>