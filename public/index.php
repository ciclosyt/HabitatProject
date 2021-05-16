<?php 

require_once  __DIR__.'/../includes/app.php';

use MVC\Router;
use Controllers\InmuebleController;
use Controllers\ProprietarioController;
use Controllers\PaginasController;
use Controllers\LoginController;

$router = new Router();

// zona privada
$router->get('/admin', [InmuebleController::class, 'index']);
$router->get('/inmueble/crear', [InmuebleController::class, 'crear']);
$router->post('/inmueble/crear', [InmuebleController::class, 'crear']);
$router->get('/inmueble/actualizar', [InmuebleController::class, 'actualizar']);
$router->post('/inmueble/actualizar', [InmuebleController::class, 'actualizar']);
$router->post('/inmueble/eliminar', [InmuebleController::class, 'eliminar']);

// rutas para Proprietarios 
$router->get('/proprietario/crear', [ProprietarioController::class, 'crear']);
$router->post('/proprietario/crear', [ProprietarioController::class, 'crear']);
$router->get('/proprietario/actualizar', [ProprietarioController::class, 'actualizar']);
$router->post('/proprietario/actualizar', [ProprietarioController::class, 'actualizar']);
$router->post('/proprietario/eliminar', [ProprietarioController::class, 'eliminar']);

// zona publica

$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/inmuebles', [PaginasController::class, 'inmuebles']);
$router->get('/inmueble', [PaginasController::class, 'inmueble']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

//login y autenticacion

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->post('/pwd', [LoginController::class, 'pwd']);
$router->get('/pwd', [LoginController::class, 'pwd']);

$router->getURL();