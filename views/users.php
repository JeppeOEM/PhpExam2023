<?php

$order_id = $_GET['order_id'];
$db = _db();
$q = $db->prepare('SELECT * FROM users2 WHERE user_role = "partner"');
$q->execute();
$partners = $q->fetchAll();
$q = $db->prepare('SELECT * FROM users2 WHERE user_role = "user"');
$q->execute();
$users = $q->fetchAll();


?>

<main id="users_admin" class="page px-12">

    <h2 class=" text-2xl font-bold mb-4">Users</h2>
    <form class="search_admin_users_form" method="post">
        <label for="search">Search for users</label>
        <input name="search" type="text" class="border border-blue-500 border-solid w-159 p-2 rounded-lg mb-4 text-black">
        <button type="submit">Search</button>
    </form>
    <div class="overflow-x-auto ">
        <div class="table-container max-h-96 overflow-y-auto">
            <table class="min-w-full border rounded-lg">
                <thead>
                    <tr>
                        <th class="border bg-gray-200 px-4 py-1">ID</th>
                        <th class="border bg-gray-200 px-4 py-1">Name</th>
                        <th class="border bg-gray-200 px-4 py-1">Last Name</th>
                        <th class="border bg-gray-200 px-4 py-1">Email</th>
                        <th class="border bg-gray-200 px-4 py-1">Address</th>
                        <th class="border bg-gray-200 px-4 py-1">City</th>
                        <th class="border bg-gray-200 px-4 py-1">Zip</th>
                        <th class="border bg-gray-200 px-4 py-1">Role</th>
                        <th class="border bg-gray-200 px-4 py-1">Blocked</th>
                        <th class="border bg-gray-200 px-4 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td class="border px-4 py-1 text-center"><?= $user['user_id'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_name'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_last_name'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_email'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_address'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_city'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_zip'] ?></td>
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

    <h2 class="text-2xl font-bold my-4">Restaurants</h2>
    <div class="overflow-x-auto">
        <div class="table-container max-h-96 overflow-y-auto">
            <table class="min-w-full border rounded-lg">
                <thead>
                    <tr>
                        <th class="border bg-gray-200 px-4 py-1">ID</th>
                        <th class="border bg-gray-200 px-4 py-1">Name</th>
                        <th class="border bg-gray-200 px-4 py-1">Last Name</th>
                        <th class="border bg-gray-200 px-4 py-1">Email</th>
                        <th class="border bg-gray-200 px-4 py-1">Address</th>
                        <th class="border bg-gray-200 px-4 py-1">City</th>
                        <th class="border bg-gray-200 px-4 py-1">Zip</th>
                        <th class="border bg-gray-200 px-4 py-1">Role</th>
                        <th class="border bg-gray-200 px-4 py-1">Blocked</th>
                        <th class="border bg-gray-200 px-4 py-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($partners as $partner) : ?>
                        <tr>
                            <td class="border px-4 py-1 text-center"><?= $user['user_id'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_name'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_last_name'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_email'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_address'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_city'] ?></td>
                            <td class="border px-4 py-1 text-center"><?= $user['user_zip'] ?></td>
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