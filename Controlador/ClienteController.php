<?php

require_once __DIR__ . "/../Modelo/ModuloCliente/ClienteService.php";

class ClienteController {
    private $clienteService;
  
    // 🔹 Constructor para inicializar el servicio
    public function __construct() {
        $this->clienteService = new ClienteService();
    }

    public function manejarPeticion() {
        $mensaje ="";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $contrasena = trim($_POST['contrasena'] ?? '');
            $direccion = trim($_POST['direccion'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $correo_electronico = trim($_POST['correo_electronico'] ?? '');

            if (!empty($nombre) && !empty($apellido) && !empty($contrasena) && 
                !empty($direccion) && !empty($telefono) && !empty($correo_electronico)) {

             
                $resultado = $this->clienteService->agregarCliente(
                    $nombre, $apellido, $contrasena, $direccion, $telefono, $correo_electronico
                );

                if ($resultado["success"]) {
                    $mensaje="<p style='color:green;'>Cliente agregado correctamente</p>";
                } else {
                    $mensaje="<p style='color:red;'>Error al agregar cliente: " .$resultado["error"]."</p>";
                }
            } else {
                $mensaje="<p style='color:red;'>Todos los campos son obligatorios.</p>";
            }
        }

       
        $clientes = $this->clienteService->obtenerClientes();

        require __DIR__."/../Vista/index.php";
    }
}
?>