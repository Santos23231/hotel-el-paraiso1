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
    
        <!-- Sidebar -->
        <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-center">ADMINISTRADOR</h4>
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
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Reservas Totales</h5>
                        <p class="card-text"><?php echo count($reservas); ?></p>    
                    </div>
                </div>  
            </div>
            <!-- Reservations Table -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-center">Reservas</h5>
                    <div class="d-flex justify-content-center"> <!-- Añadido para centrar -->
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
                                                <td><?php echo htmlspecialchars($reserva[0]); ?></td>
                                                <td><?php echo htmlspecialchars($reserva[1]); ?></td>
                                                <td><?php echo htmlspecialchars($reserva[2]); ?></td>
                                                <td><?php echo htmlspecialchars($reserva[3]); ?></td>
                                                <td><?php echo htmlspecialchars($reserva[4]); ?></td>
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
            </div>
        </div>
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