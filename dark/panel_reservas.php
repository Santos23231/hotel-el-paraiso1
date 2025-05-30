<?php
$mysqli = new mysqli("localhost", "root", "TU_CONTRASEÑA", "Hotel");
$result = $mysqli->query("SELECT c.id_control, h.nombre, c.id_habitacion, c.fecha_inicio, c.fecha_fin, c.estado 
    FROM Control_hospedaje c 
    JOIN Huesped h ON c.id_huesped = h.id_huesped
    ORDER BY c.fecha_inicio DESC");
echo "<table border='1'><tr><th>ID</th><th>Huésped</th><th>Habitación</th><th>Inicio</th><th>Fin</th><th>Estado</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id_control']}</td>
        <td>{$row['nombre']}</td>
        <td>{$row['id_habitacion']}</td>
        <td>{$row['fecha_inicio']}</td>
        <td>{$row['fecha_fin']}</td>
        <td>{$row['estado']}</td>
    </tr>";
}
echo "</table>";
?>