<?php
include 'confi/confi.php';

$respuesta = readline("¿Estás registrado? (si/no): ");

if ($respuesta == "si") {
    echo "Tienes permisos para ver esta informacion.\n";
} else {
    die("No tienes permiso para ver la informacion\n");
}

while (true) {
    echo "\n===== MENÚ CLIENTES =====\n";
    echo "1. Ver clientes\n";
    echo "2. Agregar cliente\n";
    echo "3. Editar cliente\n";
    echo "4. Eliminar cliente\n";
    echo "5. Salir\n";

    $opcion = readline("Seleccione una opción: ");

    if ($opcion == "1") {
        verClientes($urlCliente);
    } elseif ($opcion == "2") {
        agregarCliente($urlCliente);
    } elseif ($opcion == "3") {
        editarCliente($urlCliente);
    } elseif ($opcion == "4") {
        eliminarCliente($urlCliente);
    } elseif ($opcion == "5") {
        echo "Programa finalizado.\n";
        break;
    } else {
        echo "Opción no válida.\n";
    }
}


function verClientes($urlCliente) {
    $consumo = file_get_contents($urlCliente);
    if ($consumo === FALSE) {
        die("Error al consumir el servicio en $urlCliente\n");
    }
   $clientes = json_decode($consumo);

foreach ($clientes as $cliente) {
    echo "ID: " . $cliente->id_cliente . "\n";
    echo "Nombre: " . $cliente->nombre . "\n";
    echo "Apellido: " . $cliente->apellido . "\n";
    echo "Contraseña: " . $cliente->contrasena . "\n";
    echo "Dirección: " . $cliente->direccion . "\n";
    echo "Teléfono: " . $cliente->telefono . "\n";
    echo "Correo: " . $cliente->correo_electronico . "\n";
    echo "---------------------------\n";
}

}


function agregarCliente($urlCliente) {
    $datos = [
        "nombre" => readline("Nombre: "),
        "apellido" => readline("Apellido: "),
        "contrasena" => readline("Contraseña: "),
        "direccion" => readline("Dirección: "),
        "telefono" => readline("Teléfono: "),
        "correo_electronico" => readline("Correo: ")
    ];


$data_json = json_encode($datos);
    $proceso = curl_init($urlCliente);
    curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($proceso, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Content-Length: " . strlen($data_json)
    ]);
    
    $rtapeticion = curl_exec($proceso);

    $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

    if (curl_errno($proceso)){
    die("error en la peticion POST".curl_error($proceso)."\n");
}

    curl_close($proceso);

    if ($http_code === 200) {
        echo "Cliente agregado con éxito.\n";
    } else {
        echo "Error al agregar cliente. Código HTTP: $http_code\n";
    }
}


function editarCliente($urlCliente) {
    $id = readline("ID del cliente para editar: ");
    $urlEditar = $urlCliente . "/" . $id;

    $datos = [
        "nombre" => readline("Nombre: "),
        "apellido" => readline("Apellido: "),
        "contrasena" => readline("Contraseña: "),
        "direccion" => readline("Dirección: "),
        "telefono" => readline("Teléfono: "),
        "correo_electronico" => readline("Correo: ")
    ];


$data_json = json_encode($datos);
    $proceso = curl_init($urlEditar);
    curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($proceso, CURLOPT_HTTPHEADER,
     ["Content-Type: application/json",
     "Content-Length: " . strlen($data_json)]);


    $rtapeticion = curl_exec($proceso);

    $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

if (curl_errno($proceso)){
    die("error en la peticion PUT".curl_error($proceso)."\n");
}

    curl_close($proceso);

    if ($http_code === 200) {
        echo "Cliente editado con éxito.\n";
    } else {
        echo "Error al editar cliente. Código HTTP: $http_code\n";
    }
}

function eliminarCliente($urlCliente) {
    $id = readline("ID del cliente a eliminar: ");
    $urlEliminar = $urlCliente . "/" . $id;

    $proceso = curl_init($urlEliminar);
    curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($proceso, CURLOPT_HTTPHEADER,
     ["Content-Type: application/json"]);

    $rtapeticion = curl_exec($proceso);

    $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

if (curl_errno($proceso)){
    die("error en la peticion DELETE".curl_error($proceso)."\n");
}

    curl_close($proceso);

    if ($http_code === 200) {
        echo "Cliente eliminado con éxito.\n";
    } else {
        echo "Error al eliminar cliente. Código HTTP: $http_code\n";
    }
}

?>