<?php
require('vendor/autoload.php');

use Rakit\Validation\Validator;

require_once './conexion.php';
$accion = 'Crear espacio';
$requerido = 'required';
if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $accion = 'Editar espacio';
    $requerido = '';
    $sql = 'select 
    e.id, e.direccion_id, e.nombre, e.descripcion,
    e.metros_cuadrados, e.disponible_para, e.estatus, e.costo, 
    e.costo_renta_dia, d.id, d.estado_id, d.municipio_id, d.calle, d.colonia, d.numero_exterior,
    d.numero_interior, d.codigo_postal
    from 
    espacios e
    inner join direcciones d on e.direccion_id = d.id 
    where 
    e.id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $espacio = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $espacio) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $espacio);
    $requerido = '';
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    // validamos los datos
    $validator = new Validator;
    $validation = $validator->make($_POST, [
        'nombre' => 'required|min:4|max:45',
        'descripcion' => 'required|min:50|max:500',
        'metros_cuadrados' => 'required|min:2',
        'disponible_para' => 'required|in:Renta,Intercambio',
        'estatus' => 'required|in:Disponible,Rentado,Fuera de servicio',
        'costo' => 'required|min:4',
        'costo_renta_dia' => 'required|min:3',
        'calle' => 'required|min:4|max:45',
        'colonia' => 'required|min:4|max:45',
        'numero_exterior' => 'required|min:1',
        'codigo_postal' => 'required|min:2'
    ]);

    $validation->setMessages([
        'required' => ':attribute es requerido',
        'min' => ':attribute longitud mínima no se cumple',
        'max' => ':attribute longitud máxima no se cumple'
    ]);
    // then validate
    $validation->validate();
    $errors = $validation->errors();
    $requerido = 'required';
}
if ('GET' == $_SERVER['REQUEST_METHOD']) {
    include_once('./espacio.php');
} else {
    // es post y todo está bien
   if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        //actualizamos
        include_once('src/models/espacio_actualizar.php');
    } else { 
        //creamos
        include_once('src/models/espacio_crear.php');
   }
}