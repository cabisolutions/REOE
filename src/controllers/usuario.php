<?php
require('vendor/autoload.php');
require_once './conexion.php';

use Rakit\Validation\Validator;

$accion = 'Crear usuario';
$errors = null;
$requerido = 'required';
if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $accion = 'Editar usuario';
    $requerido = '';
    $sql = 'select 
    u.id, u.direccion_id, u.nombre, u.primer_apellido,
    u.segundo_apellido, u.sexo, u.fecha_nacimiento, u.numero_celular, 
    u.correo_electronico, u.contrasena, u.perfil, u.estatus, u.identificacion,
    u.comprobante_domicilio, d.id, d.estado_id, d.municipio_id, d.calle, d.colonia, d.numero_exterior,
    d.numero_interior, d.codigo_postal 
    from 
    usuarios u 
    inner join direcciones d on u.direccion_id = d.id 
    where 
    u.id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $usuario) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $usuario);
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    
    if (!isset($segment) || empty($segment->get('id')) || 'Cliente' == $segment->get('perfil')) {
        $_POST['perfil'] = 'Cliente';
        $_POST['estatus'] = 'Activo';
    }

    //$fotosRequerido = 'required|uploaded_file:jpg';
    $fotosRequerido = 'required|uploaded_file:jpg';
    if($_GET['id']){
        $fotosRequerido = 'nullable';
    }
    
    // validamos los datos
    $validator = new Validator;
    $validation = $validator->make($_POST + $_FILES, [
        'nombre' => 'required|min:4|max:45',
        'primer_apellido' => 'required|min:4|max:45',
        'segundo_apellido' => 'required|min:4|max:45',
        'sexo' => 'required|in:Femenino,Masculino',
        'fecha_nacimiento' => 'required|date:Y-m-d|before:yesterday',
        'numero_celular' => 'required|min:10|max:45',
        'correo_electronico' => 'required|email',
        'contrasena' => 'nullable|min:8',
        'contrasena_confirma' => 'nullable|same:contrasena',
        'perfil' => 'required|in:Administrador,Cliente',
        'estatus' => 'required|in:Activo,Inactivo',
        'identificacion' =>  $fotosRequerido,
        'comprobante_domicilio' => $fotosRequerido,
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
    //include_once('resources/views/usuario.php');
}
if ('GET' == $_SERVER['REQUEST_METHOD']  || $validation->fails()) {
    include_once('resources/views/usuario.php');
} else {
    // es post y todo está bien
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        //actualizamos
        include_once('src/models/usuario_actualizar.php');
    } else {
        //creamos
        include_once('src/models/usuario_crear.php');
    }
}
