<?php
class PedidoService {
    private $urlPedido = "http://localhost:8080/pedido";

    public function obtenerPedidos() {
        $respuesta = file_get_contents($this->urlPedido);
        if ($respuesta === false) {
            return [
                "success" => false,
                "error" => "Error al consumir el servicio de pedidos en $this->urlPedido"
            ];
        }

        $pedidos = json_decode($respuesta, true);

        return [
            "success" => true,
            "data" => $pedidos
        ];
    }

    public function crearPedido($id_cliente, $fecha_pedido, $total, $estado) {
        $datos = [
            "id_cliente"    => $id_cliente,
            "fecha_pedido"  => $fecha_pedido,
            "total"         => $total,
            "estado"        => $estado
        ];

        $proceso = curl_init($this->urlPedido);
        curl_setopt($proceso, CURLOPT_POST, true);
        curl_setopt($proceso, CURLOPT_POSTFIELDS, json_encode($datos)); 
        curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($proceso, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen(json_encode($datos))
        ]);

        $respuesta = curl_exec($proceso);
        $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

        if (curl_errno($proceso)) {
            return ["success" => false, "error" => curl_error($proceso)];
        }

        curl_close($proceso);

        if ($http_code === 200 || $http_code === 201) {
            return ["success" => true, "data" => json_decode($respuesta, true)];
        } else {
            return ["success" => false, "error" => "HTTP $http_code"];
        }
    }

    public function actualizarPedido($id_pedido, $id_cliente, $fecha_pedido, $total, $estado) {
        $datos = [
            "id_cliente"    => $id_cliente,
            "fecha_pedido"  => $fecha_pedido,
            "total"         => $total,
            "estado"        => $estado
        ];

        $url = $this->urlPedido . "/" . $id_pedido;
        $proceso = curl_init($url);
        curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($proceso, CURLOPT_POSTFIELDS, json_encode($datos)); 
        curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($proceso, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen(json_encode($datos))
        ]);

        $respuesta = curl_exec($proceso);
        $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

        if (curl_errno($proceso)) {
            return ["success" => false, "error" => curl_error($proceso)];
        }

        curl_close($proceso);

        if ($http_code === 200) {
            return ["success" => true, "data" => json_decode($respuesta, true)];
        } else {
            return ["success" => false, "error" => "HTTP $http_code"];
        }
    }

    public function eliminarPedido($id_pedido) {
        $url = $this->urlPedido . "/" . $id_pedido;
        $proceso = curl_init($url);

        curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);

        $respuesta = curl_exec($proceso);
        $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

        if (curl_errno($proceso)) {
            return ["success" => false, "error" => curl_error($proceso)];
        }

        curl_close($proceso);

        if ($http_code === 200 || $http_code === 204) {
            return ["success" => true, "data" => json_decode($respuesta, true)];
        } else {
            return ["success" => false, "error" => "HTTP $http_code"];
        }
    }
}
?>
