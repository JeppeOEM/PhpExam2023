<?php require_once __DIR__ . '/../_.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tailwindcss/app.css">
    <title>Document</title>
    <script src="/js/utils.js" defer></script>
    <script src="/js/validator.js" defer></script>
    <script src="/js/app.js" defer></script>
    <script src="/js/create_html.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/global.css">
</head>

<body class="w-full h-screen bg-slate-300">

    <!-- <div class="fixed flex top-0 left-0 w-full">
        <div id="toast" class="hidden mt-4 px-8 py-2 mx-auto text-white rounded-full transition-all">
            Toast
        </div>
    </div> -->

    <nav class="fixed top-0 left-0 flex gap-4 p-4 w-full bg-slate-700 z-20">

        <button onclick="show_page('login');" <?php if (isset($_SESSION['user'])) echo 'class="hidden"'; ?>>
            Login
        </button>

        <button onclick="show_page('signup');" <?php if (isset($_SESSION['user'])) echo 'class="hidden"'; ?>>
            Register
        </button>

        <?php
        if (array_key_exists('logout', $_POST)) {
            logout();
        }
        ?>

        <form method="post" <?php if (!isset($_SESSION['user'])) echo 'class="hidden"'; ?>>
            <input type="submit" name="logout" class="button" value="Logout" />
        </form>

        <button onclick="show_page('profile');" <?php if (!isset($_SESSION['user'])) echo 'class="hidden"'; ?>>
            Profile
        </button>

        <button onclick="show_page('restaurants', build_restaurants);">
            Restaurants
        </button>

        <button onclick="show_page('orders_partner', build_orders, 'partner');" <?php if ($_SESSION['user']['user_role'] != "partner") echo 'class="hidden"'; ?>>
            Orders
        </button>

        <button onclick="show_page('orders_user', build_orders, 'user' );" <?php if ($_SESSION['user']['user_role'] != "user") echo 'class="hidden"'; ?>>
            Orders
        </button>

        <button onclick="show_page('orders_admin', build_orders, 'admin'); " <?php if ($_SESSION['user']['user_role'] != "admin") echo 'class="hidden"'; ?>>
            View all orders
        </button>

        <button onclick="show_page('users_admin');" <?php if ($_SESSION['user']['user_role'] != "admin") echo 'class="hidden"'; ?>>
            View users
        </button>

        <button onclick="show_page('admin');" <?php if ($_SESSION['user']['user_role'] != "admin") echo 'class="hidden"'; ?>>
            Admin
        </button>



    </nav>