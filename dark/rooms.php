<?php
session_start();

// Verificar autenticación
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Incluir conexión a la base de datos
require_once __DIR__ . '/db.php';

// Leer todas las reservas desde la base de datos
$reservas = [];
$sql = "SELECT * FROM reservas";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservas[$row['numero_habitacion']] = $row;
    }
}

$conn->close();

// Número total de habitaciones
$total_habitaciones = 8;

// Orden de habitaciones: las más cerca de la salida son las menores (ej. 1, 2, 3...)
$habitaciones_ordenadas = range(1, $total_habitaciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Habitaciones - Hotel El Paraíso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .room-card {
            border-radius: 10px;
            transition: transform 0.3s ease;
            height: 100%;
        }

        .room-card:hover {
            transform: scale(1.03);
        }

        .room-title {
            font-size: 1.2rem;
        }

        .room-content {
            font-size: 0.95rem;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
        <h4 class="text-center">Hotel El Paraíso</h4>
        <ul class="list-unstyled mt-4">
            <li><a href="panel.php" class="text-white d-block py-2"><i class="fas fa-table"></i> Panel</a></li>
            <li><a href="rooms.php" class="text-white d-block py-2 active"><i class="fas fa-door-open"></i> Habitaciones</a></li>
            <li><a href="logout.php" class="text-white d-block py-2"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
        <header class="mb-4">
            <h2 class="text-center">Habitaciones</h2>
            <p class="text-center text-muted">Asigne o consulte el estado de cada habitación</p>
        </header>

        <div class="row g-4 justify-content-center">
            <?php foreach ($habitaciones_ordenadas as $num): ?>
                <div class="col-md-3">
                    <?php if (isset($reservas[$num])): ?>
                        <!-- Habitación ocupada -->
                        <div class="card room-card text-white bg-danger h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title room-title">Hab. <?= $num ?></h5>
                                <p class="card-text room-content"><strong>Huésped:</strong> <?= htmlspecialchars($reservas[$num]['nombre']) ?></p>
                                <p class="card-text room-content"><strong>Total a pagar:</strong> Q.<?= number_format($reservas[$num]['total_a_pagar'], 2) ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Habitación disponible -->
                        <div class="card room-card text-white bg-success h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title room-title">Hab. <?= $num ?></h5>
                                <p class="card-text room-content">Disponible</p>
                                <button class="btn btn-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal<?= $num ?>">
                                    Asignar Huésped
                                </button>
                            </div>
                        </div>

                        <!-- Modal para asignar huésped -->
                        <div class="modal fade" id="agregarUsuarioModal<?= $num ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="agregar_usuario.php" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Asignar Huésped - Hab. <?= $num ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="habitacion" value="<?= $num ?>">

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="nombre" class="form-label">Nombre Completo</label>
                                                    <input type="text" class="form-control" name="nombre" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nit" class="form-label">NIT</label>
                                                    <input type="text" class="form-control" name="nit" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                                    <input type="date" class="form-control" name="fecha_nacimiento" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                                                    <input type="date" class="form-control" name="fecha_registro" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="telefono" class="form-label">Teléfono</label>
                                                    <input type="text" class="form-control" name="telefono">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="desayuno" class="form-label">Desayuno</label>
                                                    <input type="number" class="form-control" name="desayuno" placeholder="Cantidad">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="almuerzo" class="form-label">Almuerzo</label>
                                                    <input type="number" class="form-control" name="almuerzo" placeholder="Cantidad">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cena" class="form-label">Cena</label>
                                                    <input type="number" class="form-control" name="cena" placeholder="Cantidad">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="spa" class="form-label">Spa</label>
                                                    <input type="number" class="form-control" name="spa" placeholder="Cantidad">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="masaje" class="form-label">Masaje</label>
                                                    <input type="number" class="form-control" name="masaje" placeholder="Cantidad">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2025 Hotel El Paraíso | Técnico en Desarrollo de Software - Universidad Mesoamericana</p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>