<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Leer reservas desde el archivo
$reservas = [];
if (file_exists('reservas.txt')) {
    $lines = file('reservas.txt', FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $reservas[] = explode('|', $line);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css " rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/panel.css" rel="stylesheet" />
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3 bg-light" style="width: 220px;">
            <h4 class="text-center">ADMINISTRADOR</h4>
            <ul class="list-unstyled">
                <li><a href="panel.php" class="d-block py-2"><i class="fas fa-table"></i> Tables</a></li>
                <li><a href="rooms.php" class="d-block py-2"><i class="fas fa-bed"></i> Habitaciones</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center mb-4">
                <h5>Panel de Administración</h5>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= htmlspecialchars($_SESSION['username']) ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Reservas Totales</h5>
                            <p class="card-text"><?= count($reservas); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservations Table -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-center">Reservas</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Fecha</th>
                                    <th>Habitación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reservas)): ?>
                                    <?php foreach ($reservas as $reserva): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($reserva[0]); ?></td>
                                            <td><?= htmlspecialchars($reserva[1]); ?></td>
                                            <td><?= htmlspecialchars($reserva[2]); ?></td>
                                            <td><?= htmlspecialchars($reserva[3]); ?></td>
                                            <td><?= htmlspecialchars($reserva[4]); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No hay reservas.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-center">Gráfica de Ganancias</h5>
                    <canvas id="myChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js "></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
                datasets: [{
                    label: 'Ganancias',
                    data: [5000, 10000, 15000, 20000, 25000, 30000, 40000],
                    borderColor: 'rgba(78, 115, 223, 1)',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>