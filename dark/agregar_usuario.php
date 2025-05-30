<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $habitacion = trim($_POST['habitacion']);
    $total = trim($_POST['total']);

    $email = '';
    $telefono = '';
    $fecha = date('Y-m-d');

    $linea = "$nombre|$email|$telefono|$fecha|$habitacion|$total" . PHP_EOL;
    file_put_contents('reservas.txt', $linea, FILE_APPEND);

    header('Location: rooms.php');
    exit();
} else {
    header('Location: rooms.php');
    exit();
}

