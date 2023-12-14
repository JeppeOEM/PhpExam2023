<main id="orders_partner" class="page">
    <section class="overflow-x-auto px-12 border-1 py-8 m-8">

        <h2 class="text-2xl font-bold ">Under delivery</h2>
        <div class="table-container max-h-96 overflow-y-auto  ">
            <table class="min-w-full rounded-lg">
                <thead class="sticky top-0">
                    <tr class="order_tr [&>*]:border bg-gray-200 px-4 py-2">
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Created At</th>
                        <th>Scheduled At</th>
                        <th>Restaurant Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>ZIP Code</th>
                        <th>View order</th>
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
                    <tr class="order_tr [&>*]:border bg-gray-200 px-4 py-2">
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Created At</th>
                        <th>Scheduled At</th>
                        <th>Restaurant Name</th>
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
                            <td class="border px-8 py-2 created_at_order"></td>
                            <td class="border px-8 py-2 scheduled_at_order"></td>
                            <td class="border px-8 py-2 restaurant_name_order"></td>
                            <td class="border px-8 py-2 address_order"></td>
                            <td class="border px-8 py-2 city_order"></td>
                            <td class="border px-8 py-2 zip_order"></td>
                            <td class="border px-8 py-2">
                                <button class="modal_order">View order!</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </section>

</main>