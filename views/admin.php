<!-- get orders -->
<?php require_once '../api/api-get-orders.php';
$orders = get_orders($_SESSION['user']['user_id']);
p($orders, "dsdsad")
?>

<main id="admin" class="page w-full px-4 md:px-12 lg:px-44">

    <div class="py-4">
        <form onsubmit="return false" class="flex gap-4 items-center w-full">
            <label for="" class="w-2/12">Search for user</label>
            <input name="user_search" class="w-8/12 h-8 dark:bg-zinc-400 rounded-sm outline-none" type="text">
            <button class="w-2/12 h-8 text-black bg-zinc-400 border border-zinc-400 rounded-sm">Search</button>
        </form>
    </div>

    <?php foreach ($orders as $order) : ?>
        <div class="flex w-full pt-4">
            <div class="w-1/12"><?= $order['order_id'] ?></div>
            <div class="w-1/12"><?= $order['user_fk'] ?></div>
            <div class="w-1/5"><?= $order['created_at'] ?></div>
            <div class="w-1/5"><?= $order['restaurant_fk'] ?></div>
            <div class="w-1/5"><?= $order['address'] ?></div>
            <div class="w-1/5"><?= $order['zip'] ?></div>
            <div class="w-1/5"><?= $order['city'] ?></div>



            <button class="w-1/5">

                unblucked blo
            </button>





        </div>
    <?php endforeach ?>
</main>