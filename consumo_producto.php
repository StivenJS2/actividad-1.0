<?php
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

?>