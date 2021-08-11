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
    d.numero_interior, d.codigo_postal, d.mapa
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
    $requerido = '';
    $sql = '
    select 
    espacio_id, 
    tipo_espacio_id
    from 
    espacios_tipo_espacio
    where 
    espacio_id = :espacio_id';
    $tipo_espacio_id = $conexion->prepare($sql);
    //echo $_GET['id'];
    $tipo_espacio_id->bindValue(':espacio_id', $_GET['id'], PDO::PARAM_INT);
    $tipo_espacio_id->execute();
    //$mmmm = $tipo_espacio_id->fetchAll(PDO::FETCH_ASSOC);
    $tipos_espacio_id = [];
    foreach ($tipo_espacio_id->fetchAll(PDO::FETCH_ASSOC) as $row) {
        //echo '<br/><br/><br/><br/><br/>asdsadsad' . $row;
        $tipos_espacio_id['tipo_espacio_id'][] =  $row['tipo_espacio_id'];
    }
    //$_POST['tipo_espacio_id'] = $tipos_espacio_id;

    $_POST = array_merge($_POST, $tipos_espacio_id);
    $_POST = array_merge($_POST, $espacio);
    //print_r($_POST['tipo_espacio_id']);
    //$tipos_espacios = $tipos_espacios->fetch(PDO::FETCH_ASSOC);
    //if (null == $tipos_espacios) {
    //    require_once './error-no-encontrado.php';
    //    exit();
    //}
    //$_POST = array_merge($_POST, $tipos_espacios);
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $fotoRequerido = 'array';
    if (isset($_GET['id'])) {
        $fotoRequerido = 'nullable';
    } else {
        for ($numero = 0; $numero < 4; $numero++) {
            if (!is_uploaded_file($_FILES['fotografia']['tmp_name'][$numero])) {
                $fotosValidacion[] = "fotografia";
                $fotoRequerido = 'required';
            } else {
                $fotoRequerido = 'nullable';
            }
        }
    }
    // validamos los datos
    $validator = new Validator;
    $validation = $validator->make($_POST, [
        'nombre' => 'required|min:4|max:45',
        'descripcion' => 'required|min:20|max:500',
        'metros_cuadrados' => 'required|min:2',
        'tipo_espacio' => 'required',
        'disponible_para' => 'required|array:Renta,Intercambio',
        'estatus' => 'required|in:Disponible,Rentado,Fuera de servicio',
        'costo' => 'required|min:4',
        'costo_renta_dia' => 'required|min:3',
        'fotografia' => $fotoRequerido,
        'calle' => 'required|min:2',
        'colonia' => 'required|min:3',
        'numero_exterior' => 'required|min:1',
        'codigo_postal' => 'required|min:2',
        'estado_id' => 'required',
        'municipio_id' => 'required'
    ]);

    $validation->setMessages([
        'required' => ':attribute es requerido',
        'min' => ':attribute longitud mínima no se cumple',
        'max' => ':attribute longitud máxima no se cumple'
    ]);


    // then validate
    $validation->validate();
    $errors = $validation->errors();
    //print_r($errors);
    //print_r($fotosValidacion);
    $requerido = 'required';
}
if ('GET' == $_SERVER['REQUEST_METHOD'] || $validation->fails()) {
    include_once('./espacio.php');
} else {
    // es post y todo está bien
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        //actualizamos
        //print_r($pass);
        //print_r($_POST['tipo_espacio_id']);
        include_once('src/models/espacio_actualizar.php');
    } else {
        //creamos
        include_once('src/models/espacio_crear.php');
    }
}
