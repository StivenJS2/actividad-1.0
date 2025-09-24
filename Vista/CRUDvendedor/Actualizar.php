<?php
require_once __DIR__ . "/../../Modelo/ModuloVendedor/VendedorService.php";
$vendedorService = new VendedorService();
$vendedores = $vendedorService->obtenerVendedores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Vendedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container-fluid">
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
            <h2 class="mb-4 text-center">Actualizar Vendedor</h2>

            <form action="../../Controlador/VendedorController.php" method="POST" class="border p-4 rounded shadow-sm bg-light">

                <input type="hidden" name="_action" value="actualizar">

                <div class="mb-3">
                    <label for="id" class="form-label">ID del Vendedor</label>
                    <input type="number" id="id" name="id" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" id="direccion" name="direccion" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                    <input type="email" id="correo_electronico" name="correo_electronico" class="form-control" required>
                </div>

                <button type="submit" name="accion" value="crear" class="btn btn-success w-100">
                    Actualizar
                </button>
            </form>
        </div>
    </div>

</body>
</html>
