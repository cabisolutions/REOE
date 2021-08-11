<?php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';

// Use this namespace
use Steampixel\Route;

define('BASEPATH',"/reoe/");

// Add your first route
Route::add('/', function() {
    include('checa_sesion.php');
    include('resources/views/inicio.php');
});

Route::add('/catalogo', function() {
    include('checa_sesion.php');
    include('src/controllers/catalogo.php');
}, ['get','post']);

Route::add('/sesion', function() {
    include('checa_sesion.php');
    include('src/models/sesion.php');
}, ['get','post']);

Route::add('/cuenta', function() {
    include('checa_sesion.php');
    include('resources/views/cuenta.php');
    
});

Route::add('/detalle_espacio', function() {
    include('checa_sesion.php');
    include('detalle_espacio.php');
});

Route::add('/salir', function() {
    include('salir.php');
});

Route::add('/resumen', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    $usuario = '';
    include('resources/views/resumen.php');
});

Route::add('/rentas', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    include('rentas.php');
    $usuario = '';
});

Route::add('/renta', function() {
    include('checa_sesion.php');
    include('renta.php');
    $usuario = '';
}, ['get','post']);

Route::add('/espacios', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    $usuario = '';
    include('espacios.php');
});

Route::add('/espacio', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    $usuario = '';
    include('src/controllers/espacio.php');
}, ['get','post']);

Route::add('/tipo_espacios', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    $usuario = 'Administrador';
    include('tipos_espacios.php');
});

Route::add('/tipo_espacio', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    include('agregar_tipo_espacio.php');
    $usuario = '';
}, ['get','post']);


Route::add('/servicios', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    include('servicios.php');
    $usuario = '';
});

Route::add('/servicio', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    include('servicio.php');
    $usuario = '';
}, ['get','post']);

Route::add('/usuarios', function() {
    $usuario = 'Administrador';
    include('checa_sesion.php');
    $usuario = '';
    include('resources/views/usuarios.php');
});

Route::add('/usuario', function() {
    include('checa_sesion.php');
    include('src/controllers/usuario.php');
}, ['get','post']);

Route::add('/olvide_contrasena', function() {
    include('checa_sesion.php');
    include('src/controllers/contrasena_olvidada.php');
}, ['get','post']);

Route::add('/restaurar_contrasena', function() {
    include('checa_sesion.php');
    include('src/controllers/restaurar_contrasena.php');
}, ['get','post']);

// Add a 404 not found route
Route::pathNotFound(function($path) {
    // Do not forget to send a status header back to the client
    // The router will not send any headers by default
    // So you will have the full flexibility to handle this case
    header('HTTP/1.0 404 Not Found');
    include('./error-no-encontrado.php');
  });

// Run the router
Route::run('/reoe');
