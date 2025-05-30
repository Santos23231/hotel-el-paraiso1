<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $fecha = $_POST['fecha'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';

    $edad = '';
    if (!empty($fecha_nacimiento)) {
        $fecha_nac = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $fecha_nac->diff($hoy)->y;
    }

    if (!empty($nombre) && !empty($email) && !empty($telefono) && !empty($fecha) && !empty($fecha_nacimiento)) {
        $filePath = 'reservas.txt';
        $reservas = file_exists($filePath) ? file($filePath, FILE_IGNORE_NEW_LINES) : [];
        $ocupadas = [];
        foreach ($reservas as $r) {
            $partes = explode('|', $r);
            if (isset($partes[4])) {
                $ocupadas[] = trim($partes[4]);
            }
        }

        $habitaciones = range(1, 8);

        if ($edad >= 60) {
            foreach ($habitaciones as $h) {
                if (!in_array($h, $ocupadas)) {
                    $habitacion = $h;
                    break;
                }
            }
        } else {
            foreach (array_reverse($habitaciones) as $h) {
                if (!in_array($h, $ocupadas)) {
                    $habitacion = $h;
                    break;
                }
            }
        }

        if (isset($habitacion)) {
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