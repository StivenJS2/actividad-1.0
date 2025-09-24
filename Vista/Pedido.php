<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
</head>
<body>
    <h1>Lista de Pedidos</h1>

    <p style="color:blue;"><?= $mensaje ?></p>

    <?php if (is_array($pedidos) && isset($pedidos["data"])): ?>
        <ul>
            <?php foreach ($pedidos["data"] as $pedido): ?>
                <li>
                    <?= 
                        "ID Pedido: " . $pedido["id_pedido"] . 
                        " - ID Cliente: " . $pedido["id_cliente"] . 
                        " - Fecha: " . $pedido["fecha_pedido"] . 
                        " - Total: " . $pedido["total"] . 
                        " - Estado: " . $pedido["estado"] 
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p style="color:red;">No se encontraron pedidos.</p>
    <?php endif; ?>

    <h2>Agregar nuevo pedido</h2>
    <form method="POST">
        <input type="hidden" name="_action" value="agregar">

        <label>ID Cliente:</label><br>
        <input type="number" name="id_cliente" required><br><br>

        <label>Fecha Pedido:</label><br>
        <input type="date" name="fecha_pedido" required><br><br>

        <label>Total:</label><br>
        <input type="number" step="0.01" name="total" required><br><br>

        <label>Estado:</label><br>
        <input type="text" name="estado" required><br><br>

        <input type="submit" value="Agregar Pedido">
    </form>

    <h2>Actualizar pedido</h2>
    <form method="POST">
        <input type="hidden" name="_action" value="actualizar">

        <label>ID Pedido:</label><br>
        <input type="number" name="id_pedido" required><br><br>

        <label>ID Cliente:</label><br>
        <input type="number" name="id_cliente" required><br><br>

        <label>Fecha Pedido:</label><br>
        <input type="date" name="fecha_pedido" required><br><br>

        <label>Total:</label><br>
        <input type="number" step="0.01" name="total" required><br><br>

        <label>Estado:</label><br>
        <input type="text" name="estado" required><br><br>

        <input type="submit" value="Actualizar Pedido">
    </form>

    <h2>Eliminar pedido</h2>
    <form method="POST">
        <input type="hidden" name="_action" value="eliminar">

        <label>ID Pedido:</label><br>
        <input type="number" name="id_pedido" required><br><br>

        <input type="submit" value="Eliminar Pedido">
    </form>
</body>
</html>
