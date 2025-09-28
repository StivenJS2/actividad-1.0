<?php
require_once __DIR__ . "/../Modelo/ModuloCategoria/CategoriaService.php";

class CategoriaController {
    private $CategoriaService;
   
    public function __construct() {
        // Asegúrate que coincide con el nombre de la clase real
        $this->CategoriaService = new CategoriaService();
    }
   
    public function manejarPeticion() {
        $mensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accion = $_POST["_action"] ?? "";

            switch ($accion) {
               case "agregar":
                     $nombre = trim($_POST['nombre'] ?? '');

                      if ($nombre !== '') {
                         $resultado = $this->CategoriaService->crearCategoria($nombre);
                          $mensaje = $resultado["success"]
                          ? "<p style='color:green;'>Categoría agregada correctamente</p>"
                          : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";} 
                             else {
                            $mensaje = "<p style='color:red;'>El nombre de la categoría es obligatorio.</p>";
                            }
                             break;


                case "actualizar":
                    $id_categoria = intval(trim($_POST["id_categoria"] ?? 0));
                    $nombre       = trim($_POST['nombre'] ?? '');

                    if ($id_categoria > 0 && $nombre !== '') {
                        $resultado = $this->CategoriaService->actualizarCategoria(
                            $id_categoria, $nombre
                        );
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Categoría actualizada correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>Todos los campos son obligatorios.</p>";
                    }
                    break;

                case "eliminar":
                    $id_categoria = intval(trim($_POST["id_categoria"] ?? 0));

                    if ($id_categoria > 0) {
                        $resultado = $this->CategoriaService->eliminarCategoria($id_categoria);
                        $mensaje = $resultado["success"]
                            ? "<p style='color:green;'>Categoría eliminada correctamente</p>"
                            : "<p style='color:red;'>Error: " . $resultado["error"] . "</p>";
                    } else {
                        $mensaje = "<p style='color:red;'>El ID de la categoría es obligatorio.</p>";
                    }
                    break;
            }
        }

        $categorias = $this->CategoriaService->obtenerCategorias();

        require __DIR__ . "/../Vista/Categoria.php";
    }
}
