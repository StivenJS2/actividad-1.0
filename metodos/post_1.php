<?php
$respuesta = readline("¿Estás registrado? (si/no): ");

if ($respuesta == "si") {
    echo "Tienes permisos para ver esta informacion.\n";
} else {
    die("No tienes permiso para ver la informacion\n");
}

$opcion = readline("¿Que deseas ver? (1 = clientes, 2 = productos): ");


if ($opcion == "1") {

$url="http://localhost:8080/cliente";

$agregar= readline("¿quieres agregar un cliente? (si/no):");
if($agregar ==="si"){

 $nombre= readline("nombre:") ;
 $apellido = readline("apellido:") ;
 $contrasena = readline("contrasena:") ;
 $direccion = readline("direccion:") ;
 $telefono = readline("telefono:") ;
 $correo_electronico = readline("correo:") ;

$Datos= array(
    
  "nombre" => $nombre,
    "apellido" => $apellido,
    "contrasena" => $contrasena,
    "direccion" => $direccion,
    "telefono" => $telefono,
    "correo_electronico" => $correo_electronico
    
);

$data_json= json_encode($Datos);

$proceso= curl_init($url);



curl_setopt($proceso, CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($proceso, CURLOPT_RETURNTRANSFER,true);
curl_setopt($proceso, CURLOPT_HTTPHEADER, array(
"Content-Type: application/json",
"Content-Length: " . strlen($data_json)));


$rtapeticion= curl_exec($proceso);

$http_code= curl_getinfo($proceso, CURLINFO_HTTP_CODE);

if (curl_errno($proceso)){
    die("error en la peticion POST".curl_error($proceso)."\n");
}
curl_close($proceso);

if($http_code===200){
    echo("se agrego el cliente #respuesta (200)". "\n");
} else{
    echo("fatal error $http_code");
}

}


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

}
elseif ($opcion == "2") {
    $url="http://localhost:8080/producto";

$consumo=file_get_contents($url);

if ($consumo === FALSE) {
    die("Error al consumir el servicio en $url");
}


$producto=json_decode($consumo);

foreach($producto as $producto){
    echo $producto->nombre. "\n";
    echo $producto->descripcion. "\n";
    echo $producto->cantidad. "\n";
    echo $producto->estado. "\n";
    echo "---------------------------\n";
}
}


?>