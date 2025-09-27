<?php
require_once __DIR__ . "/../Modelo/ModuloProducto/ProductoService.php";

class ProductoController {
    private $productoService;
   
    public function __construct() {
        $this->productoService = new ProductoService();
    }
   
    public function manejarPeticion() {
        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST["_action"] ?? "";

            switch ($accion) {
                case "agregar":
                    $nombre = trim($_POST['nombre'] ?? '');
                    $descripcion = trim($_POST['descripcion'] ?? '');
                    $cantidad = trim($_POST['cantidad'] ?? '');
                    $id_vendedor = trim($_POST['id_vendedor'] ?? '');
                    $estado = trim($_POST['estado'] ?? '');

                    if ($nombre && $descripcion && $cantidad && $id_vendedor && $estado) {
                        $resultado = $this->productoService->agregarProducto(
                            $nombre, $descripcion, $cantidad, $id_vendedor, $estado
                        );
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Producto agregado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "actualizar":
                    $id_producto = $_POST["id_producto"] ?? null;
                    $nombre = trim($_POST['nombre'] ?? '');
                    $descripcion = trim($_POST['descripcion'] ?? '');
                    $cantidad = trim($_POST['cantidad'] ?? '');
                    $id_vendedor = trim($_POST['id_vendedor'] ?? '');
                    $estado = trim($_POST['estado'] ?? '');

                    if ($id_producto && $nombre && $descripcion && $cantidad && $id_vendedor && $estado) {
                        $resultado = $this->productoService->actualizarProducto(
                            $id_producto, $nombre, $descripcion, $cantidad, $id_vendedor, $estado
                        );
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Producto actualizado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "eliminar":
                    $id_producto = $_POST["id_producto"] ?? null;

                    if ($id_producto) {
                        $resultado = $this->productoService->eliminarProducto($id_producto);
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Producto eliminado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>El ID del producto es obligatorio.</p>";
                    }
                    break;
            }
        }

     
        $productos = $this->productoService->obtenerProductos();

        require __DIR__ . "/../Vista//Producto.php";
    }
}
