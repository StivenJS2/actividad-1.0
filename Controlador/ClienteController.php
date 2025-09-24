<?php

require_once __DIR__ . "/../Modelo/ModuloCliente/ClienteService.php";


class ClienteController {
    private $clienteService;
   
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


        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $input = json_decode(file_get_contents("php://input"), true);

            $id = $input["id"] ?? null;
            $nombre = trim($input['nombre'] ?? '');
            $apellido = trim($input['apellido'] ?? '');
            $contrasena = trim($input['contrasena'] ?? '');
            $direccion = trim($input['direccion'] ?? '');
            $telefono = trim($input['telefono'] ?? '');
            $correo_electronico = trim($input['correo_electronico'] ?? '');

            if ($id && !empty($nombre) && !empty($apellido) && !empty($contrasena) &&
                !empty($direccion) && !empty($telefono) && !empty($correo_electronico)) {

                $resultado = $this->clienteService->actualizarCliente(
                    $id, $nombre, $apellido, $contrasena, $direccion, $telefono, $correo_electronico
                );

                if ($resultado["success"]) {
                    $mensaje = "<p style='color:green;'>Cliente actualizado correctamente</p>";
                } else {
                    $mensaje = "<p style='color:red;'>Error al actualizar cliente: " . $resultado["error"] . "</p>";
                }
            } else {
                $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $input = json_decode(file_get_contents("php://input"), true);
            $id = $input["id"] ?? null;

            if ($id) {
                $resultado = $this->clienteService->eliminarCliente($id);

                if ($resultado["success"]) {
                    $mensaje = "<p style='color:green;'>Cliente eliminado correctamente</p>";
                } else {
                    $mensaje = "<p style='color:red;'>Error al eliminar cliente: " . $resultado["error"] . "</p>";
                }
            } else {
                $mensaje = "<p style='color:red;'>El ID del cliente es obligatorio para eliminar.</p>";
            }
        }



        $clientes = $this->clienteService->obtenerClientes();

        require __DIR__ . "/../Vista/Cliente.php";
    }
   
}
?>
