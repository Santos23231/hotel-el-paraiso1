<?php
session_start();


require_once __DIR__ . '/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['username'];
    $contrasena = $_POST['password'];

    $sql = "SELECT * FROM Usuarios WHERE nombre_usuario = '$usuario' AND contrasena = '$contrasena'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows == 1) {
        // Usuario autenticado
        $_SESSION['username'] = $usuario;
        header("Location: panel.php"); 
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
        .login-container h2 { text-align: center; margin-bottom: 20px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 8px 0 15px; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Iniciar Sesión</h2>
    
    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>