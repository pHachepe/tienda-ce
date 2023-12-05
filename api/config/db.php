<?php
require_once "session_db_handler.php";
$servername = 'gateway01.us-west-2.prod.aws.tidbcloud.com';
$dbname = 'tienda_abraham';
$username = '43wEyrihpbWYbWN.root';
$password = 'xsAMBv6LE2GpXPWs';
$port = 4000;

$conn = mysqli_init();
mysqli_real_connect($conn, $servername, $username, $password, $dbname, 4000, null, MYSQLI_CLIENT_SSL);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


