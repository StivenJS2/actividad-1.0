<?php
// Detectar qué controlador se debe usar
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

else {
    echo "<h2>Bienvenido</h2>";
    echo "<p>Selecciona una opción:</p>";
    echo "<a href='?opcion=cliente'>Ir a Cliente</a><br>";
    echo "<a href='?opcion=vendedor'>Ir a Vendedor</a>";
}
