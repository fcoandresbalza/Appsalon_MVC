<?php

namespace Controllers;

use Model\Servicios;
use MVC\Router;

class ServiciosControllers {
    public static function index(Router $router) {
        if(!$_SESSION){
            session_start();
            isAdmin();
        }
        
        $servicios = Servicios::all();
        //debuguear($servicios);
        
        $router->render('/servicios/servicios', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router) {
        if(!$_SESSION){
            session_start();
            isAdmin();
        }

        $servicio = new Servicios();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio = new Servicios($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /admin');
            }
        }

        $router->render('/servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        if(!$_SESSION){
            session_start();
            isAdmin();
        }

        $id = s($_GET['id']);
        if(!is_numeric($id)){
            return;
        }
        
        $servicio = Servicios::find($id);
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }

        }

        $router->render('/servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        if(!$_SESSION){
            session_start();
            isAdmin();
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio = Servicios::find($_POST['id']);
            $servicio->eliminar();
            header('Location: /servicios');
        }
    }
}