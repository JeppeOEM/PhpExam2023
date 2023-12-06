<main id="profile" class="page">
    <div class="bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Profile</h2>
        <!-- name of callback cannot be the same as an ID of anything in the form -->
        <form onsubmit="return validate(event, update)" method="post">
            <div class="mb-4">
                <label for="user_name" class="block text-sm font-medium text-gray-600">First Name:</label>
                <input type="text" id="user_name" name="user_name" value=<?= $_SESSION['user']['user_name'] ?> readonly class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="mb-4">
                <label for="user_last_name" class="block text-sm font-medium text-gray-600">User Last Name:</label>
                <input type="text" id="user_last_name" name="user_last_name" value=<?= $_SESSION['user']['user_last_name'] ?> readonly class="mt-1 p-2 border rounded w-full">
            </div>

            <div class="mb-4">
                <label for="user_email" class="block text-sm font-medium text-gray-600">User Email:</label>
                <input type="email" id="user_email" name="user_email" value=<?= $_SESSION['user']['user_email'] ?> readonly class="mt-1 p-2 border rounded w-full">
            </div>


            <button id="edit_profile" type="button" class="bg-blue-500 text-white p-2 rounded">Edit</button>

            <input id="update_profile" type="submit" value="Submit" class="mt-4 bg-green-500 text-white p-2 rounded hidden">
        </form>
    </div>



    <form>
        <fieldset>
            <input type="text">
        </fieldset>
    </form>
</main>
<script src="/js/app.js"></script>