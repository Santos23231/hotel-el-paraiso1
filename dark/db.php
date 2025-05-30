<?php

$host = 'mysql-db';
$dbname = 'Hotel_Paraiso';
$user = 'user_hotel';
$password = 'hotel123';
$port = 3306;

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,     // Establece el modo de obtención predeterminado a asociativo
    PDO::ATTR_EMULATE_PREPARES   => false,                // Deshabilita la emulación de sentencias preparadas para mayor seguridad
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
    echo "¡Conexión a la base de datos exitosa!";

    // Aquí puedes realizar tus operaciones con la base de datos
    // Por ejemplo, una consulta SELECT:
    // $stmt = $pdo->query("SELECT * FROM tu_tabla");
    // while ($row = $stmt->fetch()) {
    //     echo $row['nombre_columna'] . "<br>";
    // }

} catch (PDOException $e) {
    // Manejo de errores: Registra el error y muestra un mensaje amigable al usuario
    // En un entorno de producción, nunca muestres el error directamente al usuario
    error_log("Error de conexión a la base de datos: " . $e->getMessage());
    die("Lo sentimos, no pudimos conectar con la base de datos en este momento. Por favor, inténtelo de nuevo más tarde.");
}

// Opcional: Cerrar la conexión (no siempre es necesario con PDO, ya que se cierra automáticamente al finalizar el script)
$pdo = null;

?>