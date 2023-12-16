<?php
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
    <h2 class=" text-2xl font-bold mb-4">User search result</h2>
    <button class=" text-white px-4 py-1 rounded bg-blue-500" onclick="show_page('users_admin')">
        Go back
    </button>
    <form class="search_admin_users_form" method="post">
        <label for="search">Search for users</label>
        <input name="search" type="text" class="border border-blue-500 border-solid w-159 p-2 rounded-lg mb-4 text-black">
        <button type="submit">Search</button>
    </form>
    <p class="pb-4">Search for every column in the user table or restaurant name connected to the user</p>
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
                <tbody class="min-w-full" id=" search_users">
                    <template id="search_user">
                        <tr class="search_tr">
                            <td class="border px-4 py-1 search_user_id"></td>
                            <td class="border px-4 py-1 search_user_name"></td>
                            <td class="border px-4 py-1 search_user_last_name"></td>
                            <td class="border px-4 py-1 search_user_email"></td>
                            <td class="border px-4 py-1 search_user_role"></td>
                            <td class="border px-4 py-1">
                                <button class="search_user_blocked text-white px-4 py-1 rounded" onclick="toggle_blocked(event)">
                                    Block Status
                                </button>
                            </td>
                            <td class="border px-4 py-1">
                                <button class="bg-red-500 text-white px-4 py-1 rounded" onclick="delete_user(event)">
                                    Delete User
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>



</main>