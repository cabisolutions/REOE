<?php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';

// Use this namespace
use Steampixel\Route;

define('BASEPATH',"/reoe/");

function navi() {
    echo '
    Navigation:
    <ul>
        <li><a href="'.BASEPATH.'">home</a></li>
        <li><a href="'.BASEPATH.'index.php">index.php</a></li>
        <li><a href="'.BASEPATH.'user/3/edit">edit user 3</a></li>
        <li><a href="'.BASEPATH.'foo/5/bar">foo 5 bar</a></li>
        <li><a href="'.BASEPATH.'foo/bar/foo/bar">long route example</a></li>
        <li><a href="'.BASEPATH.'contact-form">contact form</a></li>
        <li><a href="'.BASEPATH.'get-post-sample">get+post example</a></li>
        <li><a href="'.BASEPATH.'test.html">test.html</a></li>
        <li><a href="'.BASEPATH.'blog/how-to-use-include-example">How to push data to included files</a></li>
        <li><a href="'.BASEPATH.'phpinfo">PHP Info</a></li>
        <li><a href="'.BASEPATH.'äöü">Non english route: german</a></li>
        <li><a href="'.BASEPATH.'الرقص-العربي">Non english route: arabic</a></li>
        <li><a href="'.BASEPATH.'global/test123">Inject variables to local scope</a></li>
        <li><a href="'.BASEPATH.'return">Return instead of echo test</a></li>
        <li><a href="'.BASEPATH.'arrow/test123">Arrow function test (please enable this route first)</a></li>
        <li><a href="'.BASEPATH.'aTrailingSlashDoesNotMatter">aTrailingSlashDoesNotMatter</a></li>
        <li><a href="'.BASEPATH.'aTrailingSlashDoesNotMatter/">aTrailingSlashDoesNotMatter/</a></li>
        <li><a href="'.BASEPATH.'theCaseDoesNotMatter">theCaseDoesNotMatter</a></li>
        <li><a href="'.BASEPATH.'thecasedoesnotmatter">thecasedoesnotmatter</a></li>
        <li><a href="'.BASEPATH.'this-route-is-not-defined">404 Test</a></li>
        <li><a href="'.BASEPATH.'this-route-is-defined">405 Test</a></li>
        <li><a href="'.BASEPATH.'known-routes">known routes</a></li>
    </ul>
    ';
  }
// Add your first route
Route::add('/', function() {
    //navi();
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

Route::add('/salir', function() {
    include('salir.php');
});

Route::add('/resumen', function() {
    include('checa_sesion.php');
    include('resources/views/resumen.php');
});

Route::add('/rentas', function() {
    include('rentas.php');
});

Route::add('/renta', function() {
    include('renta.php');
}, ['get','post']);

Route::add('/espacios', function() {
    include('checa_sesion.php');
    include('espacios.php');
});

Route::add('/espacio', function() {
    include('checa_sesion.php');
    include('src/controllers/espacio.php');
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
    include('checa_sesion.php');
    include('resources/views/usuarios.php');
});

Route::add('/usuario', function() {
    include('checa_sesion.php');
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
