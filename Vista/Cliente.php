<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/clientes.css"> 
    <script src="js/clientes.js"></script>
</head>
<body>

<div class="sidebar d-flex flex-column bg-dark text-white p-3">
    <h4 class="text-center mb-4">Menú</h4>

    <div class="d-grid gap-3 flex-grow-1">
      <button class="btn btn-primary text-white" onclick="mostrarSeccion('ver')">
            <img src="img/ver-usuario.png" alt="ver" style="width:27px; height:27px; margin-right:5px;">
                Ver Clientes
    </button>

  <button class="btn btn-success text-white" onclick="mostrarSeccion('crear')">
            <img src="img/agregar-usuario.png" alt="crear" style="width:20px; height:20px; margin-right:5px;">
                Agregar Cliente
    </button>


    <button class="btn btn-warning text-black " onclick="mostrarSeccion('actualizar')">
            <img src="img/icono_actualizar.png" alt="Actualizar" style="width:25px; height:25px; margin-right:4px;">
                   Actualizar Cliente 
    </button>



    <button class="btn btn-danger text-black " onclick="mostrarSeccion('eliminar')">
            <img src="img/borrar.gif" alt="eliminar" style="width:25px; height:25px; margin-right:4px;">
                   Eliminar Cliente 
    </button>

        

        <div class="mt-auto">
        <a href="index.php" class="btn btn-secondary w-100"> 
        <img src="img/casa.png" alt="Volver" style="width:32px; height:32px; margin-bottom:6px;">
        Volver al Menú</a>
            </div>
    </div>
</div>


    
<div class="contenido flex-grow-1 p-4">
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-info text-center"><?= $mensaje ?></div>
        <?php endif; ?>

        <div id="seccion-ver" class="seccion">
            <h2>Lista de Clientes</h2>
            <?php if (is_array($clientes)): ?>
                <table class="table table-striped table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?= $cliente["id_cliente"] ?></td>
                                <td><?= $cliente["nombre"] ?></td>
                                <td><?= $cliente["apellido"] ?></td>
                                <td><?= $cliente["correo_electronico"] ?></td>
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
         <div class="card-header bg-success text-white">Agregar Cliente</div>
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
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="correo_electronico" class="form-control" required>
                    </div>

                <button type="submit" class="btn btn-success">Agregar Cliente</button>
            </form>
        </div>
    </div>
</div>


<div id="seccion-actualizar" class="seccion d-none">
    <div class="card">
            <div class="card-header bg-warning text-white">Actualizar Cliente</div>
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
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="correo_electronico" class="form-control" required>
                        </div>

                 <button type="submit" class="btn btn-warning text-white">Actualizar Cliente</button>
             </form>
         </div>
    </div>
</div>


<div id="seccion-eliminar" class="seccion d-none">
    <div class="card">
            <div class="card-header bg-danger text-white">Eliminar Cliente</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="_action" value="eliminar">

                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="number" name="id" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-danger">Eliminar Cliente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

