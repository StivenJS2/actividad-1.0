<?php
require_once __DIR__ . "/../Modelo/ModuloCliente/ClienteService.php";

class ClienteController {
    private $clienteService;
   
    public function __construct() {
        $this->clienteService = new ClienteService();
    }
   
    public function manejarPeticion() {
        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST["_action"] ?? "";

            switch ($accion) {
                case "agregar":
                    $nombre = trim($_POST['nombre'] ?? '');
                    $apellido = trim($_POST['apellido'] ?? '');
                    $contrasena = trim($_POST['contrasena'] ?? '');
                    $direccion = trim($_POST['direccion'] ?? '');
                    $telefono = trim($_POST['telefono'] ?? '');
                    $correo_electronico = trim($_POST['correo_electronico'] ?? '');

                    if ($nombre && $apellido && $contrasena && $direccion && $telefono && $correo_electronico) {
                        $resultado = $this->clienteService->agregarCliente(
                            $nombre, $apellido, $contrasena, $direccion, $telefono, $correo_electronico
                        );
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Cliente agregado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "actualizar":
                    $id = $_POST["id"] ?? null;
                    $nombre = trim($_POST['nombre'] ?? '');
                    $apellido = trim($_POST['apellido'] ?? '');
                    $contrasena = trim($_POST['contrasena'] ?? '');
                    $direccion = trim($_POST['direccion'] ?? '');
                    $telefono = trim($_POST['telefono'] ?? '');
                    $correo_electronico = trim($_POST['correo_electronico'] ?? '');

                    if ($id && $nombre && $apellido && $contrasena && $direccion && $telefono && $correo_electronico) {
                        $resultado = $this->clienteService->actualizarCliente(
                            $id, $nombre, $apellido, $contrasena, $direccion, $telefono, $correo_electronico
                        );
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Cliente actualizado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "eliminar":
                    $id = $_POST["id"] ?? null;

                    if ($id) {
                        $resultado = $this->clienteService->eliminarCliente($id);
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Cliente eliminado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>El ID del cliente es obligatorio.</p>";
                    }
                    break;
            }
        }

        $clientes = $this->clienteService->obtenerClientes();

    
        require __DIR__ . "/../Vista/Cliente.php";
    }
}

