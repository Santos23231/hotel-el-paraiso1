<form action="guardar_reserva.php" method="POST">
    Nombre: <input type="text" name="nombre" required><br>
    Fecha de nacimiento: <input type="date" name="fechanac"><br>
    Correo: <input type="email" name="correo"><br>
    Teléfono: <input type="text" name="telefono"><br>
    Habitación (ID): <input type="number" name="id_habitacion" required><br>
    Fecha inicio: <input type="date" name="fecha_inicio" required><br>
    Fecha fin: <input type="date" name="fecha_fin" required><br>
    <input type="submit" value="Reservar">
</form>