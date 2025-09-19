<?php
$respuesta = readline("¿Estás registrado? (si/no): ");

if ($respuesta == "si") {
    echo "Tienes permisos para ver esta informacion.\n";
} else {
    die("No tienes permiso para ver la informacion\n");
}

$opcion = readline("¿Que deseas ver? (1 = clientes, 2 = productos): ");


if ($opcion == "1") {

$url="http://localhost:8080/cliente";

$consumo=file_get_contents($url);

if ($consumo === FALSE) {
    die("Error al consumir el servicio en $url");
}


$cliente=json_decode($consumo);

foreach($cliente as $cliente){
     echo $cliente->nombre. "\n";
    echo $cliente->apellido. "\n";
    echo $cliente->contrasena. "\n";
    echo $cliente->direccion. "\n";
    echo $cliente->telefono. "\n";
    echo $cliente->correo_electronico. "\n";
    echo "---------------------------\n";
  
    
}

}
elseif ($opcion == "2") {
    $url="http://localhost:8080/producto";

$consumo=file_get_contents($url);

if ($consumo === FALSE) {
    die("Error al consumir el servicio en $url");
}


$producto=json_decode($consumo);

foreach($producto as $producto){
    echo $producto->nombre. "\n";
    echo $producto->descripcion. "\n";
    echo $producto->cantidad. "\n";
    echo $producto->estado. "\n";
    echo "---------------------------\n";
}
}


?>