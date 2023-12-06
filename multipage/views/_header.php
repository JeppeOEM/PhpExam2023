<?php require_once __DIR__.'/../_.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/app.css">  
  <title>Document</title>
</head>
<body class="w-full h-screen bg-slate-300">

<div class="fixed flex top-0 left-0 w-full">
  <div id="toast" 
  class="hidden mt-4 px-8 py-2 mx-auto text-white rounded-full transition-all">
    Toast
  </div>
</div>

<nav class="fixed top-0 left-0 flex flex-col gap-4 
p-4 w-52 h-screen bg-slate-700">

  <a href="/profile" onclick="show_page('profile'); return false">
    Profile
  </a>

  <a href="/contact-us" onclick="show_page('contact-us'); return false">
    Contact us
  </a>

  <a href="/about-us" onclick="show_page('about-us'); return false">
    About us
  </a>  

  <a href="/notifications" onclick="show_page('notifications'); return false">
    Notifications <span id="counter">0</span>
  </a>    

  <a href="/logout" onclick="return false" class="mt-auto">
    Logout
  </a>    

</nav>
