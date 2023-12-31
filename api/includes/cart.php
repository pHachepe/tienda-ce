<section id="cart-empty" class="flex flex-col items-center justify-center space-y-4 hidden p-16">
    <i class="fas fa-shopping-cart text-gray-400 text-6xl"></i>
    <span class="text-gray-500"><?= CART_EMPTY ?></span>
</section>

<section id="cart-articles">
    <section id="articulos" class="overflow-y-auto relative max-h-[34rem]"></section>

    <section>
        <div class="my-4">
            <h1 id="total" class="font-semibold text-gray-700 text-2xl text-center"></h1>
        </div>

        <form method="POST" action="?checkout" class="m-0">
            <button id="checkout-btn" class="bg-blue-500 text-white py-3 rounded w-full text-center text-xl font-semibold hover:bg-blue-600">
                <i class="fas fa-credit-card"></i>
                <?= CHECKOUT ?>
            </button>
        </form>
    </section>
</section>