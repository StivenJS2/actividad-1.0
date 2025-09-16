<?php
$urlVendedor = "http://localhost:8080/vendedor";

$respuesta = readline("¿Desea agregar un nuevo vendedor? (si/no): ");

if(strtolower($respuesta) === "si"){
    $nombre = readline("Ingrese nombre: ");
    $apellido = readline("Ingrese apellido: ");
    $correo_electronico = readline("Ingrese correo electronico: ");
    $telefono = readline("Ingrese telefono: ");
    $contrasena = readline("Ingrese contrasena: ");

    $datos = array(
        "nombre" => $nombre,
        "apellido" => $apellido,
        "correo_electronico" => $correo_electronico,
        "telefono" => $telefono,
        "contrasena" => $contrasena
    );

    $data_json = json_encode($datos);

    $proceso = curl_init($urlVendedor);

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
        echo ("Vendedor guardado correctamente. Respuesta (200)\n");
    } else {
        echo ("Error en el servidor respuesta $http_code\n");
    }

} elseif(strtolower($respuesta) === "no"){
    echo ("Programa finalizado\n");
}
?>
