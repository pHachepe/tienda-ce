<?php
$sql = "SELECT * FROM pedidos WHERE id_usuario = ? ORDER BY fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["user"]["id"]);

if ($stmt->execute()) {
  $result = $stmt->get_result();
  $filas = $result->num_rows;
  $pedidos = [];
  for ($i = 0; $i < $filas; $i++) {
    $result->data_seek($i);
    $fila = $result->fetch_array(MYSQLI_ASSOC);
    $pedidos[$i] = $fila;
  }

  // Obtenemos los productos de cada pedido
  foreach ($pedidos as &$pedido) { // Usa & para modificar directamente el array $pedidos
    $sql = "SELECT * FROM pedidos_productos INNER JOIN productos ON pedidos_productos.id_producto = productos.id WHERE id_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pedido["id"]);

    if ($stmt->execute()) {
      $result = $stmt->get_result();
      $filas = $result->num_rows;
      $productos = [];
      for ($i = 0; $i < $filas; $i++) {
        $result->data_seek($i);
        $fila = $result->fetch_array(MYSQLI_ASSOC);
        $productos[$i] = $fila;
      }
      $pedido["productos"] = $productos; // Asigna los productos al pedido actual
    }
  }
  unset($pedido); // Rompe la referencia con el último elemento (IMPORTANTE SI NO SE ELIMINA DA ERROR AL HACER UNA CONSULTA DESPUÉS)

}
?>
<!-- Breadcrumb -->
<nav class="bg-gray-100 p-4" aria-label="Breadcrumb">
  <ol class="list-none p-0 inline-flex">
    <li class="flex items-center">
      <a href="?" class="text-blue-500"><?= HOME ?></a>
      <span class="mx-2 text-gray-500"><?= SEPARATOR ?></span>
    </li>
    <li class="flex items-center">
      <span class="text-gray-600"><?= ORDERS ?></span>
    </li>
  </ol>
</nav>

<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold text-center mb-10 text-gray-800">Historial de Pedidos</h1>

  <?php foreach ($pedidos as $pedido) : ?>
    <div class="mb-8">
      <div class="bg-white shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b">
          <div class="text-2xl font-semibold text-gray-700">Pedido ID: <?= $pedido['id'] ?></div>
          <p class="text-gray-600"><strong>Fecha:</strong> <?= date("d/m/Y H:i", strtotime($pedido['fecha'])) ?></p>
          <p class="text-gray-600"><strong>Dirección:</strong> <?= $pedido['direccion'] ?></p>
          <p class="text-gray-600"><strong>Tarjeta:</strong> <?= $pedido['tarjeta'] ?></p>
          <p class="text-gray-600"><strong>Total:</strong> <?= number_format($pedido['total'], 2, ",", ".") . CURRENCY ?></p>
          <div class="px-6 py-4">
            <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-300">Ver Productos</button>
            <ul class="mt-4 hidden">
              <?php foreach ($pedido['productos'] as $producto) : ?>
                <li class="flex items-center border-t p-2">
                  <span class="mr-2 font-medium"><?= $producto['cantidad'] ?> x</span>
                  <?php $producto["imagen"] = !empty($producto["imagenes"]) ? json_decode($producto["imagenes"], true)[0] : "default.png"; ?>
                  <img src="public/img/<?= $producto["imagen"] ?>" alt="<?= $producto["nombre"] ?>" class="w-14 h-14 object-contain inline-block p-1">
                  <span class="flex-grow"><?= $producto['nombre'] ?> - <?= number_format($producto['precio'], 2, ",", ".") . CURRENCY ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>