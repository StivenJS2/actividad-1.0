<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 col-lg-2 bg-dark text-white min-vh-100 p-3">
            <h4 class="mb-4">Menú Vendedores</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="/consumo/?opcion=vendedor" class="nav-link text-warning fw-bold">Vendedores</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="/CONSUMO/Vista/CRUDvendedor/Crear.php" class="nav-link text-white">Crear</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="/CONSUMO/Vista/CRUDvendedor/Actualizar.php" class="nav-link text-white">Actualizar</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="/CONSUMO/Vista/CRUDvendedor/Eliminar.php" class="nav-link text-white">Eliminar</a>
                </li>
                <li class="nav-item mt-4">
                    <a href="/CONSUMO/index.php" class="btn btn-secondary w-100">Volver al inicio</a>
                </li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 p-4">
            <h2 class="mb-4">Lista de Vendedores</h2>

            <p style="color:blue;"><?= $mensaje ?? '' ?></p>

            <?php if (isset($vendedores) && is_array($vendedores) && count($vendedores) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                            <?php foreach ($vendedores as $vendedor): ?>
                                <tr>
                                    <td><?= htmlspecialchars($vendedor["id_vendedor"]) ?></td>
                                    <td><?= htmlspecialchars($vendedor["nombre"]) ?></td>
                                    <td><?= htmlspecialchars($vendedor["apellido"]) ?></td>
                                    <td><?= htmlspecialchars($vendedor["correo_electronico"]) ?></td>
                                    <td><?= htmlspecialchars($vendedor["telefono"]) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-danger">No se encontraron vendedores.</p>
            <?php endif; ?>
        </div>

    </div>
</div>

</body>
</html>
