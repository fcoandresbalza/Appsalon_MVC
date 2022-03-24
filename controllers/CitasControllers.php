<?php

namespace Controllers;

use MVC\Router;


class CitasControllers {
    public static function index(Router $router) {
        if(!$_SESSION){
            session_start(); 

            isAuth();
        }

        $router->render('citas/index',[
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}