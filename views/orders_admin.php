<main id="orders_admin" class="page mt-24 mb-24 ">
    <section class="overflow-x-auto px-12 border-1 py-8 m-8">

        <h2 class="text-2xl font-bold ">Under delivery</h2>
        <div class="table-container max-h-96 overflow-y-auto  ">
            <table class="min-w-full rounded-lg">
                <thead class="sticky top-0">
                    <tr>
                        <th class="border bg-gray-200 px-4 py-1">Order ID</th>
                        <th class="border bg-gray-200 px-4 py-1">User ID</th>
                        <th class="border bg-gray-200 px-4 py-1">Created At</th>
                        <th class="border bg-gray-200 px-4 py-1">Scheduled At</th>
                        <th class="border bg-gray-200 px-4 py-1">Restaurant Name</th>
                        <th class="border bg-gray-200 px-4 py-1">Address</th>
                        <th class="border bg-gray-200 px-4 py-1">City</th>
                        <th class="border bg-gray-200 px-4 py-1">ZIP Code</th>
                        <th class="border bg-gray-200 px-4 py-1">View order</th>
                    </tr>
                </thead>
                <tbody id="under-delivery">
                </tbody>
            </table>
        </div>
    </section>

    <section class="overflow-x-auto px-12 border-1 py-8">

        <h2 class="text-2xl font-bold m-8">ORDER HISTORY</h2>

        <div class="table-container max-h-96 overflow-y-auto  ">
            <table class="min-w-full rounded-lg">
                <thead class="sticky top-0">
                    <tr>
                        <th class="border bg-gray-200 px-4 py-1">Order ID</th>
                        <th class="border bg-gray-200 px-4 py-1">User ID</th>
                        <th class="border bg-gray-200 px-4 py-1">Created At</th>
                        <th class="border bg-gray-200 px-4 py-1">Scheduled At</th>
                        <th class="border bg-gray-200 px-4 py-1">Restaurant Name</th>
                        <th class="border bg-gray-200 px-4 py-1">Address</th>
                        <th class="border bg-gray-200 px-4 py-1">City</th>
                        <th class="border bg-gray-200 px-4 py-1">ZIP Code</th>
                        <th class="border bg-gray-200 px-4 py-1">View order</th>

                    </tr>
                </thead>
                <tbody id="admin_orders">
                    <template id="admin_order">
                        <tr>
                            <td class="border px-8 py-1 order_id"></td>
                            <td class="border px-8 py-1 user_id_order"></td>
                            <td class="border px-8 py-1 created_at_order"></td>
                            <td class="border px-8 py-1 scheduled_at_order"></td>
                            <td class="border px-8 py-1 restaurant_name_order"></td>
                            <td class="border px-8 py-1 address_order"></td>
                            <td class="border px-8 py-1 city_order"></td>
                            <td class="border px-8 py-1 zip_order"></td>
                            <td class="border px-8 py-1">
                                <a class="text-blue-500 underline view_order">View Order</a>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </section>






</main>