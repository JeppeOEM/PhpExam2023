<?php
require_once __DIR__ . '/_header.php';
if (array_key_exists('search_admin', $_POST)) {
    $users_search = search_users_admin($_POST['search_admin']);
    $_SESSION['search_admin_users'] = $users_search;
    // var_dump($users);
}

if (isset($_SESSION['search_admin_users'])) {
    $users_search = $_SESSION['search_admin_users'];
}

?>

<main id="search_users" class="page px-12">
    <h2 class=" text-2xl font-bold mb-4">USERS</h2>

    <form class="search_admin_users" method="post">
        <input type="text" name="search_admin">
        <input type="submit" class="button cursor-pointer" value="Search" class="mt-0" />
    </form>
    <?php var_dump($users_search); ?>

    <!-- <form class="search_admin_users">
        <label for="search">Search for users</label>
        <input name="search" type="text" class="border border-blue-500 border-solid w-159 p-2 rounded-lg mb-4 text-black">
        <input type="submit" value="Search">
    </form> -->
    <div class="overflow-x-auto ">
        <div class="table-container max-h-96 overflow-y-auto">
            <table class="min-w-full border rounded-lg">
                <thead>
                    <tr>
                        <th class="border bg-gray-200 px-4 py-1">ID</th>
                        <th class="border bg-gray-200 px-4 py-1">Name</th>
                        <th class="border bg-gray-200 px-4 py-1">Last Name</th>
                        <th class="border bg-gray-200 px-4 py-1">Email</th>
                        <th class="border bg-gray-200 px-4 py-1">Role</th>
                        <th class="border bg-gray-200 px-4 py-1">Blocked</th>
                        <th class="border bg-gray-200 px-4 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users_search as $user) : ?>
                        <tr>
                            <td class="border px-4 py-1 text-center"><?= $user['user_id'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_name'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_last_name'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_email'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_role'] ?></td>
                            <td class="border px-4 py-1 text-center">
                                <button class="<?= $user['user_blocked'] == 0 ? 'bg-green-500' : 'bg-red-500' ?> text-white px-4 py-1 rounded text-center" onclick="toggle_blocked(event, <?= $user['user_id'] ?>, <?= $user['user_blocked'] ?>)">
                                    <?= $user['user_blocked'] == 0 ? "Unblocked" : "Blocked" ?>
                                </button>
                            </td>
                            <td class="border px-4 py-1 text-center">
                                <button class="bg-red-500 text-white px-4 py-1 rounded " onclick="delete_user(<?= $user['user_id'] ?>)">
                                    Delete User
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/_footer.php'  ?>