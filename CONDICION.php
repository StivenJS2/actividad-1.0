<?php


$opcion = readline("¿Qué quieres ver? (1=categoria/2=pedido): ");


if ($opcion == "1") {
$url ="http://localhost:8080/categoria";

$consumo = file_get_contents($url);

$categoria = json_decode($consumo);

foreach ($categoria as $categoria) {
    echo $categoria -> nombre . "\n";

}
}



elseif ($opcion == "2") {
$url ="http://localhost:8080/pedido";

$consumo = file_get_contents($url);

$pedido = json_decode($consumo);

foreach ($pedido as $pedido) {
    echo $pedido -> fecha_pedido . "\n";
     echo $pedido -> total . "\n";
      echo $pedido -> estado . "\n";
    echo "___________________________ \n";

}
}


?>