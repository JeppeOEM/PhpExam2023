<main id="restaurant" class="page">
    <section>
        <h1 class="restaurant_title">
            Restaurant
        </h1>
        <!-- products inserted with build_products() -->
        <button id="order_products">order products</button>
        <button id="empty_cart"> empty cart</button>
        <h2 class="text-xl">
            Products
        </h2>
        <div id="product_grid" class="grid grid-cols-3 gap-4">
            <template id="product_article">
                <article class="cursor-pointer" id="">
                    <span>
                        <h2 class="product_name"></h2>
                        <p><span class="price"></span>DKK</p>
                    </span>
                    <button class="buy" id="">+</button>
                </article>
            </template>
        </div>
        <h2 class="text-xl">Menus</h2>
        <div id="menu_grid" class="grid grid-cols-3 gap-4"></div>
        <h2 class="text-xl">Drinks</h2>
        <div id="drinks_grid" class="grid grid-cols-3 gap-4"></div>
    </section>
</main>