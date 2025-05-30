<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


require_once __DIR__ . '/db.php';

// Leer todas las reservas desde la base de datos
$reservas = [];
$sql = "SELECT * FROM reservas ORDER BY numero_habitacion ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservas[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/panel.css" rel="stylesheet" />
</head>
<body>

<!-- Sidebar + Main Content -->
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3 bg-dark text-white" style="min-height: 100vh; width: 250px;">
        <h4 class="text-center">ADMINISTRADOR</h4>
        <ul class="list-unstyled">
            <li><a href="panel.php" class="d-block py-2 text-white"><i class="fas fa-table"></i> Panel</a></li>
            <li><a href="rooms.php" class="d-block py-2 text-white"><i class="fas fa-door-open"></i> Habitaciones</a></li>
            <a href="panel.php" class="btn btn-primary">Ver Panel</a>
            <a href="actualizar_cargos.php" class="btn btn-warning">Actualizar Cargos</a>
            <a href="salida_cliente.php" class="btn btn-danger">Registrar Salida</a>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center mb-4">
            <h5>Panel de Administración</h5>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['username'] ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Reservas Totales</h5>
                        <p class="card-text"><?= count($reservas); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Reservas -->
        <div class="card mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title m-0">Reservas</h5>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarModal">Agregar Huésped</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Hab.</th>
                                <th>Nombre</th>
                                <th>NIT</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Fecha Registro</th>
                                <th>Total a Pagar</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reservas)): ?>
                                <?php foreach ($reservas as $r): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['numero_habitacion']) ?></td>
                                        <td><?= htmlspecialchars($r['nombre']) ?></td>
                                        <td><?= htmlspecialchars($r['nit']) ?></td>
                                        <td><?= htmlspecialchars($r['telefono']) ?></td>
                                        <td><?= htmlspecialchars($r['email']) ?></td>
                                        <td><?= htmlspecialchars($r['fecha_registro']) ?></td>
                                        <td>Q.<?= number_format($r['total_a_pagar'], 2) ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#actualizarModal<?= $r['id'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#salidaModal<?= $r['id'] ?>">
                                                <i class="fas fa-sign-out-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Actualizar Cargos -->
                                    <div class="modal fade" id="actualizarModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form action="actualizar_cargos.php" method="POST">
                                                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                                <input type="hidden" name="habitacion" value="<?= $r['numero_habitacion'] ?>">

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Actualizar Cargos - <?= $r['nombre'] ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label for="desayuno" class="form-label">Desayuno (Q.30)</label>
                                                                <input type="number" name="desayuno" class="form-control" min="0" value="<?= $r['desayuno'] ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="almuerzo" class="form-label">Almuerzo (Q.65)</label>
                                                                <input type="number" name="almuerzo" class="form-control" min="0" value="<?= $r['almuerzo'] ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="cena" class="form-label">Cena (Q.75)</label>
                                                                <input type="number" name="cena" class="form-control" min="0" value="<?= $r['cena'] ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="spa" class="form-label">Spa (Q.300)</label>
                                                                <input type="number" name="spa" class="form-control" min="0" value="<?= $r['spa'] ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="masaje" class="form-label">Masaje (Q.150)</label>
                                                                <input type="number" name="masaje" class="form-control" min="0" value="<?= $r['masaje'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal Salida Cliente -->
                                    <div class="modal fade" id="salidaModal<?= $r['id'] ?>" tabindex="-1" aria-labelledby="salidaLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="salida_cliente.php" method="POST">
                                                <input type="hidden" name="habitacion" value="<?= $r['numero_habitacion'] ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Registrar Salida - <?= $r['nombre'] ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro que desea registrar la salida del cliente?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Sí, Registrar Salida</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No hay reservas registradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Huésped -->
<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="agregar_usuario.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Huésped</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nit" class="form-label">NIT</label>
                            <input type="text" name="nit" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                            <input type="date" name="fecha_registro" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="desayuno" class="form-label">Desayuno (Q.30.00)</label>
                            <input type="number" name="desayuno" class="form-control" placeholder="Cantidad">
                        </div>
                        <div class="col-md-6">
                            <label for="almuerzo" class="form-label">Almuerzo (Q.65.00)</label>
                            <input type="number" name="almuerzo" class="form-control" placeholder="Cantidad">
                        </div>
                        <div class="col-md-6">
                            <label for="cena" class="form-label">Cena (Q.75.00)</label>
                            <input type="number" name="cena" class="form-control" placeholder="Cantidad">
                        </div>
                        <div class="col-md-6">
                            <label for="spa" class="form-label">Spa (Q.300.00)</label>
                            <input type="number" name="spa" class="form-control" placeholder="Cantidad">
                        </div>
                        <div class="col-md-6">
                            <label for="masaje" class="form-label">Masaje (Q.150.00)</label>
                            <input type="number" name="masaje" class="form-control" placeholder="Cantidad">
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

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 

</body>
</html>