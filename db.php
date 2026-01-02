<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "flower_shop_db";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Database connection failed");
}

?>
