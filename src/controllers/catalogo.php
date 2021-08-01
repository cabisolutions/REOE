<?php
require_once './conexion.php';
if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['busqueda'])) {
    include_once('src/models/catalogo_buscar.php');
    include_once('resources/views/catalogo.php');
    exit();
} 
else 
if(!isset($pagina_inicio) || $pagina_inicio == false){
    $sql = <<<fin
    select
        e.id,
        e.disponible_para,
        e.nombre,
        e.costo_renta_dia,
        e.metros_cuadrados
    from
        espacios e
    fin;

$sentencia = $conexion->prepare($sql);
$sentencia->execute();
include_once('resources/views/catalogo.php');
}

if(isset($pagina_inicio) && $pagina_inicio){
    include_once('src/models/catalogo_mini.php');
    foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $row) {
        include('resources/components/tarjeta_espacio.php');
    }
}
