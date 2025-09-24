<?php
require_once __DIR__ . '/../Modelo/ModuloCliente/ClienteService.php';

$servicio = new ClienteService();
$mensaje = "";

// Procesar las peticiones del mismo archivo
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["_action"])) {
        switch ($_POST["_action"]) {
            case "agregar":
                $res = $servicio->agregarCliente(
                    $_POST["nombre"],
                    $_POST["apellido"],
                    $_POST["contrasena"],
                    $_POST["direccion"],
                    $_POST["telefono"],
                    $_POST["correo_electronico"]
                );
                $mensaje = $res["success"] ? "Cliente agregado correctamente." : "Error al agregar: " . $res["error"];
                break;

            case "actualizar":
                $res = $servicio->actualizarCliente(
                    $_POST["id"],
                    $_POST["nombre"],
                    $_POST["apellido"],
                    $_POST["contrasena"],
                    $_POST["direccion"],
                    $_POST["telefono"],
                    $_POST["correo_electronico"]
                );
                $mensaje = $res["success"] ? "Cliente actualizado correctamente." : "Error al actualizar: " . $res["error"];
                break;

            case "eliminar":
                $res = $servicio->eliminarCliente($_POST["id"]);
                $mensaje = $res["success"] ? "Cliente eliminado correctamente." : "Error al eliminar: " . $res["error"];
                break;
        }
    }
}

$clientes = $servicio->obtenerClientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>

    <p style="color:blue;"><?= $mensaje ?></p>

    <?php if (is_array($clientes)): ?>
        <ul>
    <?php foreach ($clientes as $cliente): ?>
        <li>
            <?= $cliente["id_cliente"] . " - " . $cliente["nombre"] . " - " . $cliente["correo_electronico"] ?>
        </li>
    <?php endforeach; ?>
</ul>
    <?php else: ?>
        <p style="color:red;">No se encontraron clientes.</p>
    <?php endif; ?>

    <h2>Agregar nuevo cliente</h2>
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

        <input type="submit" value="Agregar Cliente">
    </form>

    <h2>Actualizar cliente</h2>
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

        <input type="submit" value="Actualizar Cliente">
    </form>

    <h2>Eliminar cliente</h2>
    <form method="POST">
        <input type="hidden" name="_action" value="eliminar">
        <label>ID:</label><br>
        <input type="number" name="id" required><br><br>

        <input type="submit" value="Eliminar Cliente">
    </form>
</body>
</html>
