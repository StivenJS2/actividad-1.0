<?php
require_once __DIR__ . "/../Modelo/ModuloVendedor/VendedorService.php";

class VendedorController {
    private $vendedorService;
   
    public function __construct() {
        $this->vendedorService = new VendedorService();
    }
   
    public function manejarPeticion() {
        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST["_action"] ?? "";

            switch ($accion) {
                    case "agregar":
                        $nombre = trim($_POST['nombre'] ?? '');
                        $apellido = trim($_POST['apellido'] ?? '');
                        $correo_electronico = trim($_POST['correo_electronico'] ?? '');
                        $telefono = trim($_POST['telefono'] ?? '');
                        $contrasena = trim($_POST['contrasena'] ?? '');

                        if ($nombre && $apellido && $correo_electronico && $telefono && $contrasena) {
                            $resultado = $this->vendedorService->agregarVendedor(
                                $nombre, $apellido, $correo_electronico, $telefono, $contrasena 
                            );
                            $mensaje = $resultado["success"]
                                ? "Vendedor agregado correctamente"
                                : "Error: " . $resultado["error"];
                        } 
                        
                        else {
                            $mensaje = "Todos los campos son obligatorios.";
                        }
                        break;

                    case "actualizar":
                        $id_vendedor = $_POST["id_vendedor"] ?? null;
                        $nombre = trim($_POST['nombre'] ?? '');
                        $apellido = trim($_POST['apellido'] ?? '');
                        $correo_electronico = trim($_POST['correo_electronico'] ?? '');
                        $telefono = trim($_POST['telefono'] ?? '');
                        $contrasena = trim($_POST['contrasena'] ?? '');

                        if ($id_vendedor && $nombre && $apellido && $correo_electronico && $telefono && $contrasena) {
                            $resultado = $this->vendedorService->actualizarVendedor(
                                $id_vendedor, $nombre, $apellido, $correo_electronico, $telefono, $contrasena
                            );
                            $mensaje = $resultado["success"]
                                ? "Vendedor actualizado correctamente"
                                : "Error: " . $resultado["error"];
                        } 
                        
                        else {
                            $mensaje = "Todos los campos son obligatorios.";
                        }
                        break;

                    case "eliminar":
                        $id_vendedor = $_POST["id_vendedor"] ?? null;

                        if ($id_vendedor) {
                            $resultado = $this->vendedorService->eliminarVendedor($id_vendedor);
                            $mensaje = $resultado["success"]
                                ? "Vendedor eliminado correctamente"
                                : "Error: " . $resultado["error"];
                        } 
                        
                        else {
                            $mensaje = "El ID del vendedor es obligatorio.";
                        }
                        break;

                    default:
                        $mensaje = "Acción no válida.";
                        break;
            }
        }

        $vendedores = $this->vendedorService->obtenerVendedores();

        require __DIR__ . "/../Vista/Vendedor.php";
    }
}
