<main id="restaurant" class="page px-12">

    <h1 class="restaurant_title">
        Restaurant
    </h1>
    <!-- products inserted with build_products() -->

    <button id="empty_cart">empty cart</button>
    <h2 class="product_category">
        Products
    </h2>
    <div id="product_grid" class="flex flex-wrap ">
        <template id="product_article">
            <article class=" product cursor-pointer w-1/2 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2 ">
                <div class="bg-gray-100 p-4 border rounded-lg shadow-md  hover:border-blue-500 hover:text-blue-500">
                    <span class="pb-1">
                        <h2 class="product_name pb-1 text-xl"></h2>
                        <p class="pb-1"><span class=" price "></span>DKK</p>
                    </span>
                    <button class=" buy px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                        +
                    </button>
                </div>
            </article>
        </template>
    </div>
    <h2 class="product_category">Menus</h2>
    <div id="menu_grid" class="flex flex-wrap">
        <!-- Content for Menus -->
    </div>
    <h2 class="product_category">Drinks</h2>
    <div id="drinks_grid" class="flex flex-wrap">
        <!-- Content for Drinks -->
    </div>

</main>