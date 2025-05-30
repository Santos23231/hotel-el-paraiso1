<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $habitacion = trim($_POST['habitacion']);
    $total = trim($_POST['total']);

    // Puedes agregar más campos aquí si lo necesitas
    $email = '';
    $telefono = '';
    $fecha = date('Y-m-d');

    // Guardar en reservas.txt
    $linea = "$nombre|$email|$telefono|$fecha|$habitacion|$total" . PHP_EOL;
    file_put_contents('reservas.txt', $linea, FILE_APPEND);

    // Redirigir de vuelta a rooms.php o donde muestres las habitaciones
    header('Location: rooms.php');
    exit();
} else {
    // Si no es POST, redirige
    header('Location: rooms.php');
    exit();
}

