<!-- Breadcrumb -->
<nav class="bg-gray-100 p-4" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="index.php" class="text-blue-500"><?= HOME ?></a>
            <span class="mx-2 text-gray-500"><?= SEPARATOR ?></span>
            <span class="text-gray-600">PIKA</span>
        </li>
    </ol>
</nav>

<!-- Contenedor Principal -->
<div class="m-8">
    <div class="flex gap-8 flex-wrap md:flex-nowrap">
        <!-- Formulario de Información del Usuario -->
        <div class="bg-white p-6 shadow-md w-1/2">
            <h2 class="text-2xl font-bold mb-4">Información del Usuario</h2>
            <form>
                <!-- Nombre y Apellidos -->
                <div class="flex flex-wrap -mx-3 mb-4">
                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                        <input id="nombre" type="text" placeholder="Nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?= isset(
                            $_SESSION["loggedin"]
                        )
                            ? $_SESSION["user"]["nombre"]
                            : "" ?>">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="apellidos" class="block text-gray-700 text-sm font-bold mb-2">Apellidos</label>
                        <input id="apellidos" type="text" placeholder="Apellidos" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                <!-- Dirección y Tarjeta -->
                <div class="mb-4">
                    <label for="direccion" class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                    <input id="direccion" type="text" placeholder="Calle, Número, Piso, CP, Ciudad, Provincia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label for="tarjeta" class="block text-gray-700 text-sm font-bold mb-2">Número de Tarjeta</label>
                    <input id="tarjeta" type="text" placeholder="1111 2222 3333 4444" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </form>
        </div>

        <!-- Resumen de los Artículos del Carrito -->
        <div class="bg-white p-6 shadow-md w-1/2">
            <h2 class="text-2xl font-bold mb-4">Resumen del Pedido</h2>
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Imagen
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Artículo
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Cantidad
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Precio
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Subtotal
                        </th>
                    </tr>
                </thead>
                <tbody id="cart-items" class="bg-white">
                    <!-- Con JS se insertan las filas con los datos de los productos del carrito de localStorage -->
                </tbody>
            </table>
            <!-- Total -->
            <div class="text-right mt-4">
                <p class="text-2xl">Total: 40.00€</p>
            </div>
        </div>
    </div>
    <div class="text-right mt-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Confirmar Compra</button>
    </div>
</div>