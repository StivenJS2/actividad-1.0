<?php

$opcion = readline("¿Qué quieres ver? (1=categoria/2=pedido): ");

if ($opcion == "1") {
    $url ="http://localhost:8080/categoria";

    $respuesta = readline("¿Desea agregar una categoria :D? (si/no): ");

    if(strtolower($respuesta) === "si"){
        $nombre = readline("Ingrese el nombre de la categoria: ");

        $datos = array(
            "nombre" => $nombre,
        );

        $data_json = json_encode($datos);

        $proceso = curl_init($url);

        curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($proceso, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_json)
        ));

        $respuestapeticion = curl_exec($proceso);

        $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

        if(curl_errno($proceso)) {
            die("Error en la peticion Post: " . curl_error($proceso) . "\n");
        }

        curl_close($proceso);

        if($http_code === 200){
            echo ("Categoria agregada correctamente. Respuesta (200)\n");
        } else {
            echo ("Error en el servidor respuesta $http_code\n");
        }

        $consumo = file_get_contents($url);

        $categoria = json_decode($consumo);

        foreach ($categoria as $categoria) {
            echo $categoria -> nombre . "\n";
        }
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
