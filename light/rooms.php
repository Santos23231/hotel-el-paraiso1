<?php
session_start();

// Verificar si el usuario está autenticado
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/panel.css" rel="stylesheet" />
    <!-- Custom CSS -->
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-center">SB Admin</h4>
            <ul class="list-unstyled">
                
                <li><a href="panel.php" class="d-block py-2"><i class="fas fa-table"></i> Tables</a></li>
                <li><a href="rooms.php" class="d-block py-2"><i class="fas fa-user"></i> Habitaciones</a></li>
                
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5>Panel de Administración</h5>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuario
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                    </ul>
                </div>
            </div>
            <!-- Rooms Section -->
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title text-center">Habitaciones</h5>
        <div class="row g-3 justify-content-center">
            <?php
            // Simulación de habitaciones (puedes reemplazar esto por consulta a BD)
            $habitaciones = [
                ['id' => 1, 'estado' => 'disponible', 'nombre' => '', 'total' => 0],
                ['id' => 2, 'estado' => 'ocupada', 'nombre' => 'Carlos M.', 'total' => 700],
                ['id' => 3, 'estado' => 'disponible', 'nombre' => '', 'total' => 0],
                ['id' => 4, 'estado' => 'ocupada', 'nombre' => 'Ana R.', 'total' => 900],
                ['id' => 5, 'estado' => 'disponible', 'nombre' => '', 'total' => 0],
                ['id' => 6, 'estado' => 'disponible', 'nombre' => '', 'total' => 0],
                ['id' => 7, 'estado' => 'ocupada', 'nombre' => 'Jorge L.', 'total' => 1050],
                ['id' => 8, 'estado' => 'disponible', 'nombre' => '', 'total' => 0],
            ];

            foreach ($habitaciones as $hab):
                $bgColor = ($hab['estado'] === 'disponible') ? 'bg-success' : 'bg-danger';
                $textColor = 'text-white';
                ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card shadow-sm border-0 rounded-3 h-100">
                        <div class="card-header <?= $bgColor ?> <?= $textColor ?> text-center">
                            <strong>Hab. <?= $hab['id'] ?></strong> - <?= ucfirst($hab['estado']) ?>
                        </div>
                        <div class="card-body text-center">
                            <?php if ($hab['estado'] === 'ocupada'): ?>
                                <p><strong>Huésped:</strong> <?= htmlspecialchars($hab['nombre']) ?></p>
                                <p><strong>Total a pagar:</strong> Q.<?= number_format($hab['total'], 2) ?></p>
                            <?php else: ?>
                                <p class="text-muted">Habitación disponible</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
            
            <!-- Reservations Table -->
            
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js Example
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