<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vendedores</title>
</head>
<body>
    <h1>Lista de Vendedores</h1>

    <p style="color:blue;"><?= $mensaje ?></p>

    <?php if (is_array($vendedores)): ?>
        <ul>
    <?php foreach ($vendedores as $vendedor): ?>
        <li>
            <?= $vendedor["id_vendedor"] . " - " . $vendedor["nombre"] . " - " . $vendedor["correo_electronico"] ?>
        </li>
    <?php endforeach; ?>
</ul>
    <?php else: ?>
        <p style="color:red;">No se encontraron vendedores.</p>
    <?php endif; ?>

    <h2>Agregar nuevo vendedor</h2>
    <form method="POST">
        <input type="hidden" name="_action" value="agregar">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>

        <label>Dirección:</label><br>
        <input type="text" name="direccion" required><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" required><br><br>

        <label>Correo electrónico:</label><br>
        <input type="email" name="correo_electronico" required><br><br>

        <input type="submit" value="Agregar Vendedor">
    </form>

    <h2>Actualizar vendedor</h2>
    <form method="POST">
        <input type="hidden" name="_action" value="actualizar">
        <label>ID:</label><br>
        <input type="number" name="id" required><br><br>

        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>

        <label>Dirección:</label><br>
        <input type="text" name="direccion" required><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" required><br><br>

        <label>Correo electrónico:</label><br>
        <input type="email" name="correo_electronico" required><br><br>

        <input type="submit" value="Actualizar Vendedor">
    </form>

    <h2>Eliminar vendedor</h2>
    <form method="POST">
        <input type="hidden" name="_action" value="eliminar">
        <label>ID:</label><br>
        <input type="number" name="id" required><br><br>

        <input type="submit" value="Eliminar Vendedor">
    </form>
</body>
</html>