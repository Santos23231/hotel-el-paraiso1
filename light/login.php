<?php
session_start();
require_once 'db.php';

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Usuarios WHERE nombre_usuario = ?");
            $stmt->execute([$username]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && $password === $usuario['contrasena']) {
                $_SESSION['username'] = $usuario['nombre_usuario'];
                header("Location: panel.php");
                exit();
            } else {
                $errorMessage = "Usuario o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Error en la base de datos: " . $e->getMessage();
        }
    } else {
        $errorMessage = "Por favor, completa ambos campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Hotel Paraíso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>HOTEL PARAÍSO</h2>
        <p>Inicia sesión para continuar</p>

        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <?php if (!empty($errorMessage)): ?>
                <div class="text-danger mb-3"><?= $errorMessage ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>