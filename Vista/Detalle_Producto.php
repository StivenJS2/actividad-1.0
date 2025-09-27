<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Detalles de Producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/detalle_producto.css"> 
    <script src="js/detalle_producto.js"></script>
</head>
<body>

<div class="sidebar d-flex flex-column bg-dark text-white p-3">
    <h4 class="text-center mb-4">Menú</h4>

    <div class="d-grid gap-3 flex-grow-1">
        <button class="btn btn-primary" onclick="mostrarSeccion('ver')">Detalles Producto</button>
        <button class="btn btn-success" onclick="mostrarSeccion('crear')">Agregar</button>
        <button class="btn btn-warning text-white" onclick="mostrarSeccion('actualizar')">Actualizar</button>
        <button class="btn btn-danger" onclick="mostrarSeccion('eliminar')">Eliminar</button>

        <div class="mt-auto">
            <a href="index.php" class="btn btn-secondary w-100">Volver al Menú</a>
        </div>
    </div>
</div>


<div class="contenido flex-grow-1 p-4">
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-info text-center"><?= $mensaje ?></div>
    <?php endif; ?>

    <!-- GET -->
    <div id="seccion-ver" class="seccion">

        <h2>Lista de Detalles de Producto</h2>

        <?php if (is_array($detalles_producto)): ?>
            <table class="table table-striped table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID Detalle</th>
                        <th>Talla</th>
                        <th>Color</th>
                        <th>ID Producto</th>
                        <th>ID Categoría</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles_producto as $detalle): ?>
                        <tr>
                            <td><?= $detalle["id_detalle_producto"] ?></td>
                            <td><?= $detalle["talla"] ?></td>
                            <td><?= $detalle["color"] ?></td>
                            <td><?= $detalle["id_producto"] ?></td>
                            <td><?= $detalle["id_categoria"] ?></td>
                            <td>$<?= number_format($detalle["precio"], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="text-danger">No se encontraron detalles de producto.</p>
        <?php endif; ?>

    </div>


    <!-- POST -->
    <div id="seccion-crear" class="seccion d-none">

        <div class="card">
            <div class="card-header bg-success text-white">Agregar Detalle de Producto</div>

            <div class="card-body">

                <form method="POST">
                    <input type="hidden" name="_action" value="agregar">

                    <div class="mb-3">
                        <label class="form-label">Talla</label>
                        <select name="talla" class="form-control" required>
                            <option value="">Selecciona una talla</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-control" required placeholder="Ej: Azul, Rojo, Verde">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID Producto</label>
                        <input type="number" name="id_producto" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID Categoría</label>
                        <input type="number" name="id_categoria" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" required placeholder="0.00">
                    </div>

                    <button type="submit" class="btn btn-success">Agregar Detalle</button>
                </form>
            </div>
        </div>
    </div>


    <!-- PUT -->
    <div id="seccion-actualizar" class="seccion d-none">
        <div class="card">
            <div class="card-header bg-warning text-white">Actualizar Detalle de Producto</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="_action" value="actualizar">

                    <div class="mb-3">
                        <label class="form-label">ID Detalle Producto</label>
                        <input type="number" name="id_detalle_producto" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Talla</label>
                        <select name="talla" class="form-control" required>
                            <option value="">Selecciona una talla</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-control" required placeholder="Ej: Azul, Rojo, Verde">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID Producto</label>
                        <input type="number" name="id_producto" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ID Categoría</label>
                        <input type="number" name="id_categoria" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" required placeholder="0.00">
                    </div>

                    <button type="submit" class="btn btn-warning text-white">Actualizar Detalle</button>
                </form>
            </div>
        </div>
    </div>


    <!-- DELETE -->
    <div id="seccion-eliminar" class="seccion d-none">
        <div class="card">
            <div class="card-header bg-danger text-white">Eliminar Detalle de Producto</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="_action" value="eliminar">

                    <div class="mb-3">
                        <label class="form-label">ID Detalle Producto</label>
                        <input type="number" name="id_detalle_producto" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger">Eliminar Detalle</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>