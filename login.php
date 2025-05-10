<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Aquí puedes agregar la lógica para validar el usuario y la contraseña
    if ($username === 'admin' && $password === '2024605') {
        
        header("Location: admin/panel.php");
        exit();
    } else {
        // Credenciales incorrectas
        echo "Usuario o contraseña incorrectos.";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <form class="mt-4" id="loginForm" method="post">

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
            <!-- Contraseña -->
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

            <!-- Mensaje de error -->
            <div id="errorMessage" class="text-danger mb-3" style="display: none;">
                Usuario o contraseña incorrectos.
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>