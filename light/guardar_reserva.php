<?php
// Verificar si los datos del formulario están presentes
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';

    // Calcular edad
    $edad = '';
    if (!empty($fecha_nacimiento)) {
        $fecha_nac = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $fecha_nac->diff($hoy)->y;
    }

    // Validar que todos los campos estén llenos
    if (!empty($nombre) && !empty($email) && !empty($telefono) && !empty($fecha) && !empty($fecha_nacimiento)) {
        // Leer reservas existentes
        $filePath = 'reservas.txt';
        $reservas = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
        $ocupadas = [];
        foreach ($reservas as $r) {
            $partes = explode('|', $r);
            if (isset($partes[4])) {
                $ocupadas[] = trim($partes[4]);
            }
        }

        // Definir habitaciones (1 a 8)
        $habitaciones = range(1, 8);

        // Asignar habitación según edad
        if ($edad >= 60) {
            // Tercera edad: primeras habitaciones disponibles
            foreach ($habitaciones as $h) {
                if (!in_array($h, $ocupadas)) {
                    $habitacion = $h;
                    break;
                }
            }
        } else {
            // Jóvenes: últimas habitaciones disponibles
            foreach (array_reverse($habitaciones) as $h) {
                if (!in_array($h, $ocupadas)) {
                    $habitacion = $h;
                    break;
                }
            }
        }

        if (isset($habitacion)) {
            // Guardar también la fecha de nacimiento para referencia
            $reserva = "$nombre | $email | $telefono | $fecha | $habitacion | $fecha_nacimiento" . PHP_EOL;
            if (file_put_contents($filePath, $reserva, FILE_APPEND)) {
                header("Location: index.php?reserva=ok&habitacion=$habitacion");
                exit();
            } else {
                echo "Error: No se pudo guardar la reserva.";
            }
        } else {
            echo "Error: No hay habitaciones disponibles.";
        }
    } else {
        echo "Error: Todos los campos son obligatorios.";
    }
} else {
    header("Location: index.php");
    exit();
}
?>