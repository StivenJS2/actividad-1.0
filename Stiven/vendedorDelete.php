<?php
$urlVendedor = "http://localhost:8080/vendedor";

$respuesta = readline("¿Eres vendedor? (si/no): ");

if (strtolower($respuesta) == "no") {
    die("No eres vendedor. No puedes acceder\n");
}

$verVendedores = readline("¿Quieres eliminar alguna cuenta de vendedor? (si/no): ");

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

    echo "Ingrese el ID del vendedor que desea eliminar: ";

        $id_vendedor = trim(fgets(STDIN));
        $urlEliminar = $urlVendedor . '/' . $id_vendedor;
        $proceso = curl_init($urlEliminar);

        curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($proceso, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        
        $respuestapeticion = curl_exec($proceso);
        $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);
                
            if(curl_errno($proceso)) {

                die("Error en la peticion DELETE: " . curl_error($proceso) . "\n");
            }

            curl_close($proceso);

            if($http_code === 200){

                echo ("Vendedor eliminado correctamente. Respuesta (200)\n");

            } 
            
            else {

                echo ("Error en el servidor respuesta $http_code\n");

            }

        } 
        
        elseif(strtolower($verVendedores) === "no"){

            echo ("Programa finalizado\n");

}

?>