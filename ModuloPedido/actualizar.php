<?php

$url ="http://localhost:8080/pedido";

echo "¿Tienes permisos para ver esta informacion? (si/no): ";
$respuesta = readline();

if ($respuesta == "si") {
    echo "Tienes permisos para ver esta informacion.\n";

} 

else {
    die("No puede ver la informacón\n");
}

$opcion = readline("Desea ver un pedido? (1=si/2=no): ");


if ($opcion == "1") {

$consumo = file_get_contents($url);

$pedido = json_decode($consumo);

foreach ($pedido as $pedido) {
    echo $pedido -> fecha_pedido . "\n";
     echo $pedido -> total . "\n";
      echo $pedido -> estado . "\n";
    echo "___________________________ \n";

}

echo "Deseaa actualizar un pedido? (si/no): ";

$actualizar = readline();

if ($actualizar == "si") {

    $id_pedido = readline("Ingrese el ID del pedido a actualizar: ");   
    $nuevo_estado = readline("Ingrese el nuevo estado del pedido: ");
    $urlActualizar = $url . '/' . $id_pedido;
    $datos = array(
        "estado" => $nuevo_estado,

    );

    $data_json = json_encode($datos);
    $proceso = curl_init($urlActualizar);
    curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($proceso, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json)
    ));

    $respuestapeticion = curl_exec($proceso);
    $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

    if(curl_errno($proceso)) {
        die("Error en la peticion PUT: " . curl_error($proceso) . "\n");
    }
    curl_close($proceso);

    if($http_code === 200){
        echo ("Pedido actualizado correctamente. Respuesta (200)\n");
    } else {
        echo ("Error en el servidor respuesta $http_code\n");
        echo ("Respuesta del servidor: $respuestapeticion\n");
    }
}
}

?>