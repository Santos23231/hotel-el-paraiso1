<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$reservas = [];
if (file_exists('reservas.txt')) {
    $lines = file('reservas.txt', FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $reservas[] = explode('|', $line);
    }
}

$reservas = [];
if (file_exists('reservas.txt')) {
    $lines = file('reservas.txt', FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $data = explode('|', $line);
        // $data[4] es el número de habitación
        $reservas[$data[4]] = $data;
    }
}

$total_habitaciones = 8;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3">
            <h4 class="text-center">SB Admin</h4>
            <ul class="list-unstyled">
                
                <li><a href="panel.php" class="d-block py-2"><i class="fas fa-table"></i> Tables</a></li>
                <li><a href="rooms.php" class="d-block py-2"><i class="fas fa-user"></i> Habitaciones</a></li>
                
            </ul>
        </div>
        
        <div class="flex-grow-1">
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
            <div class="container mt-4">
                <h2 class="text-center mb-4">Habitaciones</h2>
                <div class="row">
                    <?php for ($i = 1; $i <= $total_habitaciones; $i++): ?>
                        <div class="col-md-3 mb-4">
                            <?php if (isset($reservas[$i])): ?>
                                <div class="card text-white bg-danger h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Hab. <?php echo $i; ?> - Ocupada</h5>
                                        <p><strong>Huésped:</strong> <?php echo htmlspecialchars($reservas[$i][0]); ?></p>
                                        <p><strong>Total a pagar:</strong> Q.<?php echo htmlspecialchars($reservas[$i][5]); ?></p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="card text-white bg-success h-100">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Hab. <?php echo $i; ?> - Disponible</h5>
                                        <p>Habitación disponible</p>
                                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal<?php echo $i; ?>">
                                            Agregar usuario
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" id="agregarUsuarioModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="agregarUsuarioModal<?php echo $i; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="agregar_usuario.php" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="agregarUsuarioModal<?php echo $i; ?>Label">Agregar usuario a Hab. <?php echo $i; ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="habitacion" value="">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre del huésped</label>
                                                        <input type="text" class="form-control" name="nombre" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">NIT</label>
                                                        <input type="text" class="form-control" name="nit" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Fecha de nacimiento</label>
                                                        <input type="date" class="form-control" name="fecha_nacimiento" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Fecha de registro</label>
                                                        <input type="date" class="form-control" name="fecha_registro" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Total a pagar</label>
                                                        <input type="number" class="form-control" name="total" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Teléfono</label>
                                                        <input type="text" class="form-control" name="telefono" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Correo electrónico</label>
                                                        <input type="email" class="form-control" name="correo" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Dirección</label>
                                                        <input type="text" class="form-control" name="direccion" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Género</label>
                                                        <select class="form-control" name="genero" required>
                                                            <option value="">Seleccione</option>
                                                            <option value="M">Masculino</option>
                                                            <option value="F">Femenino</option>
                                                            <option value="O">Otro</option>
                                                        </select>
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
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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