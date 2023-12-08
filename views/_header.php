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
</head>

<body class="w-full h-screen bg-slate-300">

    <!-- <div class="fixed flex top-0 left-0 w-full">
        <div id="toast" class="hidden mt-4 px-8 py-2 mx-auto text-white rounded-full transition-all">
            Toast
        </div>
    </div> -->

    <nav class="fixed top-0 left-0 flex flex-col gap-4 
p-4 w-52 h-screen bg-slate-700">
        <h2>
            test
        </h2>

        <p>
            <?= $_SESSION['user']['user_name'] ?>
        </p>
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

        <button onclick="show_page('restaurants');">
            Order food
        </button>

        <button onclick="show_page('orders_partner');" <?php if ($_SESSION['user']['user_role'] != "partner") echo 'class="hidden"'; ?>>
            Orders
        </button>

        <button onclick="show_page('orders_user');" <?php if ($_SESSION['user']['user_role'] != "user") echo 'class="hidden"'; ?>>
            Orders
        </button>

        <button onclick="show_page('orders_admin');" <?php if ($_SESSION['user']['user_role'] != "admin") echo 'class="hidden"'; ?>>
            View all orders
        </button>

        <button onclick="show_page('users_admin');" <?php if ($_SESSION['user']['user_role'] != "admin") echo 'class="hidden"'; ?>>
            View users
        </button>


        <button onclick="show_page('admin');" <?php if ($_SESSION['user']['user_role'] != "admin") echo 'class="hidden"'; ?>>
            Admin
        </button>



    </nav>