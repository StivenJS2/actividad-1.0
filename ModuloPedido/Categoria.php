<?php

$url ="http://localhost:8080/categoria";

$consumo = file_get_contents($url);

$categoria = json_decode($consumo);

foreach ($categoria as $categoria) {
    echo $categoria -> nombre . "\n";

}


?>