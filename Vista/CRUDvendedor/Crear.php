<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear Vendedor</title>


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
                <h2 class="text-center mb-4">Registrar Nuevo Vendedor</h2>

                <div class="card shadow-lg">
                    <div class="card-body bg-light text-dark">

                        <form action="../../Controlador/VendedorController.php" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Vendedor</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>


                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                            </div>

                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                            </div>

                            <div class="mb-3">
                                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
                            </div>



                            <button type="submit" name="_action" value="agregar" class="btn btn-success bg-primary w-100">
                                Crear Vendedor
                            </button>
                        </form>

                    </div>
                </div>  
            </div>
    </div>

</div>

</body>
</html>
