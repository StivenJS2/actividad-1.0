<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Carritos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/carrito.css"> 
    <script src="js/carrito.js"></script>
</head>
<body>

<div class="sidebar d-flex flex-column bg-dark text-white p-3">
    <h4 class="text-center mb-4">Menú</h4>

    <div class="d-grid gap-3 flex-grow-1">
        <button class="btn btn-primary" onclick="mostrarSeccion('ver')">📋 Ver Carritos</button>
        <button class="btn btn-success" onclick="mostrarSeccion('crear')">➕ Agregar Carrito</button>
        <button class="btn btn-warning text-white" onclick="mostrarSeccion('actualizar')">✏️ Actualizar Carrito</button>
        <button class="btn btn-danger" onclick="mostrarSeccion('eliminar')">🗑️ Eliminar Carrito</button>


        <div class="mt-auto">
        <a href="index.php" class="btn btn-secondary w-100">⬅️ Volver al Menú</a>
            </div>
    </div>
</div>


    
<div class="contenido flex-grow-1 p-4">
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center"><?= $mensaje ?></div>
        <?php endif; ?>

        <div id="seccion-ver" class="seccion">
            <h2>Lista de Carritoss</h2>
            <?php if (is_array($carritos)): ?>
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>id_cliente</th>
                            <th>id_Detalleproducto</th>
                            <th>cantidad</th>
                            <th>precio_unitario</th>
                            <th>subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carritos as $carrito): ?>
                            <tr>
                                <td><?= $carrito["id_carrito"] ?></td>
                                <td><?= $carrito["id_cliente"] ?></td>
                                <td><?= $carrito["id_detalle_producto"] ?></td>
                                <td><?= $carrito["cantidad"] ?></td>
                                <td><?= $carrito["precio_unitario"] ?></td>
                                <td><?= $carrito["subtotal"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-danger">No se encontraron clientes.</p>
    <?php endif; ?>
</div>


      
<div id="seccion-crear" class="seccion d-none">
    <div class="card">
         <div class="card-header bg-success text-white">Agregar Carrito</div>
            <div class="card-body">

                 <form method="POST">
                        <input type="hidden" name="_action" value="agregar">

                        <div class="mb-3">
                            <label class="form-label">id_cliente</label>
                            <input type="text" name="id_cliente" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">id_Detalleproducto</label>
                            <input type="text" name="id_Detalleproducto" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">cantidad</label>
                            <input type="number" name="cantidad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">precio_unitario</label>
                            <input type="text" name="precio_unitario    " class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">subtotal</label>
                            <input type="text" name="subtotal" class="form-control" required>
                        </div>

                <button type="submit" class="btn btn-success">Agregar Carrito</button>
            </form>
        </div>
    </div>
</div>


<div id="seccion-eliminar" class="seccion d-none">
    <div class="card">
            <div class="card-header bg-danger text-white">Eliminar Carrito</div>
                <div class="card-body">
                    <form method="POST">

                        <input type="hidden" name="_action" value="eliminar">

                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="number" name="id_carrito" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Eliminar Carrito</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>