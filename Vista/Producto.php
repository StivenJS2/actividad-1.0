<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/productos.css"> 
    <script src="js/producto.js"></script>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    
  
    <div class="col-md-3 col-lg-2 sidebar d-flex flex-column bg-dark text-white p-3 min-vh-100">
        <h4 class="text-center mb-4">Menú</h4>

        <div class="d-grid gap-3 flex-grow-1">
            <button class="btn btn-primary" onclick="mostrarSeccion('ver')">Productos</button>
            <button class="btn btn-success" onclick="mostrarSeccion('crear')">Agregar</button>
            <button class="btn btn-warning text-white" onclick="mostrarSeccion('actualizar')">Actualizar</button>
            <button class="btn btn-danger" onclick="mostrarSeccion('eliminar')">Eliminar</button>

            <div class="mt-auto">
                <a href="index.php" class="btn btn-secondary w-100">Volver al Menú</a>
            </div>
        </div>
    </div>

    
    <div class="col-md-9 col-lg-10 contenido flex-grow-1 p-4">
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center"><?= $mensaje ?></div>
        <?php endif; ?>

        
        <div id="seccion-ver" class="seccion">
            <h2>Lista de Productos</h2>

            <?php if (is_array($productos)): ?>
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>ID Vendedor</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                            <tr>
                                <td><?= $p["id_producto"] ?></td>
                                <td><?= $p["nombre"] ?></td>
                                <td><?= $p["descripcion"] ?></td>
                                <td><?= $p["cantidad"] ?></td>
                                <td><?= $p["id_vendedor"] ?></td>
                                <td><?= $p["estado"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-danger">No se encontraron productos.</p>
            <?php endif; ?>
        </div>

        
        <div id="seccion-crear" class="seccion d-none">
            <div class="card">
                <div class="card-header bg-success text-white">Agregar Producto</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="agregar">

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ID Vendedor</label>
                            <input type="number" name="id_vendedor" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select" required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Agregar Producto</button>
                    </form>
                </div>
            </div>
        </div>

      
        <div id="seccion-actualizar" class="seccion d-none">
            <div class="card">
                <div class="card-header bg-warning text-white">Actualizar Producto</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="actualizar">

                        <div class="mb-3">
                            <label class="form-label">ID Producto</label>
                            <input type="number" name="id_producto" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ID Vendedor</label>
                            <input type="number" name="id_vendedor" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select" required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning text-white">Actualizar Producto</button>
                    </form>
                </div>
            </div>
        </div>

        
        <div id="seccion-eliminar" class="seccion d-none">
            <div class="card">
                <div class="card-header bg-danger text-white">Eliminar Producto</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="eliminar">

                        <div class="mb-3">
                            <label class="form-label">ID Producto</label>
                            <input type="number" name="id_producto" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Eliminar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
