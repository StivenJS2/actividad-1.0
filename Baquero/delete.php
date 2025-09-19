<?php
$respuesta = readline("¿Estás registrado? (si/no): ");

if ($respuesta == "si") {
    echo "Tienes permisos para ver esta informacion.\n";

} 

else {
    die("No tienes permiso para ver la informacion\n");
}

$opcion = readline("Desea ver los clientes? (1=si/2=no): ");


if ($opcion == "1") {

$url="http://localhost:8080/cliente";



$consumo=file_get_contents($url);

if ($consumo === FALSE) {
    die("Error al consumir el servicio en $url");
}


$cliente=json_decode($consumo);

foreach($cliente as $cliente){
     echo $cliente->nombre. "\n";
    echo $cliente->apellido. "\n";
    echo $cliente->contrasena. "\n";
    echo $cliente->direccion. "\n";
    echo $cliente->telefono. "\n";
    echo $cliente->correo_electronico. "\n";
    echo "---------------------------\n";
  
    
}

$agregar= readline("¿quieres eliminar un cliente? (si/no):");
if($agregar ==="si"){

 $id_cliente= readline("id del cliente a eliminar:") ;  
$urlEliminar = $url . '/' . $id_cliente;
$proceso = curl_init($urlEliminar);
curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
curl_setopt($proceso, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));
$response = curl_exec($proceso);
$http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);
curl_close($proceso);

if ($http_code === 200) {
    echo "Cliente eliminado con éxito.\n";
} else {
    echo "Error al eliminar el cliente. Código HTTP: $http_code\n";

}

}

} elseif ($opcion == "2") {
    echo "Programa finalizado.\n";
} else {
    echo "Opción no válida. Programa finalizado.\n";
}

?>