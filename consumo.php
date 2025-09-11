<?php
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

?>