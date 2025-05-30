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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/panel.css" rel="stylesheet" />
</head>
<body>
    
        <div class="d-flex">
        <div class="sidebar p-3">
            <h4 class="text-center">ADMINISTRADOR</h4>
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
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Reservas Totales</h5>
                        <p class="card-text"><?php echo count($reservas); ?></p>    
                    </div>
                </div>  
            </div>
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
            <!-- Apartado para agregar cargos a habitaciones -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title text-center">Agregar Cargo a Habitación</h5>
                    <form action="agregar_cargo.php" method="POST" class="row g-3">
                        <div class="col-md-4">
                            <label for="habitacion" class="form-label">Habitación</label>
                            <select name="habitacion" id="habitacion" class="form-select" required>
                                <option value="">Selecciona una habitación</option>
                                <?php foreach ($reservas as $reserva): ?>
                                    <option value="<?php echo htmlspecialchars($reserva[4]); ?>">
                                        <?php echo htmlspecialchars($reserva[4]); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="concepto" class="form-label">Concepto</label>
                            <input type="text" name="concepto" id="concepto" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="number" name="monto" id="monto" class="form-control" step="0.01" min="0" required>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success mt-2">Agregar Cargo</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Fin apartado cargos -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>