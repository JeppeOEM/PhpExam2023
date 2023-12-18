<main id="orders_admin" class="page mb-24 ">
    <section class="overflow-x-auto px-12 border-1 py-8 my-8">
        <form class="search_orders_admin flex flex-col py-2" method=" post">
            <label for="search">Search Orders</label>
            <div>
                <input name="search" type="text" class="border border-blue-500 border-solid w-159 p-2 rounded-lg mb-4 text-black">
                <button class="bg-blue-500 text-white p-2 px-4 rounded" type="submit">Search</button>
            </div>
        </form>
        <button onclick="build_orders('admin')" class="bg-blue-500 text-white p-2 px-4 rounded">Reset search</button>

        <p class="py-2 text-lg">Location information applies to Restaurants</p>
        <h2 class="text-2xl font-bold ">Under delivery</h2>
        <div class="table-container max-h-96 overflow-y-auto  ">
            <table class="min-w-full rounded-lg">
                <thead class="sticky top-0">
                    <tr class="[&>*]:border bg-gray-200 px-4 py-2">
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Restaurant</th>
                        <th>Created At</th>
                        <th>Scheduled At</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>ZIP Code</th>
                        <th>View order</th>
                    </tr>
                </thead>
                <tbody id="under_delivery_admin">
                </tbody>
            </table>

        </div>
    </section>

    <section class="overflow-x-auto px-12 border-1 py-6">

        <h2 class="text-2xl font-bold my-4">Order history</h2>

        <div class="table-container max-h-96 overflow-y-auto  ">
            <table class="min-w-full rounded-lg">
                <thead class="sticky top-0">
                    <tr class="[&>*]:border bg-gray-200 px-4 py-2">
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Restaurant</th>
                        <th>Created At</th>
                        <th>Scheduled At</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>ZIP Code</th>
                        <th>View order</th>

                    </tr>
                </thead>
                <tbody id="admin_orders">
                    <template id="admin_order">
                        <tr class="order_tr [&>*]:border px-8 py-2">
                            <td class="border px-8 py-2 order_id"></td>
                            <td class="border px-8 py-2 user_id_order"></td>
                            <td class="border px-8 py-2 restaurant_name_order"></td>
                            <td class="border px-8 py-2 created_at_order"></td>
                            <td class="border px-8 py-2 scheduled_at_order"></td>
                            <td class="border px-8 py-2 address_order"></td>
                            <td class="border px-8 py-2 city_order"></td>
                            <td class="border px-8 py-2 zip_order"></td>
                            <td class="border px-8 py-2">
                                <button class="bg-blue-500 text-white p-2 px-4 rounded modal_order">View order</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </section>






</main>