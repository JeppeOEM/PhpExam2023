<main id="login" class="page flex flex-col justify-center items-center h-screen">

    <form onsubmit="return validate(event, login)" method='post' class="bg-gray-100 p-8 rounded-lg shadow-md">
        <fieldset>
            <legend class="text-lg font-bold mb-4">Login </legend>
            <label for="user_email" class="text-sm text-gray-600">Email</label>
            <input name="user_email" type="text" placeholder="email" data-validate="email" class="w-full p-2 rounded-lg mb-4">
            <label for="user_password" class="text-sm text-gray-600">Password</label>
            <input name="user_password" type="password" placeholder="password" data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?> class=" w-full p-2 rounded-lg mb-4">
            <button class="w-full p-2 rounded-lg bg-blue-500 text-white">login</button>
        </fieldset>
    </form>
</main><?= USER_NAME_MIN ?>