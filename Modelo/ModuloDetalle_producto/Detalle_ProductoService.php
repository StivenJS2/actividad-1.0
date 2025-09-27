<?php
class DetalleProductoService {
    private $urlDetalle_producto = "http://localhost:8080/detalle_producto";

    public function obtenerDetallesProducto() {
        $respuesta = file_get_contents($this->urlDetalle_producto);
        if ($respuesta === FALSE) return [];

        return json_decode($respuesta, true);
    }

    public function agregarDetalleProducto($talla, $color, $id_producto, $id_categoria, $precio) {
        $datos = [
            "talla" => $talla,
            "color" => $color,
            "id_producto" => $id_producto,
            "id_categoria" => $id_categoria,
            "precio" => $precio
        ];

        $data_json = json_encode($datos);
        $proceso = curl_init($this->urlDetalle_producto);
        curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($proceso, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen($data_json)
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

    public function actualizarDetalleProducto($id_detalle_producto, $talla, $color, $id_producto, $id_categoria, $precio) {
        $datos = [
            "talla" => $talla,
            "color" => $color,
            "id_producto" => $id_producto,
            "id_categoria" => $id_categoria,
            "precio" => $precio
        ];

        $data_json = json_encode($datos);
        $url = $this->urlDetalle_producto . "/" . $id_detalle_producto; 
        $proceso = curl_init($url);

        curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($proceso, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($proceso, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Content-Length: " . strlen($data_json)
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

    public function eliminarDetalleProducto($id_detalle_producto) {
        $url = $this->urlDetalle_producto . "/" . $id_detalle_producto;
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