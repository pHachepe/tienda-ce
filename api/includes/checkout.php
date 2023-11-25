<!-- Breadcrumb -->
<nav class="bg-gray-100 p-4" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="index.php" class="text-blue-500"><?= HOME ?></a>
            <span class="mx-2 text-gray-500"><?= SEPARATOR ?></span>
        </li>
        <li class="flex items-center">
            <span class="text-gray-600"><?= CHECKOUT ?></span>
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
                <?php if (isset($_SESSION["loggedin"])): ?>
                    <!-- Nombre y Apellidos -->
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                            <input id="nombre" type="text" placeholder="Nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 hover:cursor-not-allowed hover:ring-2 hover:ring-gray-200" value="<?= $_SESSION[
                                "user"
                            ]["nombre"] ?>" disabled>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label for="apellidos" class="block text-gray-700 text-sm font-bold mb-2">Apellidos</label>
                            <input id="apellidos" type="text" placeholder="Apellidos" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 hover:cursor-not-allowed hover:ring-2 hover:ring-gray-200" value="<?= $_SESSION[
                                "user"
                            ]["apellidos"] ?>" disabled>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" placeholder="Email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-blue-600" value="<?= isset(
                        $_SESSION["loggedin"]
                    )
                        ? $_SESSION["user"]["correo"]
                        : "" ?>" <?= isset($_SESSION["loggedin"]) ? "disabled" : "" ?>>
                </div>
                <!-- Dirección y Tarjeta -->
                <div class="mb-4">
                    <label for="direccion" class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                    <input id="direccion" type="text" placeholder="Calle, Número, Piso, CP, Ciudad, Provincia" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-blue-600" value="<?= isset(
                        $_SESSION["loggedin"]
                    )
                        ? $_SESSION["user"]["direccion"]
                        : "" ?>">
                </div>
                <div class="mb-6">
                    <label for="tarjeta" class="block text-gray-700 text-sm font-bold mb-2">Número de Tarjeta</label>
                    <input id="tarjeta" type="text" placeholder="1111 2222 3333 4444" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-blue-600" value="<?= isset(
                        $_SESSION["loggedin"]
                    )
                        ? $_SESSION["user"]["tarjeta"]
                        : "" ?>">
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
                <tbody id="summary-items" class="bg-white">
                    <!-- Con JS se insertan las filas con los datos de los productos del carrito de localStorage -->
                </tbody>
            </table>
            <!-- Total -->
            <p id="summary-total" class="text-2xl text-right mt-4"></p>
        </div>
    </div>
    <div class="text-right mt-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Confirmar Compra</button>
    </div>
</div>