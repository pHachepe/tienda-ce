<?php
session_set_save_handler("openSession", "closeSession", "readSession", "writeSession", "destroySession", "gcSession");

session_start();

function openSession($savePath, $sessionName)
{
    // Establecer aquí la conexión a la BD si aún no se ha hecho.
    return true;
}

function closeSession()
{
    // Cerrar aquí la conexión a la BD si fuera necesario.
    return true;
}

function readSession($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT data FROM sessions WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();

    if ($row) {
        return $row["data"];
    } else {
        return "";
    }
}

function writeSession($id, $data)
{
    global $conn;
    $stmt = $conn->prepare("REPLACE INTO sessions (id, data) VALUES (?, ?)");
    $stmt->bind_param("ss", $id, $data);
    return $stmt->execute();
}


function destroySession($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM sessions WHERE id = ?");
    $stmt->bind_param("s", $id);
    return $stmt->execute();
}


function gcSession($maxLifetime)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM sessions WHERE last_accessed < NOW() - INTERVAL ? SECOND");
    $stmt->bind_param("i", $maxLifetime);
    return $stmt->execute();
}
