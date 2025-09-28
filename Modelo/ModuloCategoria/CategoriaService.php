<?php
class categoriaService {
    private $urlCategoria = "http://localhost:8080/categoria";

    public function obtenerCategorias() {
        $respuesta = file_get_contents($this->urlCategoria);
        if ($respuesta === false) {
            return [
                "success" => false,
                "error" => "Error al consumir el servicio de categoria en $this->urlCategoria"
            ];
        }

        $categorias = json_decode($respuesta, true);

        return [
            "success" => true,
            "data" => $categorias
        ];
    }

    public function crearCategoria($nombre) {
    $datos = [
        "nombre" => $nombre
    ];

    $proceso = curl_init($this->urlCategoria);
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

  

// PUT //

    public function actualizarCategoria($id_categoria, $nombre) {
        $datos = [
            "id_categoria"=> $id_categoria,
            "nombre"    =>  $nombre,

        ];

        $url = $this->urlCategoria . "/" . $id_categoria;
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

    public function eliminarCategoria($id_categoria) {
        $url = $this->urlCategoria . "/" . $id_categoria;
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