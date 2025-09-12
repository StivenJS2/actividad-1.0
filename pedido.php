<?php

$url ="http://localhost:8080/pedido";

$consumo = file_get_contents($url);

$pedido = json_decode($consumo);

foreach ($pedido as $pedido) {
    echo $pedido -> fecha_pedido . "\n";
     echo $pedido -> total . "\n";
      echo $pedido -> estado . "\n";
    echo "___________________________ \n";

}


?>