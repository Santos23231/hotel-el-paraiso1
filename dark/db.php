<?php
// private/db.php

$host = "mysql-db";       // Nombre del servicio en docker-compose
$user = "user_hotel";     // Usuario definido en MYSQL_USER
$password = "hotel123";   // Contraseña definida en MYSQL_PASSWORD
$database = "Hotel_Paraiso";
$port = 3306;             // Puerto interno del contenedor MySQL

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>