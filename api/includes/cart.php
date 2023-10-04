<div id="cart-body" class="px-4 pb-4 bg-white mt-2 text-gray-700 shadow-md rounded-md">
    <section id="articulos" class="overflow-auto relative"></section>

    <section>
        <div class="px-4 bg-gray-100 mb-4">
            <h1 id="total" class="font-semibold text-gray-700 text-2xl text-center p-3"></h1>
        </div>

        <button id="checkout-btn" class="bg-blue-500 text-white py-3 rounded w-full text-center text-xl font-semibold hover:bg-blue-600">
            <i class="fas fa-credit-card"></i>
            <?= CHECKOUT; ?>
        </button>
    </section>
</div>