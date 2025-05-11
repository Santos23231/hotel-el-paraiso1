<?php
// Verificar si los datos del formulario están presentes
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $habitacion = $_POST['habitacion'] ?? '';

    // Validar que todos los campos estén llenos
    if (!empty($nombre) && !empty($email) && !empty($telefono) && !empty($fecha) && !empty($habitacion)) {
        // Crear una línea de texto con los datos de la reserva
        $reserva = "$nombre|$email|$telefono|$fecha|$habitacion\n";

        // Guardar la reserva en el archivo
        $filePath = 'reservas.txt';
        if (file_put_contents($filePath, $reserva, FILE_APPEND)) {
            echo "Reserva guardada exitosamente.";
        } else {
            echo "Error: No se pudo guardar la reserva.";
        }
    } else {
        echo "Error: Todos los campos son obligatorios.";
    }
} else {
    echo "Error: Solicitud inválida.";
}
?>