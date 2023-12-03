<?php
require_once "session_db_handler.php";
session_start();
$servername = 'localhost';
$dbname = 'tienda_abraham';
$username = 'root';
$password = 'Abrah@M917';

$conn = mysqli_init();
mysqli_real_connect($conn, $servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
