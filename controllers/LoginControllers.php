<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginControllers {
    public static function login(Router $router) {
        $alertas = [];
        $auth = new Usuario();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth->sincronizar($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario){
                    // Validar confirmacion y password
                  if($usuario->validarPasswordAndConfirmado($auth->password)){
                      session_start();
                      $_SESSION['id'] = $usuario->id;
                      $_SESSION['nombre'] = $usuario->nombre .' '. $usuario->apellido;
                      $_SESSION['email'] = $usuario->email;
                      $_SESSION['login'] = true;

                      if($usuario->admin === '1'){
                          $_SESSION['admin'] = $usuario->admin ?? null;
                          header('Location: /admin');
                      } else {
                          header('Location: /citas');
                      }
                  } else {
                      Usuario::setAlerta('errores', 'El Password es Incorrecto o el Email no está Confirmado');
                  }

                } else {
                    Usuario::setAlerta('errores', 'El Email no está registrado');
                }

            }
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        if($_SESSION){
            session_start();

            $_SESSION = [];

            header('Location: /');
        }
        
        
    }

    public static function olvidar(Router $router) {
        
        $alertas = [];
        $auth = new Usuario();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth->sincronizar($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
            
                if($usuario && $usuario->confirmado === '1'){

                    $usuario->crearToken();
                    $usuario->guardar();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->reestablecerPassword();

                    Usuario::setAlerta('exito', 'Se enviaron las instrucciones a tu email');

                } else {
                    Usuario::setAlerta('errores', 'El email no es valido o no está confirmado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/olvidar', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router) {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('errores', 'El token no es valido');
            $error = true;
        }

        $password = new Usuario ();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password->sincronizar($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = null;
                
                $usuario->token = "";
                $usuario->password = $password->password;
                $usuario->hashPassword();
                
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recuperar',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function crear(Router $router) {
        
        $usuario = new Usuario();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // Validar que no hayan alertas
            if(empty($alertas)){
                $respuesta = $usuario->verificarCorreo();
                
                if($respuesta->num_rows){
                    $alertas = Usuario::getAlertas();
                } else{
                    // Metodo para hashear el password
                    $usuario->hashPassword();
                    
                    // Metodo para crear el token
                    $usuario->crearToken();
                    
                    // Para enviar el email con el token
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('errores', 'El token no es Valido');
        } else {
            $usuario->confirmado = "1";
            $usuario->token = "";
            $usuario->guardar();
            Usuario::setAlerta('exito', 'La cuenta ha sido comprobada. Ahora puedes iniciar sesión');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas'=> $alertas
        ]);
    }
}