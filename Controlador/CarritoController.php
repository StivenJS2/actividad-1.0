<?php
require_once __DIR__ . "/../Modelo/ModuloCarrito/CarritoService.php";

class CarritoController {
    private $carritoService;

    public function __construct() {
        $this->carritoService = new CarritoService();
    }

    public function manejarPeticion() {
        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST["_action"] ?? "";

            switch ($accion) {
                case "agregar":
                    $id_carrito = trim($_POST['id_carrito'] ?? '');
                    $id_cliente = trim($_POST['id_cliente'] ?? '');
                    $id_detalle_producto = trim($_POST['id_detalle_producto'] ?? '');
                    $cantidad = trim($_POST['cantidad'] ?? '');
                    $precio_unitario = trim($_POST['precio_unitario'] ?? '');
                    $subtotal = trim($_POST['subtotal'] ?? '');

                    if ($id_carrito && $id_cliente && $id_detalle_producto && $cantidad && $precio_unitario && $subtotal) {
                        $resultado = $this->carritoService->agregarCarrito(
                            $id_carrito, $id_cliente, $id_detalle_producto, $cantidad, $precio_unitario, $subtotal
                        );
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Carrito agregado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "eliminar":
                    $id_carrito = trim($_POST['id_carrito'] ?? '');

                    if ($id_carrito) {
                        $resultado = $this->carritoService->eliminarCarrito($id_carrito);
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Carrito eliminado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>El ID del carrito es obligatorio.</p>";
                    }   
                    break;

                default:
                    $mensaje = "<p style='color:red;'>Acción no válida.</p>";
                    break;
            }
        }

        $carritos = $this->carritoService->obtenerCarritos();

        require_once __DIR__ . "/../Vista/Carrito.php";
        
    }

}

?>