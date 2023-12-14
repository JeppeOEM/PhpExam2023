<dialog id="modal">
    <div class="p-8 text-lg">

        <section id="modal_products">
            <h2 class=" text-xl font-bold pb-4" id="modal_restaurant_name"></h2>
            <template id="modal_template">
                <article class="flex justify-between">
                    <p class="pr-2 modal_name"></p>
                    <p class="pr-2 modal_price"></p>
                </article>
            </template>

        </section>
        <div class="flex justify-between py-2 ">
            <p class="font-bold">Total price:</p>
            <p class=" modal_total">
            </p>

        </div>
        <p>
            <button class="w-full p-2 rounded-lg bg-blue-500 text-white" id="close_modal">Close</button>
        </p>
    </div>
</dialog>