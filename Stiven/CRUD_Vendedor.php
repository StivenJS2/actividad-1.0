<?php

$urlVendedor = "http://localhost:8080/vendedor";

// GET
function obtenerVendedores() {
    global $urlVendedor;

    $consumovendedor = file_get_contents($urlVendedor);

    if ($consumovendedor === false) {
        die("Error al consumir el servicio de vendedores en $urlVendedor\n");
    }

    $vendedores = json_decode($consumovendedor, true);

    echo "\nDatos de vendedores\n";
    echo "----------------------\n";

    foreach ($vendedores as $vendedor) {
        echo "ID: " . $vendedor['id_vendedor'] . "\n";
        echo "Nombre: " . $vendedor['nombre'] . " " . $vendedor['apellido'] . "\n";
        echo "Correo: " . $vendedor['correo_electronico'] . "\n";
        echo "Teléfono: " . $vendedor['telefono'] . "\n";
        echo "Contrasenia: " . $vendedor['contrasena'] . "\n";
        echo "----------------------\n";
    }
}

// POST
function crearVendedor() {
    global $urlVendedor;

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

    if (curl_errno($proceso)) {
        die("Error en la peticion POST: " . curl_error($proceso) . "\n");
    }

    curl_close($proceso);

    if ($http_code === 200) {
        echo ("Vendedor guardado correctamente. Respuesta (200)\n");
    } 
    
    else {
        echo ("Error en el servidor respuesta $http_code\n");
    }
}

// PUT
function actualizarVendedor() {
    global $urlVendedor;

    obtenerVendedores();

    $id_vendedor = readline("Ingrese el ID del vendedor que desea actualizar: ");
    $urlActualizar = $urlVendedor . '/' . $id_vendedor;

    $nombre = readline("Ingrese nuevo nombre: ");
    $apellido = readline("Ingrese nuevo apellido: ");
    $correo_electronico = readline("Ingrese nuevo correo electronico: ");
    $telefono = readline("Ingrese nuevo telefono: ");
    $contrasena = readline("Ingrese nueva contrasena: ");

    $datos = array(
        "nombre" => $nombre,
        "apellido" => $apellido,
        "correo_electronico" => $correo_electronico,
        "telefono" => $telefono,
        "contrasena" => $contrasena
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

    if (curl_errno($proceso)) {
        die("Error en la peticion PUT: " . curl_error($proceso) . "\n");
    }

    curl_close($proceso);

    if ($http_code === 200) {
        echo ("Vendedor actualizado correctamente. Respuesta (200)\n");
    } 
    
    else {
        echo ("Error en el servidor respuesta $http_code\n");
    }
}

// DELETE
function eliminarVendedor() {
    global $urlVendedor;

    obtenerVendedores();

    $id_vendedor = readline("Ingrese el ID del vendedor que desea eliminar: ");
    $urlEliminar = $urlVendedor . '/' . $id_vendedor;

    $proceso = curl_init($urlEliminar);
    curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($proceso, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    $respuestapeticion = curl_exec($proceso);
    $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

    if (curl_errno($proceso)) {
        die("Error en la peticion DELETE: " . curl_error($proceso) . "\n");
    }

    curl_close($proceso);

    if ($http_code === 200) {
        echo ("Vendedor eliminado correctamente. Respuesta (200)\n");
    } 
    
    else {
        echo ("Error en el servidor respuesta $http_code\n");
    }
}


