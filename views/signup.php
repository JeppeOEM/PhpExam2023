<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form onsubmit="return validate(signup)">
        <input name="user_name" type="text" placeholder="name" data-validate="str" data-min="2" data-max="20">

        <input name="user_last_name" type="text" placeholder="last name" data-validate="str" data-min="2" data-max="20">

        <input name="user_email" type="text" placeholder="email" data-validate="email">

        <input name="user_password" type="text" placeholder="password" data-validate="str" data-min="2" data-max="20">

        <input name="user_confirm_password" type="text" placeholder="confirm password" data-validate="match" data-match-name="user_password">

        <button type="submit">Signup</button>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/app.js"></script>
    <script src="js/validator.js"></script>

</body>

</html>