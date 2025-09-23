<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>

    <?= $mensaje ?? '' ?>

    <?php if (is_array($clientes)): ?>
        <ul>
            <?php foreach ($clientes as $clientes): ?>
                <li>
                    <?= htmlspecialchars($clientes['nombre']) . " " . htmlspecialchars($clientes['apellido']) ?>
                    - <?= htmlspecialchars($clientes['correo_electronico']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p style="color:red;">No se encontraron clientes.</p>
    <?php endif; ?>

    <h2>Agregar nuevo cliente</h2>

    <form method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" required><br><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" name="apellido" id="apellido" required><br><br>

        <label for="contrasena">Contraseña:</label><br>
        <input type="password" name="contrasena" id="contrasena" required><br><br>

        <label for="direccion">Dirección:</label><br>
        <input type="text" name="direccion" id="direccion" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" name="telefono" id="telefono" required><br><br>

        <label for="correo_electronico">Correo electrónico:</label><br>
        <input type="email" name="correo_electronico" id="correo_electronico" required><br><br>

        <input type="submit" value="Agregar Cliente">
    </form>
</body>
</html>