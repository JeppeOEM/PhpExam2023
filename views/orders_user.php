<main id="orders_user" class="page">

    <form id="search_user" onsubmit="search_user(event)">
        <label for="search">Search for orders by restaurant name or date</label>
        <input name="search" type="text">
        <button>Search orders</button>
    </form>

    <h2>under DELIVER</h2>
    <div id="under_delivery" class="scheduled_orders  pt-4">
        <template id="under_delivery_order">
            <p class="order_id "></p>
            <p class="restaurant_id_order "></p>
            <p class="created_at_order "></p>
            <p class="scheduled_at_order"></p>
            <p class="user_id_order"></p>
            <p class="restaurant_name_order "></p>
            <p class="address_order"></p>
            <p class="city_order"></p>
            <p class="zip_order"></p>
            <a class="view_order" target="_blank">view products</a>
        </template>
    </div>
    <h1>DELIVERED</h1>
    <div id="user_orders" class="orders  pt-4">
        <template id="user_order">
            <p class="order_id "></p>
            <p class="restaurant_id_order "></p>
            <p class="created_at_order "></p>
            <p class="scheduled_at_order"></p>
            <p class="user_id_order"></p>
            <p class="restaurant_name_order "></p>
            <p class="address_order"></p>
            <p class="city_order"></p>
            <p class="zip_order"></p>
            <a class="view_order">view products</a>
        </template>
    </div>


</main>