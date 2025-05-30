<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/db.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitacion = intval($_POST['habitacion']);

    // Eliminar reserva
    $stmt = $conn->prepare("DELETE FROM reservas WHERE numero_habitacion = ?");
    $stmt->bind_param("i", $habitacion);

    if ($stmt->execute()) {
        $success = "✅ Salida registrada. La habitación está disponible nuevamente.";
    } else {
        $error = "❌ Error al registrar la salida.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Salida de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="text-center mb-4">Registrar Salida de Huésped</h2>

<?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

<form method="post">
    <div class="mb-3">
        <label for="habitacion" class="form-label">Número de Habitación</label>
        <select name="habitacion" id="habitacion" class="form-select" required>
            <option value="">Seleccione una habitación</option>
            <?php
            $conn_modal = new mysqli("mysql-db", "user_hotel", "hotel123", "Hotel_Paraiso", 3306);
            $result = $conn_modal->query("SELECT * FROM reservas");

            while ($row = $result->fetch_assoc()):
            ?>
                <option value="<?= $row['numero_habitacion'] ?>">
                    Hab. <?= $row['numero_habitacion'] ?> - <?= htmlspecialchars($row['nombre']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-danger">Registrar Salida</button>
</form>

<a href="panel.php" class="btn btn-secondary mt-3">Volver al Panel</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>