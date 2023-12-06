<?php
require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/_header.php';
?>

<main>
    <form onsubmit="validate(event, signup); return false" class="flex flex-col px-4 text-white 
  lg:w-1/3 mx-auto gap-4 [&_input]:border [&_input]:border-black
  [&_input]:h-10 [&_input]:rounded-md [&_input]:outline-none
  [&_input]:text-black">


        <div class="grid">
            <label for="">
                email
            </label>
            <input name="user_email" type="text" data-validate="email">
        </div>

        <div class="grid">
            <label for="">
                user password mix <?= USER_PASSWORD_MIN ?> max <?= USER_PASSWORD_MAX ?>
            </label>
            <input name="user_password" type="text" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>" class="">
        </div>

        <button>Login</button>

    </form>
</main>

<?php require_once __DIR__ . '/_footer.php'  ?>