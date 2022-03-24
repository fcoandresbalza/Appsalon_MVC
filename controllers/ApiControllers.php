<?php

namespace Controllers;

use Model\AdminCitas;
use Model\Cita;
use Model\Servicios;
use Model\CitaServicio;

class ApiControllers {
    public static function index (){
        $servicios = Servicios::all();
        echo json_encode($servicios);
    }

    public static function guardar(){
        // Almacena la cita y sus datos
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        //Almacena el id de la cita y sus servicios

        $idServicios = explode(",", $_POST['servicios']);

        foreach($idServicios as $idServicio){
            $args = [
                'citasid' => $id,
                'serviciosid' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        $respuesta = [
            'resultado' => $resultado
        ];
        
        echo json_encode($respuesta);
    }

    public static function eliminar() {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $cita = $_POST['id'];
            $respuesta = Cita::find($cita);
            $respuesta->eliminar();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}