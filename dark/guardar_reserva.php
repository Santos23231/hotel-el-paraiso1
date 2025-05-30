<?php
session_start();

// Incluir conexión a la base de datos
require_once __DIR__. '/db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Recibir datos del formulario
$nombre = $_POST['nombre'] ?? '';
$fechanac = $_POST['fecha_nacimiento'] ?? '';
$correo = $_POST['email'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$fecha_inicio = $_POST['checkin'] ?? '';
$fecha_fin = $_POST['checkout'] ?? '';

// Validación básica
if (empty($nombre) || empty($fechanac) || empty($fecha_inicio) || empty($fecha_fin)) {
    die("Por favor completa todos los campos obligatorios.");
}

try {
    // Calcular edad
    $fechaNacimiento = new DateTime($fechanac);
    $hoy = new DateTime();
    $edad = $hoy->diff($fechaNacimiento)->y;

    if ($edad < 18) {
        die("Solo mayores de edad pueden hacer reservas.");
    }

    // Preparar consulta
    $stmt = $conn->prepare("
        INSERT INTO reservas 
        (nombre, fechanac, correo, telefono, fecha_inicio, fecha_fin) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    if ($stmt === false) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }

    // Ejecutar consulta con parámetros
    $stmt->bind_param(
        "ssssss",
        $nombre,
        $fechanac,
        $correo,
        $telefono,
        $fecha_inicio,
        $fecha_fin
    );

    $stmt->execute();

    echo "<div class='alert alert-success'>✅ Reserva guardada correctamente.</div>";
    echo "<a href='javascript:history.back()' class='btn btn-primary'>Volver</a>";

    $stmt->close();
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>❌ Error al guardar la reserva: " . $e->getMessage() . "</div>";
}
?>