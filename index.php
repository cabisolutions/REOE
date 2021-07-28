<?php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';

// Use this namespace
use Steampixel\Route;

// Add your first route
Route::add('/', function() {
    include('resources/views/inicio.php');
});

Route::add('/catalogo', function() {
    include('src/controllers/catalogo.php');
}, ['get','post']);

Route::add('/sesion', function() {
    include('sesion.php');
}, ['get','post']);

Route::add('/resumen', function() {
    include('resources/views/resumen_panel_administracion.php');
});

Route::add('/rentas', function() {
    include('rentas.php');
});

Route::add('/renta', function() {
    include('renta.php');
}, ['get','post']);

Route::add('/espacios', function() {
    include('espacios.php');
});

Route::add('/espacio', function() {
    include('espacio.php');
}, ['get','post']);

Route::add('/tipo_espacios', function() {
    include('tipos_espacios.php');
});

Route::add('/tipo_espacio', function() {
    include('agregar_tipo_espacio.php');
}, ['get','post']);

Route::add('/servicios', function() {
    include('servicios.php');
});

Route::add('/servicio', function() {
    include('servicio.php');
}, ['get','post']);

Route::add('/usuarios', function() {
    include('resources/views/usuarios.php');
});

Route::add('/usuario', function() {
    include('src/controllers/usuario.php');
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
