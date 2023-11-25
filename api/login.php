<?php
require_once "config/db.php";
require_once "includes/session_db_handler.php";
require_once "includes/constants.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user["contraseña"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["user"] = $user;
            echo json_encode([
                "success" => true,
                "msg" => SUCCESS,
                "Session" => json_encode($_SESSION),
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "msg" => ERROR_INVALID_CREDENTIALS,
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "msg" => ERROR_DB,
        ]);
    }
} else {
    echo json_encode([
        "success" => false,
        "msg" => ERROR_INVALID_REQUEST,
    ]);
}
