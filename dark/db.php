<?php
// light/db.php

try {
    $host = 'mysql-db';
    $dbname = 'Hotel_Paraiso';
    $user = 'user_hotel';
    $password = 'hotel123';

    // Crear conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);

    // Configurar modo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ⚠ Elimina esta línea si la tienes:
    // echo "Connected successfully";
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}