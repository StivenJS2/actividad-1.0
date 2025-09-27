<?php
class CarritoService {
    private $urlCarrito= "http://localhost:8080/carrito";

    public function obtenerCarritos() {
        $respuesta = file_get_contents($this->urlCarrito);
        if ($respuesta === FALSE) return [];

    return  json_decode($respuesta, true);

    }

    public function agregarCarrito($id_carrito, $id_cliente, $id_detalle_producto, $cantidad, $precio_unitario, $subtotal) {
        $datos = [
            "id_carrito" => $id_carrito,
            "id_cliente" => $id_cliente,
            "id_detalle_producto" => $id_detalle_producto,
            "cantidad" => $cantidad,
            "precio_unitario" => $precio_unitario,
            "subtotal" => $subtotal
        ];

        $data_json = json_encode($datos);
        $proceso = curl_init($this->urlCarrito);
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


    public function eliminarCarrito($id_carrito) {
    $url = $this->urlCarrito . "/" . $id_carrito;
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