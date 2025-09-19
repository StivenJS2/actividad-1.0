<?php

require_once "CRUD_PEDIDO.php";

$RTA = readline ("tienes acceso para ver esta informacion? (S/N): \n");

    if ($RTA == 'N' || $RTA == 'n'){
        echo "No puedes acceder a esta sección\n";
        exit();
    }

    if ($RTA != 'S' && $RTA != 's' && $RTA != 'N' && $RTA != 'n'){
        echo "Respuesta no válida\n";
        exit();
    }

        if ($RTA == 'S' || $RTA == 's'){
            
            do{
            
                echo "Bienvenido\n";
                echo "-------------------------------------\n";
                echo "¿Qué deseas hacer?\n";

                echo "1. Ver pedido\n";
                echo "2. Crear pedido\n";
                echo "3. Actualizar pedido\n";
                echo "4. Eliminar pedido\n";

                $respuesta = readline("Elige opción: ");

                switch($respuesta){

                    case 1: obtenerPedidos(); break;
                    case 2: crearPedido(); break;
                    case 3: actualizarPedido(); break;
                    case 4: eliminarPedido(); break;
                    default: echo "Opción no válida\n"; break;
                }

                $n1 = readline("¿Deseas realizar otra acción? (S/N): ");

            }while ($n1 == 'S' || $n1 == 's');

            echo "Hasta luego.\n";
            exit();

        }

?>
