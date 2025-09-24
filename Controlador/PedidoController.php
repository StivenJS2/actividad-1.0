<?php
require_once __DIR__ . "/../Modelo/ModuloPedido/PedidoService.php";

class PedidoController {
    private $pedidoService;
   
    public function __construct() {
        $this->pedidoService = new PedidoService();
    }
   
    public function manejarPeticion() {
        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST["_action"] ?? "";

            switch ($accion) {
                case "agregar":
                    $id_cliente = trim($_POST['id_cliente'] ?? '');
                    $fecha_pedido = trim($_POST['fecha_pedido'] ?? '');
                    $total = trim($_POST['total'] ?? '');
                    $estado = trim($_POST['estado'] ?? '');

                    if ($id_cliente && $fecha_pedido && $total && $estado) {
                        $resultado = $this->pedidoService->crearPedido(
                            $id_cliente, $fecha_pedido, $total, $estado
                        );
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Pedido agregado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "actualizar":
                    $id_pedido = $_POST["id_pedido"] ?? null;
                    $id_cliente = trim($_POST['id_cliente'] ?? '');
                    $fecha_pedido = trim($_POST['fecha_pedido'] ?? '');
                    $total = trim($_POST['total'] ?? '');
                    $estado = trim($_POST['estado'] ?? '');

                    if ($id_pedido && $id_cliente && $fecha_pedido && $total && $estado) {
                        $resultado = $this->pedidoService->actualizarPedido(
                            $id_pedido, $id_cliente, $fecha_pedido, $total, $estado
                        );
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Pedido actualizado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "eliminar":
                    $id_pedido = $_POST["id_pedido"] ?? null;

                    if ($id_pedido) {
                        $resultado = $this->pedidoService->eliminarPedido($id_pedido);
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Pedido eliminado correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>El ID del pedido es obligatorio.</p>";
                    }
                    break;
            }
        }

        $pedidos = $this->pedidoService->obtenerPedidos();

        require __DIR__ . "/../Vista/Pedido.php";
    }
}
