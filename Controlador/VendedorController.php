<?php
require_once __DIR__ . "/../Modelo/ModuloVendedor/VendedorService.php";

class VendedorController {
    private $vendedorService;

    public function __construct() {
        $this->vendedorService = new VendedorService();
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

             
                $resultado = $this->vendedorService->agregarVendedor(
                    $nombre, $apellido, $contrasena, $direccion, $telefono, $correo_electronico
                );

                if ($resultado["success"]) {
                    $mensaje="<p style='color:green;'>Vendedor agregado correctamente</p>";
                } else {
                    $mensaje="<p style='color:red;'>Error al agregar vendedor: " .$resultado["error"]."</p>";
                }
            } else {
                $mensaje="<p style='color:red;'>Todos los campos son obligatorios.</p>";
            }
        }

        $vendedores = $this->vendedorService->obtenerVendedores();
        require __DIR__."/../Vista/Vendedor.php";

    }
}


?>