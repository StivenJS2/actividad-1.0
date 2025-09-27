<?php
require_once __DIR__ . "/../Modelo/ModuloDetalle_Producto/Detalle_ProductoService.php";

class Detalle_ProductoController {
    private $detalle_ProductoService;
   
    public function __construct() {
        $this->detalle_ProductoService = new DetalleProductoService();
    }
   
    public function manejarPeticion() {
        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST["_action"] ?? "";

            switch ($accion) {
                case "agregar":
                    $talla = trim($_POST['talla'] ?? '');
                    $color = trim($_POST['color'] ?? '');
                    $id_producto = $_POST['id_producto'] ?? null;
                    $id_categoria = $_POST['id_categoria'] ?? null;
                    $precio = $_POST['precio'] ?? null;

                    if ($talla && $color && $id_producto && $id_categoria && $precio) {
                        $resultado = $this->detalle_ProductoService->agregarDetalleProducto(
                            $talla, $color, $id_producto, $id_categoria, $precio
                        );
                        $mensaje = $resultado["success"]
                            ? "Detalle de producto agregado correctamente"
                            : "Error: " . $resultado["error"];
                    } else {
                        $mensaje = "Todos los campos son obligatorios.";
                    }
                    break;

                case "actualizar":
                    $id_detalle_producto = $_POST["id_detalle_producto"] ?? null;
                    $talla = trim($_POST['talla'] ?? '');
                    $color = trim($_POST['color'] ?? '');
                    $id_producto = $_POST['id_producto'] ?? null;
                    $id_categoria = $_POST['id_categoria'] ?? null;
                    $precio = $_POST['precio'] ?? null;

                    if ($id_detalle_producto && $talla && $color && $id_producto && $id_categoria && $precio) {
                        $resultado = $this->detalle_ProductoService->actualizarDetalleProducto(
                            $id_detalle_producto, $talla, $color, $id_producto, $id_categoria, $precio
                        );
                        $mensaje = $resultado["success"]
                            ? "Detalle de producto actualizado correctamente"
                            : "Error: " . $resultado["error"];
                    } else {
                        $mensaje = "Todos los campos son obligatorios.";
                    }
                    break;

                case "eliminar":
                    $id_detalle_producto = $_POST["id_detalle_producto"] ?? null;

                    if ($id_detalle_producto) {
                        $resultado = $this->detalle_ProductoService->eliminarDetalleProducto($id_detalle_producto);
                        $mensaje = $resultado["success"]
                            ? "Detalle de producto eliminado correctamente"
                            : "Error: " . $resultado["error"];
                    } else {
                        $mensaje = "El ID del detalle de producto es obligatorio.";
                    }
                    break;

                default:
                    $mensaje = "Acción no válida.";
                    break;
            }
        }

        $detalles_producto = $this->detalle_ProductoService->obtenerDetallesProducto();

        require __DIR__ . "/../Vista/Detalle_Producto.php";
    }
}
