<?php
require_once "config/db.php";
require_once "includes/constants.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["loggedin"])) {
        // Si el usuario esta logueado recuperamos su id
        $id_usuario = $_SESSION["user"]["id"];
    } else {
        // Miramos si existe un usuario invitado con el email introducido
        $email = $_POST["email"];
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if (!$user) {
                // Si no existe un usuario invitado con ese email lo creamos
                $sql = "INSERT INTO usuarios (email) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $id_usuario = mysqli_insert_id($conn);
            } else {
                // Si existe un usuario con ese email pero tiene contraseña es un usuario registrado y no puede hacer un pedido como invitado
                if ($user["contraseña"]) {
                    echo json_encode([
                        "success" => false,
                        "msg" => ERROR_EMAIL_EXISTS,
                    ]);
                    exit;
                }
                // Si existe un usuario con ese email pero no tiene contraseña es un usuario invitado y puede hacer un pedido como invitado
                $id_usuario = $user["id"];
            }
        } else {
            echo json_encode([
                "success" => false,
                "msg" => ERROR_DB,
            ]);
        }
    }

    // Recuperamos los datos del pedido
    $fecha = date("Y-m-d H:i:s");
    $direccion = $_POST["direccion"];
    $tarjeta = $_POST["tarjeta"];
    $cart = json_decode($_POST["cart"], true);

    // Insertamos el pedido en la tabla pedidos
    $sql = "INSERT INTO pedidos (id_usuario, direccion, tarjeta) VALUES($id_usuario, '$direccion', '$tarjeta');";
    $query = mysqli_query($conn, $sql);
    $id_pedido = mysqli_insert_id($conn);

    // Insertamos los productos del carrito en la tabla pedidos_productos
    foreach ($cart as $item) {
        $id_producto = $item["id"];
        $precio = $item["precio"];
        $cantidad = $item["cantidad"];

        $sql = "INSERT INTO pedidos_productos VALUES(NULL, $id_pedido, $id_producto, $precio, $cantidad);";
        $query = mysqli_query($conn, $sql);
    }

    // Actualizamos el total del pedido
    $sql = "UPDATE pedidos SET total = (SELECT SUM(precio * cantidad) FROM pedidos_productos WHERE id_pedido = $id_pedido) WHERE id = $id_pedido;";
    $query = mysqli_query($conn, $sql);

    // Vaciamos el carrito
    unset($_SESSION["cart"]);

    echo json_encode([
        "success" => true,
        "msg" => ORDER_SUCCESS,
    ]);
} else {
    echo json_encode([
        "success" => false,
        "msg" => ERROR_INVALID_REQUEST,
    ]);
}
