<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pedidos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/pedido.css"> 
    <script src="js/pedido.js"></script>
</head>
<body>

<div class="d-flex">
    
    <div class="sidebar d-flex flex-column bg-dark text-white p-3" style="min-height: 100vh; width: 250px;">
        <h4 class="text-center mb-4">Menú</h4>

        <div class="d-grid gap-3 flex-grow-1">
            <button class="btn btn-primary" onclick="mostrarSeccion('ver')">Pedidos</button>
            <button class="btn btn-success" onclick="mostrarSeccion('crear')">Agregar</button>
            <button class="btn btn-warning text-white" onclick="mostrarSeccion('actualizar')">Actualizar</button>
            <button class="btn btn-danger" onclick="mostrarSeccion('eliminar')">Eliminar</button>

            <div class="mt-auto">
                <a href="index.php" class="btn btn-secondary w-100">Volver al Menú</a>
            </div>
        </div>
    </div>

    
    <div class="contenido flex-grow-1 p-4">

        <h1 class="mb-4">Gestión de Pedidos</h1>

        <p style="color:blue;"><?= $mensaje ?></p>

        
        <div id="seccion-ver" class="seccion">
            <h2>Lista de Pedidos</h2>

            <?php if (is_array($pedidos) && isset($pedidos["data"])): ?>
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Pedido</th>
                            <th>ID Cliente</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos["data"] as $pedido): ?>
                            <tr>
                                <td><?= $pedido["id_pedido"] ?></td>
                                <td><?= $pedido["id_cliente"] ?></td>
                                <td><?= $pedido["fecha_pedido"] ?></td>
                                <td><?= $pedido["total"] ?></td>
                                <td><?= $pedido["estado"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-danger">No se encontraron pedidos.</p>
            <?php endif; ?>
        </div>

        
        <div id="seccion-crear" class="seccion d-none">
            <div class="card">
                <div class="card-header bg-success text-white">Agregar Pedido</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="agregar">

                        <div class="mb-3">
                            <label class="form-label">ID Cliente:</label>
                            <input type="number" name="id_cliente" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha Pedido:</label>
                            <input type="date" name="fecha_pedido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total:</label>
                            <input type="number" step="0.01" name="total" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado:</label>
                            <input type="text" name="estado" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success">Agregar Pedido</button>
                    </form>
                </div>
            </div>
        </div>

        
        <div id="seccion-actualizar" class="seccion d-none">
            <div class="card">
                <div class="card-header bg-warning text-white">Actualizar Pedido</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="actualizar">

                        <div class="mb-3">
                            <label class="form-label">ID Pedido:</label>
                            <input type="number" name="id_pedido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ID Cliente:</label>
                            <input type="number" name="id_cliente" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha Pedido:</label>
                            <input type="date" name="fecha_pedido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total:</label>
                            <input type="number" step="0.01" name="total" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado:</label>
                            <input type="text" name="estado" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning text-white">Actualizar Pedido</button>
                    </form>
                </div>
            </div>
        </div>

    
        <div id="seccion-eliminar" class="seccion d-none">
            <div class="card">
                <div class="card-header bg-danger text-white">Eliminar Pedido</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="eliminar">

                        <div class="mb-3">
                            <label class="form-label">ID Pedido:</label>
                            <input type="number" name="id_pedido" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Eliminar Pedido</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
