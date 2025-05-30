<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $nit = $_POST['nit'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $fecha_registro = $_POST['fecha_registro'];
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $desayuno = intval($_POST['desayuno'] ?? 0);
    $almuerzo = intval($_POST['almuerzo'] ?? 0);
    $cena = intval($_POST['cena'] ?? 0);
    $spa = intval($_POST['spa'] ?? 0);
    $masaje = intval($_POST['masaje'] ?? 0);
    $habitacion = intval($_POST['habitacion']);

    // Calcular total a pagar
    $total = ($desayuno * 30) + ($almuerzo * 65) + ($cena * 75) + ($spa * 300) + ($masaje * 150);

    // Insertar reserva
    $stmt = $conn->prepare("INSERT INTO reservas 
        (nombre, nit, fecha_nacimiento, fecha_registro, telefono, email, desayuno, almuerzo, cena, spa, masaje, total_a_pagar, numero_habitacion) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssssssiiidddi",
        $nombre,
        $nit,
        $fecha_nacimiento,
        $fecha_registro,
        $telefono,
        $email,
        $desayuno,
        $almuerzo,
        $cena,
        $spa,
        $masaje,
        $total,
        $habitacion
    );

    if ($stmt->execute()) {
        header("Location: rooms.php");
        exit();
    } else {
        die("Error al guardar la reserva: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>