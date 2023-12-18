<?php require_once __DIR__ . '/_header.php'  ?>
<!-- absolute top-0 left-52 w-[calc(100vw-13rem)] h-screen overflow-hidden -->

<main id="profile" class="page ">
    <div class=" bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Profile</h2>
        <!-- name of callback cannot be the same as an ID of anything in the form -->

        <form onsubmit="return validate(event, update)" method="post">

            <input type="hidden" name="user_id" value=<?= $_SESSION['user']['user_id'] ?>>
            <div class="mb-4">
                <label for="user_name" class="block text-sm font-medium text-gray-600">First Name:</label>
                <input type="text" id="user_name" name="user_name" value=<?= $_SESSION['user']['user_name'] ?> readonly class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="mb-4">
                <label for="user_last_name" class="block text-sm font-medium text-gray-600">Last Name:</label>
                <input type="text" id="user_last_name" name="user_last_name" value=<?= $_SESSION['user']['user_last_name'] ?> readonly class="mt-1 p-2 border rounded w-full">
            </div>

            <div class="mb-4">
                <label for="user_email" class="block text-sm font-medium text-gray-600">Email:</label>
                <input type="email" id="user_email" name="user_email" value=<?= $_SESSION['user']['user_email'] ?> readonly class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="mb-4">
                <label for="user_address" class="block text-sm font-medium text-gray-600">Address:</label>
                <input name="user_address" type="text" placeholder="address" value=<?= $_SESSION['user']['user_address'] ?> data-validate="str" data-min="2" data-max="50" readonly class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="mb-4">
                <label for="user_zip" class="block text-sm font-medium text-gray-600">Zip code:</label>
                <input name="user_zip" type="text" placeholder="zip" value=<?= $_SESSION['user']['user_zip'] ?> data-validate="str" data-min="4" data-max="4" readonly class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="mb-4">
                <label for="user_city" class="block text-sm font-medium text-gray-600">City:</label>
                <input name="user_city" type="text" placeholder="city" value=<?= $_SESSION['user']['user_city'] ?> data-validate="str" data-min="2" data-max="40" readonly class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="flex justify-between">
                <div>
                    <button id="edit_profile" type="button" class="bg-blue-500 text-white p-2 px-4 rounded">Edit</button>
                    <input id="update_profile" type="submit" value="Submit" class=" bg-green-500 text-white p-2 px-4 rounded hidden">
                </div>
                <button class=" bg-red-500 text-white p-2 px-4 rounded onclick=" delete_user(<?= $_SESSION['user']['user_id'] ?>)" <?php if ($_SESSION['user']['user_role'] == "admin") echo 'class="hidden"'; ?>>Delete user</button>
            </div>
        </form>
    </div>

</main>



<?php require_once __DIR__ . '/_footer.php'  ?>