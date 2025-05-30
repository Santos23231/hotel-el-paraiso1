<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once __DIR__ . '/db.php';

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitacion = intval($_POST['habitacion']);
    $desayuno = intval($_POST['desayuno'] ?? 0);
    $almuerzo = intval($_POST['almuerzo'] ?? 0);
    $cena = intval($_POST['cena'] ?? 0);
    $spa = intval($_POST['spa'] ?? 0);
    $masaje = intval($_POST['masaje'] ?? 0);

    // Calcular nuevo total
    $total = ($desayuno * 30) + ($almuerzo * 65) + ($cena * 75) + ($spa * 300) + ($masaje * 150);

    // Actualizar reserva
    $stmt = $conn->prepare("UPDATE reservas SET 
        desayuno = ?, almuerzo = ?, cena = ?, spa = ?, masaje = ?, total_a_pagar = ? WHERE numero_habitacion = ?");

    $stmt->bind_param("iiiiiid", $desayuno, $almuerzo, $cena, $spa, $masaje, $total, $habitacion);

    if ($stmt->execute()) {
        $success = "✅ Cargos actualizados correctamente.";
    } else {
        $error = "❌ Error al actualizar los cargos.";
    }

    $stmt->close();
}

// Leer todas las reservas
$reservas = [];
$sql = "SELECT * FROM reservas";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservas[$row['numero_habitacion']] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Cargos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="text-center mb-4">Actualizar Cargos por Servicios Extras</h2>

<?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

<form method="post" class="mb-4">
    <div class="mb-3">
        <label for="habitacion" class="form-label">Número de Habitación</label>
        <select name="habitacion" id="habitacion" class="form-select" required>
            <option value="">Seleccione una habitación</option>
            <?php foreach ($reservas as $num => $r): ?>
                <option value="<?= $num ?>"><?= "Hab. $num - " . htmlspecialchars($r['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="desayuno" class="form-label">Desayuno (Q.30.00)</label>
            <input type="number" name="desayuno" class="form-control" min="0">
        </div>
        <div class="col-md-6">
            <label for="almuerzo" class="form-label">Almuerzo (Q.65.00)</label>
            <input type="number" name="almuerzo" class="form-control" min="0">
        </div>
        <div class="col-md-6">
            <label for="cena" class="form-label">Cena (Q.75.00)</label>
            <input type="number" name="cena" class="form-control" min="0">
        </div>
        <div class="col-md-6">
            <label for="spa" class="form-label">Spa (Q.300.00)</label>
            <input type="number" name="spa" class="form-control" min="0">
        </div>
        <div class="col-md-6">
            <label for="masaje" class="form-label">Masaje (Q.150.00)</label>
            <input type="number" name="masaje" class="form-control" min="0">
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
</form>

<a href="panel.php" class="btn btn-secondary">Volver al Panel</a>

</body>
</html>