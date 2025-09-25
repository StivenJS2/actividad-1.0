<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Vendedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white text-dark">

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

            <h2 class="mb-4 text-danger">Eliminar Vendedor</h2>

            <form action="/CONSUMO/Controlador/VendedorController.php" method="POST">
                <input type="hidden" name="_action" value="eliminar">

                <div class="mb-3">
                    <label class="form-label">ID del Vendedor</label>
                    <input type="number" class="form-control" name="id" required>
                </div>

                <button type="submit" class="btn btn-danger">Eliminar</button>
                <a href="/consumo/?opcion=vendedor" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
