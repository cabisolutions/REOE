<?php
require('vendor/autoload.php');

use Rakit\Validation\Validator;

require_once './conexion.php';
$accion = 'Crear usuario';
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
            // validamos los datos
            $validator = new Validator;
            $validation = $validator->make($_POST, [
                'nombre' => 'required|min:4|max:45',
                'primer_apellido' => 'required|min:4|max:45',
                'segundo_apellido' => 'nullable|max:45',
                'sexo' => 'required|in:Femenino,Masculino',
                'fecha_nacimiento' => 'required|date:Y-m-d|before:yesterday',
                'numero_celular' => 'required|min:10|max:45',
                'correo_electronico' => 'required|email',
                'contrasena' => 'nullable|min:8',
                'contrasena_confirma' => 'nullable|same:contrasena',
                'perfil' => 'required|in:Administrador,Cliente',
                'estatus' => 'required|in:Activo,Inactivo',
                'calle' => 'required|min:2',
                'colonia' => 'required|min:3',
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
        }
            // es post y todo está bien
            if (isset($_POST['id_usuario']) && is_numeric($_POST['id_usuario'])) {
                
                //actualizamos
                include_once('./php/usuario_actualizar.php');
            } else {
                //creamos
                include_once('./php/usuario_crear.php');
            }

