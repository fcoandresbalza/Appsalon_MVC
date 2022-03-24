<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\ApiControllers;
use Controllers\AdminControllers;
use Controllers\CitasControllers;
use Controllers\LoginControllers;
use Controllers\ServiciosControllers;

$router = new Router();

// Inicio de sesión para el usuario
$router->get('/',[LoginControllers::class, 'login']);
$router->post('/',[LoginControllers::class, 'login']);

// Para cerrar sesión
$router->get('/logout',[LoginControllers::class, 'logout']);
$router->post('/logout',[LoginControllers::class, 'logout']);

//Para recuperar cuenta por olvido de password
$router->get('/olvidar', [LoginControllers::class, 'olvidar']);
$router->post('/olvidar', [LoginControllers::class, 'olvidar']);
$router->get('/recuperar', [LoginControllers::class, 'recuperar']);
$router->post('/recuperar', [LoginControllers::class, 'recuperar']);

// Para crear cuenta
$router->get('/crear-cuenta', [LoginControllers::class, 'crear']);
$router->post('/crear-cuenta', [LoginControllers::class, 'crear']);
$router->get('/mensaje', [LoginControllers::class, 'mensaje']);

// Para confirmar cuenta nueva
$router->get('/confirmar-cuenta', [LoginControllers::class, 'confirmar']);

// Zona Privada
$router->get('/citas', [CitasControllers::class, 'index']);
$router->get('/admin', [AdminControllers::class, 'index']);

//API de citas
$router->get('/api/servicios', [ApiControllers::class, 'index']);
$router->post('/api/citas', [ApiControllers::class, 'guardar']);
$router->post('/api/eliminar', [ApiControllers::class, 'eliminar']);

//Crud para servicios
$router->get('/servicios', [ServiciosControllers::class, 'index']);
$router->get('/servicios/crear', [ServiciosControllers::class, 'crear']);
$router->post('/servicios/crear', [ServiciosControllers::class, 'crear']);
$router->get('/servicios/actualizar', [ServiciosControllers::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServiciosControllers::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServiciosControllers::class, 'eliminar']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();