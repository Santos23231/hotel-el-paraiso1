<?php
try {
    $host = 'mysql-db';
    $dbname = 'Hotel_Paraiso';
    $user = 'user_hotel';
    $password = 'hotel123';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}