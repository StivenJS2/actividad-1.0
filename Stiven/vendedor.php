<?php
$urlVendedor = "http://localhost:8080/vendedor";
$urlCarrito  = "http://localhost:8080/carrito";

$respuesta = readline("¿Eres vendedor? (si/no): ");

if (strtolower($respuesta) == "no") {
    die("No eres vendedor. No puedes acceder\n");
}

$verVendedores = readline("¿Quieres ver los datos de los vendedores? (si/no): ");

if (strtolower($verVendedores) === "si") {

    $consumovendedor = file_get_contents($urlVendedor);

    if ($consumovendedor === false) {

        die("Error al consumir el servicio de vendedores en $urlVendedor\n");

    }

    $vendedores = json_decode($consumovendedor, true);

    echo "\n__Datos de vendedores__\n";

    foreach ($vendedores as $vendedor){

        echo "ID: " . $vendedor['id_vendedor'] . "\n";
        echo "Nombre: " . $vendedor['nombre'] . " " . $vendedor['apellido'] . "\n";
        echo "Correo: " . $vendedor['correo_electronico'] . "\n";
        echo "Teléfono: " . $vendedor['telefono'] . "\n";
        echo "Contrasenia: " . $vendedor['contrasena'] . "\n";
        echo "----------------------\n";

    }
}


else {

    echo "Ok, no se mostrarán los datos del vendedor.\n";

}

$verCarrito = readline("¿Quieres ver los carritos de los clientes? (si/no): ");

if (strtolower($verCarrito) === "si") {

    $consumoCarrito = file_get_contents($urlCarrito);

    if ($consumoCarrito === false) {
        die("Error al consumir el servicio de carritos en $urlCarrito\n");

    }

    $carritos = json_decode($consumoCarrito, true);

    echo "\n__Carritos de clientes__\n";

    foreach ($carritos as $carrito){

        echo "ID Carrito: " . $carrito['id_carrito'] . "\n";
        echo "ID Cliente: " . $carrito['id_cliente'] . "\n";
        echo "ID Detalle Producto: " . $carrito['id_detalle_producto'] . "\n";
        echo "Cantidad: " . $carrito['cantidad'] . "\n";
        echo "Precio Unitario: " . $carrito['precio_unitario'] . "\n";
        echo "Subtotal: " . $carrito['subtotal'] . "\n";
        echo "----------------------\n";

    }
} 

else {

    echo "Vale, no se mostraran los carritos. Fin del programa\n";
    
}
?>

