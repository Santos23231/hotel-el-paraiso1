<?php
session_start();

// Usuarios quemados
$users = [
 // Usuario administrador
    'user' => 'admin'    // Usuario normal
];

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validar credenciales
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;
        header("Location: panel.php");
        exit();
    } else {
        $errorMessage = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Iniciar Sesión</h2>
        </div>
        <form id="loginForm" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="username" 
                    name="username" 
                    placeholder="Ingresa tu usuario" 
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password" 
                    name="password" 
                    placeholder="Ingresa tu contraseña" 
                    required>
            </div>
            <?php if (!empty($errorMessage)): ?>
                <div class="text-danger mb-3">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>