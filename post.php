<?
$agregar= readline("¿quieres agregar un cliente? (si/no):");
if($agregar ==="si"){

 $nombre= readline("nombre:") ;
 $apellido = readline("apellido:") ;
 $contrasena = readline("contrasena:") ;
 $direccion = readline("direccion:") ;
 $telefono = readline("telefono:") ;
 $correo_electronico = readline("correo:") ;

$Datos= array(
    
    $nombre,
 $apellido,
    $contrasena,
 $direccion,
    $telefono,
 $correo_electronico 
    
);

$data_json= json_encode($Datos);
$proceso= curl_init($url);



curl_setopt($proceso, CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($proceso, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
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
?>


