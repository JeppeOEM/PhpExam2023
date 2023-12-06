<?php
$email = $_POST['email'];
echo $email;
$password = $_POST['password'];
echo $password;
// header('Location: /admin.php');
if ($email == 'a') { // success
    session_start();
    $_SESSION['email'] = $email;
    header('Location: /admin.php');
    exit();
}

header('Location: /login.php');
exit();
