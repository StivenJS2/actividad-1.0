<?php
$urlVendedor = "http://localhost:8080/vendedor";

$respuesta = readline("¿Eres vendedor? (si/no): ");

if (strtolower($respuesta) == "no") {
    die("No eres vendedor. No puedes acceder\n");
}

$verVendedores = readline("¿Quieres actualizar los datos de una cuenta de vendedor? (si/no): ");

if (strtolower($verVendedores) === "si") {

    $consumovendedor = file_get_contents($urlVendedor);

    if ($consumovendedor === false) {

        die("Error al consumir el servicio de vendedores en $urlVendedor\n");

    }

    $vendedores = json_decode($consumovendedor, true);

    echo "\n__Datos de vendedores__\n";

    foreach ($vendedores as $vendedor){

        echo "ID: " . $vendedor['id_vendedor'] . "\n";
        echo "Nombre: " . $vendedor['nombre'] . " " . $vendedor['apellido'] . "\n";
        echo "Correo: " . $vendedor['correo_electronico'] . "\n";
        echo "Teléfono: " . $vendedor['telefono'] . "\n";
        echo "Contrasenia: " . $vendedor['contrasena'] . "\n";
        echo "----------------------\n";

    }

    echo "Ingrese el ID del vendedor que desea actualizar: ";

        $id_vendedor = trim(fgets(STDIN));
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

            if(curl_errno($proceso)) {

                die("Error en la peticion PUT: " . curl_error($proceso) . "\n");
            }

            curl_close($proceso);

            if($http_code === 200){
                echo ("Vendedor actualizado correctamente. Respuesta (200)\n");
            } else {
                echo ("Error en el servidor respuesta $http_code\n");
            }

    }
    
    elseif(strtolower($verVendedores) === "no"){
        echo ("Programa finalizado\n");
    }

?>