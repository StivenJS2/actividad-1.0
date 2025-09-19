<?php

include 'confi/confi.php';

// GET
function obtenerPedidos() {
    global $urlPedido;

    $consumopedido = file_get_contents($urlPedido);

    if ($consumopedido=== false) {
        die("Error al consumir el servicio de pedidos en $urlPedido\n");
    }

    $pedidos = json_decode($consumopedido, true);

    echo "\nDatos de pedidos\n";
    echo "----------------------\n";

foreach ($pedidos as $pedido) {
        echo "ID: " . $pedido['id_pedido'] . "\n";
        echo "ID: " . $pedido['id_cliente'] . "\n";
        echo "fecha_pedido : " . $pedido['fecha_pedido'] .  "\n";
        echo "total: " . $pedido['total'] . "\n";
        echo "esatdo: " . $pedido['estado'] . "\n";
        
        echo "----------------------\n";

}

}

// POST
function crearPedido() {
    global $urlPedido;

    $id_cliente = readline("Ingrese el ID del cliente: ");
    $fecha_pedido = readline("Ingrese la fecha: ");
    $total = readline("Ingrese el precio total: ");
    $estado= readline("Ingrese el estado del pedido:");


    $datos = array(
        "id_cliente" => $id_cliente,
        "fecha_pedido" => $fecha_pedido,
        "total" => $total,
        "estado" => $estado,

    );

    $data_json = json_encode($datos);

    $proceso = curl_init($urlPedido);
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
        echo ("Pedido guardado correctamente. Respuesta (200)\n");
    } 
    
    else {
        echo ("Error en el servidor respuesta $http_code\n");
    }
}

// PUT
function actualizarPedido() {
    global $urlPedido;

    obtenerPedidos();

    $id_pedido = readline("Ingrese el ID del pedido que desea actualizar: ");
    $urlActualizar = $urlPedido. '/' . $id_pedido;

    $id_cliente = readline("Ingrese el ID del cliente: ");
    $fecha_pedido = readline("Ingrese la fecha: ");
    $total = readline("Ingrese el precio total: ");
    $estado= readline("Ingrese el estado del pedido:");


    $datos = array(
        "id_cliente" => $id_cliente,
        "fecha_pedido" => $fecha_pedido,
        "total" => $total,
        "estado" => $estado,

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
        echo ("Pedido actualizado correctamente. Respuesta (200)\n");
    } 
    
    else {
        echo ("Error en el servidor respuesta $http_code\n");
    }
}

// DELETE
function eliminarPedido() {
    global $urlPedido;

    obtenerPedidos();

    $id_pedido= readline("Ingrese el ID del pedido que desea eliminar: ");
    $urlEliminar = $urlPedido . '/' . $id_pedido;

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
        echo ("pedido eliminado correctamente. Respuesta (200)\n");
    } 
    
    else {
        echo ("Error en el servidor respuesta $http_code\n");
    }
}


