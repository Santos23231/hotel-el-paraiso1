<?php
$habitacion = isset($_GET['habitacion']) ? intval($_GET['habitacion']) : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva Confirmada</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            <h2>¡Reserva realizada con éxito!</h2>
            <?php if ($habitacion): ?>
                <p>Tu habitación asignada es la número <strong><?php echo $habitacion; ?></strong>.</p>
                <a href="plano_habitaciones.php" class="btn btn-primary mt-3">Ver ubicación en el plano</a>
            <?php else: ?>
                <p>No se pudo asignar una habitación.</p>
            <?php endif; ?>
            <a href="index.php" class="btn btn-secondary mt-3">Volver al inicio</a>
        </div>
    </div>
</body>
</html>