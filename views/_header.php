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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <link rel="stylesheet" href="css/global.css">
</head>

<body class="w-full h-screen ">

    <!-- <div class="fixed flex top-0 left-0 w-full">
        <div id="toast" class="hidden mt-4 px-8 py-2 mx-auto text-white rounded-full transition-all">
            Toast
        </div>
    </div> -->

    <nav class="fixed top-0 left-0 flex gap-4 p-4 px-10 w-full bg-slate-800 text-white z-20 justify-between text-xl">
        <div class="flex  [&>*]:px-4">
            <h2>
                <?php echo $_SESSION['user']['user_role'] ?>
            </h2>
            <button onclick=" show_page('login');" <?php if (isset($_SESSION['user'])) echo 'class="hidden"'; ?>>
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

            <form class="flex items-center " method="post" <?php if (!isset($_SESSION['user'])) echo 'class="hidden"'; ?>>
                <input id="logout" type="submit" name="logout" class="button cursor-pointer" value="Logout" <?php if (!isset($_SESSION['user'])) echo 'class="hidden"'; ?> />
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
        </div>

        <div id="order_here" class="bg-blue-500 p-4 rounded-xl flex flex-row items-center ">

            <div class="  px-3 py-3  rounded-full w-10 h-10" id="count"></div>

            <button class="px-4 py-2 border rounded-lg hover:bg-blue-700" id="order_products">0</button>
            <p class="pl-2 text-center" id="total_cost">0</p>
            <p class="px-2">DKK</p>
            <button id="empty_cart">🗑️</button>
        </div>
    </nav>