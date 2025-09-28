<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Categorías</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/categoria.css"> 
    <script src="js/categoria.js"></script>
</head>
<body>

<div class="d-flex">
    
    <div class="sidebar d-flex flex-column bg-dark text-white p-3" style="min-height: 100vh; width: 250px;">
        <h4 class="text-center mb-4">Menú</h4>

        <div class="d-grid gap-3 flex-grow-1">
            <button class="btn btn-primary" onclick="mostrarSeccion('ver')">Categorías</button>
            <button class="btn btn-success" onclick="mostrarSeccion('crear')">Agregar</button>
            <button class="btn btn-warning text-white" onclick="mostrarSeccion('actualizar')">Actualizar</button>
            <button class="btn btn-danger" onclick="mostrarSeccion('eliminar')">Eliminar</button>

            <div class="mt-auto">
                <a href="index.php" class="btn btn-secondary w-100">Volver al Menú</a>
            </div>
        </div>
    </div>

    
    <div class="contenido flex-grow-1 p-4">

        <h1 class="mb-4">Gestión de Categorías</h1>

        <p style="color:blue;"><?= $mensaje ?></p>

        
        <div id="seccion-ver" class="seccion">
            <h2>Lista de Categorías</h2>

            <?php if (is_array($categorias) && isset($categorias["data"])): ?>
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Categoría</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias["data"] as $categoria): ?>
                            <tr>
                                <td><?= $categoria["id_categoria"] ?></td>
                                <td><?= $categoria["nombre"] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-danger">No se encontraron categorías.</p>
            <?php endif; ?>
        </div>

        
        <div id="seccion-crear" class="seccion d-none">
    <div class="card">
        <div class="card-header bg-success text-white">Agregar Categoría</div>
        <div class="card-body">
            <form method="POST">
                <input type="hidden" name="_action" value="agregar">

                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Agregar Categoría</button>
            </form>
        </div>
    </div>
</div>

        
        <div id="seccion-actualizar" class="seccion d-none">
            <div class="card">
                <div class="card-header bg-warning text-white">Actualizar Categoría</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="actualizar">

                        <div class="mb-3">
                            <label class="form-label">ID Categoría:</label>
                            <input type="number" name="id_categoria" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning text-white">Actualizar Categoría</button>
                    </form>
                </div>
            </div>
        </div>

    
        <div id="seccion-eliminar" class="seccion d-none">
            <div class="card">
                <div class="card-header bg-danger text-white">Eliminar Categoría</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="eliminar">

                        <div class="mb-3">
                            <label class="form-label">ID Categoría:</label>
                            <input type="number" name="id_categoria" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Eliminar Categoría</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
