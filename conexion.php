<?php
require_once('./vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$dsn = 'mysql:host=' . $_ENV['BD_HOST'] . ':' . $_ENV['BD_PUERTO'] . ';dbname=' . $_ENV['BD_NOMBRE'];
$nombre_usuario = $_ENV['BD_USUARIO'];
$contrasena = $_ENV['BD_CONTRASENA'];
$opciones = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
    , PDO::ATTR_EMULATE_PREPARES => false
    , PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]; 

$conexion = new PDO($dsn, $nombre_usuario, $contrasena, $opciones);

//print_r($conexion);
//
//$sql = 'select * from estados where id = 1';
//
//foreach ($conexion->query($sql, PDO::FETCH_ASSOC) as $row) {
//     print_r($row);
//}