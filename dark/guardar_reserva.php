<?php
$mysqli = new mysqli("127.0.0.1", "root", "hotel123", "Hotel", 3306);
if ($mysqli->connect_errno) {
    die("Fallo la conexión: " . $mysqli->connect_error);
}

// Recibe datos del formulario
$nombre = $_POST['nombre'];
$fechanac = $_POST['fechanac'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$id_habitacion = $_POST['id_habitacion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

// 1. Insertar huésped (si no existe)
$stmt = $mysqli->prepare("INSERT INTO Huesped (nombre, fechanac, correo, telefono) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $fechanac, $correo, $telefono);
if (!$stmt->execute()) {
    // Si el correo ya existe, obtener el id_huesped existente
    $result = $mysqli->query("SELECT id_huesped FROM Huesped WHERE correo='$correo'");
    $row = $result->fetch_assoc();
    $id_huesped = $row['id_huesped'];
} else {
    $id_huesped = $stmt->insert_id;
}
$stmt->close();

// 2. Insertar reserva en Control_hospedaje
$estado = "reservado";
$stmt = $mysqli->prepare("INSERT INTO Control_hospedaje (id_huesped, id_habitacion, fecha_inicio, fecha_fin, estado) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $id_huesped, $id_habitacion, $fecha_inicio, $fecha_fin, $estado);
$stmt->execute();
$stmt->close();

echo "Reserva guardada correctamente. <a href='panel_reservas.php'>Ver reservas</a>";
?>