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
    include('resources/views/catalogo.php');
}, ['get','post']);

Route::add('/usuario', function() {
    include('src/controllers/usuario.php');
}, ['get','post']);

Route::add('/administracion', function() {
    include('resources/views/administracion.php');
});

Route::add('/admin-usuarios', function() {
    include('src/vistas/usuarios.php');
});

Route::add('/admin-espacios', function() {
    include('./espacios.php');
});

Route::add('/espacio', function() {
    include('./espacio.php');
}, ['get','post']);

Route::add('/servicio', function() {
    include('./servicio.php');
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
