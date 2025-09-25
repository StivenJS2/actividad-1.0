<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Vendedores</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/vendedores.css"> 
    <script src="js/vendedores.js"></script>
</head>
<body>

<div class="sidebar d-flex flex-column bg-dark text-white p-3">
    <h4 class="text-center mb-4">Menú</h4>

    <div class="d-grid gap-3 flex-grow-1">
        <button class="btn btn-primary" onclick="mostrarSeccion('ver')">Vendedores</button>
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

        <h2>Lista de Vendedores</h2>

        <?php if (is_array($vendedores)): ?>
            <table class="table table-striped table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendedores as $v): ?>
                        <tr>
                            <td><?= $v["id_vendedor"] ?></td>
                            <td><?= $v["nombre"] ?></td>
                            <td><?= $v["apellido"] ?></td>
                            <td><?= $v["correo_electronico"] ?></td>
                            <td><?= $v["telefono"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p class="text-danger">No se encontraron vendedores.</p>
        <?php endif; ?>

    </div>


    <!-- POST -->
    <div id="seccion-crear" class="seccion d-none">

        <div class="card">
            <div class="card-header bg-success text-white">Agregar Vendedor</div>

            <div class="card-body">

                <form method="POST">
                    <input type="hidden" name="_action" value="agregar">

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="correo_electronico" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Agregar Vendedor</button>
                </form>
            </div>
        </div>
    </div>


    <!-- PUTH -->
    <div id="seccion-actualizar" class="seccion d-none">
        <div class="card">
            <div class="card-header bg-warning text-white">Actualizar Vendedor</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="_action" value="actualizar">

                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="number" name="id" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="correo_electronico" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-warning text-white">Actualizar Vendedor</button>
                </form>
            </div>
        </div>
    </div>


    <!-- DELETE -->
    <div id="seccion-eliminar" class="seccion d-none">
        <div class="card">
            <div class="card-header bg-danger text-white">Eliminar Vendedor</div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="_action" value="eliminar">

                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="number" name="id" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger">Eliminar Vendedor</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

