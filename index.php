<?php
$opcion = $_GET['opcion'] ?? '';

if ($opcion === 'cliente') {
    require_once __DIR__ . '/Controlador/ClienteController.php';
    $controller = new ClienteController();
    $controller->manejarPeticion();
} 

elseif ($opcion === 'vendedor') {
    require_once __DIR__ . '/Controlador/VendedorController.php';
    $controller = new VendedorController();
    $controller->manejarPeticion();
} 

elseif ($opcion === 'pedido') {
    require_once __DIR__ . '/Controlador/PedidoController.php';
    $controller = new PedidoController();
    $controller->manejarPeticion();
} 

else {

    ?>


        <!DOCTYPE html>
        <html lang="es">
        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>Area de Administracion</title>
            </head>
            <body class="bg-dark">

            <div class="container text-center mt-5">

                    <h2 class="mb-4 text-white">Bienvenido Al Area Administrativa</h2>
                    <p class="mb-5 text-white">Selecciona una opción:</p>

                <div class="row g-4 justify-content-center my-5">


                    <!-- Cliente -->
                    <div class="col-md-4">

                    <div class="card shadow-sm h-100 ">

                        <div class="card-body">

                                <h5 class="card-title">Cliente</h5>
                                <p class="card-text">Gestiona los clientes registrados.</p>
                                <a href="?opcion=cliente" class="btn btn-primary">Ir a Cliente</a>

                        </div>

                        </div>

                    </div>

                        
                    <!-- Vendedor -->
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">

                                <h5 class="card-title">Vendedor</h5>
                                <p class="card-text">Administra la información de los vendedores.</p>
                                <a href="?opcion=vendedor" class="btn btn-success">Ir a Vendedor</a>

                            </div>
                        </div>
                    </div>


                    <!-- Pedido -->
                    <div class="col-md-4">

                        <div class="card shadow-sm h-100">

                            <div class="card-body">

                                <h5 class="card-title">Pedido</h5>
                                <p class="card-text">Revisa y gestiona los pedidos activos.</p>
                                <a href="?opcion=pedido" class="btn btn-warning">Ir a Pedido</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            </body>
            </html>
            <?php
}


