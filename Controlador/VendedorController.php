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
                            ? "<p style='color:green;'>Vendedor agregado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "actualizar":
                    $id_vendedor = $_POST["id"] ?? null;
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
                            ? "<p style='color:green;'>Vendedor actualizado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "eliminar":
                    $id = $_POST["id"] ?? null;

                    if ($id) {
                        $resultado = $this->vendedorService->eliminarVendedor($id);
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Vendedor eliminado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>El ID del vendedor es obligatorio.</p>";
                    }
                    break;
            }
        }

        $vendedores = $this->vendedorService->obtenerVendedores();

        require __DIR__ . "/../Vista/CRUDvendedor/Vendedor.php";

    }
}