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
  foreach ($pedidos as $pedido) {
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
      $pedidos[$i - 1]["productos"] = $productos;
    }
  }
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

<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold text-center mb-6">Historial de Pedidos</h1>

  <?php foreach ($pedidos as $pedido) : ?>
    <div class="mb-6">
      <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 border-b">
          <div class="text-xl font-bold">Pedido ID: <?= $pedido['id'] ?></div>
          <p><strong>Fecha:</strong> <?= date("d/m/Y H:i", strtotime($pedido['fecha'])) ?></p>
          <p><strong>Dirección:</strong> <?= $pedido['direccion'] ?></p>
          <p><strong>Tarjeta:</strong> <?= $pedido['tarjeta'] ?></p>
          <p><strong>Total:</strong> <?= number_format($pedido['total'], 2, ",", ".") ?>€</p>
          <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-300">Ver Productos</button>
          <ul class="mt-2 hidden">
            <?php foreach ($pedido['productos'] as $producto) : ?>
              <li class="border-t p-2">
                <?= $producto['cantidad'] ?> x
                <?php $producto["imagen"] = !empty($producto["imagenes"]) ? json_decode($producto["imagenes"], true)[0] : "default.png"; ?>
                <img src="public/img/<?= $producto["imagen"] ?>" alt="<?= $producto["nombre"] ?>" class="w-14 h-14 object-contain inline-block p-1">
                <?= $producto['nombre'] ?> - <?= number_format($producto['precio'], 2, ",", ".") ?>€
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>