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

}$agregar= readline("¿quieres editar un cliente? (si/no):");

if($agregar ==="si"){

    $id_cliente= readline("id del cliente a editar:");

$urlEditar = $url . '/' . $id_cliente;

$nombre= readline("nombre:");
 $apellido = readline("apellido:");
 $contrasena = readline("contrasena:");
 $direccion = readline("direccion:");
 $telefono = readline("telefono:");
 $correo_electronico = readline("correo:");

$Datos= array(
  "nombre" => $nombre,
    "apellido" => $apellido,
    "contrasena" => $contrasena,
    "direccion" => $direccion,
    "telefono" => $telefono,
    "correo_electronico" => $correo_electronico
);

$data_json= json_encode($Datos);

$proceso = curl_init($urlEditar);

curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
curl_setopt($proceso, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
));

$response = curl_exec($proceso);
$http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);
curl_close($proceso);

if ($http_code === 200) {
    echo "Cliente editado con éxito.\n";
} else {
    echo "Error al editar el cliente. Código HTTP: $http_code\n";

}
}
?>