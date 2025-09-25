<?php
class VendedorService {
    private $urlVendedor = "http://localhost:8080/vendedor";

    public function obtenerVendedores() {
        $respuesta = file_get_contents($this->urlVendedor);
        if ($respuesta === FALSE) return [];

        return json_decode($respuesta, true);
    }

    public function agregarVendedor($nombre, $apellido, $correo_electronico, $telefono, $contrasena) {
        $datos = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "correo_electronico" => $correo_electronico,
            "telefono" => $telefono,
            "contrasena" => $contrasena
        ];

        $data_json = json_encode($datos);
        $proceso = curl_init($this->urlVendedor);
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

    public function actualizarVendedor($id_vendedor, $nombre, $apellido, $correo_electronico, $telefono, $contrasena) {
        $datos = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "contrasena" => $contrasena,
            "telefono" => $telefono,
            "correo_electronico" => $correo_electronico
        ];

        $data_json = json_encode($datos);
        $url = $this->urlVendedor . "/" . $id_vendedor; 
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

    public function eliminarVendedor($id_vendedor) {
        $url = $this->urlVendedor . "/" . $id_vendedor;
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