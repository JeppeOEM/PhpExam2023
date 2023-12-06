<?php require_once __DIR__ . '/../_.php';
session_start();

echo json_encode($_SESSION['user']);
var_dump($_SESSION['user']);
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
            <?= var_dump($_SESSION['user']['user_name']) ?>
        </p>
        <p>
            <?= $_SESSION['user']['user_name'] ?>
        </p>
        <button onclick="show_page('login');" <?php if (isset($_SESSION['user']['user_name'])) echo 'class="hidden"'; ?>>
            Login
        </button>

        <button onclick="show_page('signup');" <?php if (isset($_SESSION['user']['user_name'])) echo 'class="hidden"'; ?>>
            Register
        </button>








    </nav>