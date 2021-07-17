<?php
$sql = <<<fin
    insert into direcciones(
    estado_id, 
    municipio_id, 
    calle,
    colonia, 
    numero_exterior, 
    numero_interior, 
    codigo_postal
    ) values (
    :estado_id, 
    :municipio_id, 
    :calle, 
    :colonia, 
    :numero_exterior, 
    :numero_interior, 
    :codigo_postal
    )
    fin;

//$contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT, $opciones);
$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':estado_id', $_POST['estado_id_usuario'], PDO::PARAM_INT);
$sentencia->bindValue(':municipio_id', $_POST['municipio_id_usuario'], PDO::PARAM_INT);
$sentencia->bindValue(':calle', $_POST['calle_usuario'], PDO::PARAM_STR);
$sentencia->bindValue(':colonia', $_POST['colonia_usuario'], PDO::PARAM_STR);
$sentencia->bindValue(':numero_exterior', $_POST['numero_exterior_usuario'], PDO::PARAM_STR);
$sentencia->bindValue(':numero_interior', $_POST['numero_interior_usuario'], PDO::PARAM_STR);
$sentencia->bindValue(':codigo_postal', $_POST['codigo_postal_usuario'], PDO::PARAM_STR);
$sentencia->execute();

$direccion_id = $conexion->lastInsertId();

$sql = <<<fin
    insert into usuarios (
        direccion_id, 
        nombre, 
        primer_apellido, 
        segundo_apellido, 
        sexo, 
        fecha_nacimiento, 
        numero_celular, 
        correo_electronico, 
        contrasena, 
        perfil, 
        estatus, 
        identificacion, 
        comprobante_domicilio
    ) values (
        :direccion_id, 
        :nombre, 
        :primer_apellido, 
        :segundo_apellido, 
        :sexo, 
        :fecha_nacimiento, 
        :numero_celular, 
        :correo_electronico, 
        :contrasena, 
        :perfil, 
        :estatus, 
        :identificacion, 
        :comprobante_domicilio
    )
    fin;
// Encriptamos la contraseña
$opciones = [
    'cost' => 12,
];

if (is_uploaded_file($_FILES['identificacion']['tmp_name'])) {
    $nombre_identificacion = uniqid('id-', true) . '.jpg'; // se supone sólo se admiten .jpg
    // mover archivo a su ubicación final
    move_uploaded_file($_FILES['identificacion']['tmp_name'], './usuarios/identificaciones/' . $nombre_identificacion);
}
if (is_uploaded_file($_FILES['comprobante_domicilio']['tmp_name'])) {
    $nombre_comprobante_domicilio = uniqid('cd-', true) . '.jpg'; // se supone sólo se admiten .jpg
    // mover archivo a su ubicación final
    move_uploaded_file($_FILES['comprobante_domicilio']['tmp_name'], './usuarios/comprobantes_domicilio/' . $nombre_comprobante_domicilio);
}

$contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT, $opciones);
$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':direccion_id', $direccion_id, PDO::PARAM_STR);
$sentencia->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
$sentencia->bindValue(':primer_apellido', $_POST['primer_apellido'], PDO::PARAM_STR);
$sentencia->bindValue(':segundo_apellido', $_POST['segundo_apellido'], PDO::PARAM_STR);
$sentencia->bindValue(':sexo', $_POST['sexo'], PDO::PARAM_STR);
$sentencia->bindValue(':fecha_nacimiento', $_POST['fecha_nacimiento'], PDO::PARAM_STR);
$sentencia->bindValue(':numero_celular', $_POST['numero_celular'], PDO::PARAM_STR);
$sentencia->bindValue(':correo_electronico', $_POST['correo_electronico'], PDO::PARAM_STR);
$sentencia->bindValue(':contrasena', $contrasena, PDO::PARAM_STR);
$sentencia->bindValue(':perfil', $_POST['perfil'], PDO::PARAM_STR);
$sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
$sentencia->bindValue(':identificacion', $nombre_identificacion, PDO::PARAM_STR);
$sentencia->bindValue(':comprobante_domicilio', $nombre_comprobante_domicilio, PDO::PARAM_STR);
$sentencia->execute();

$respuesta = array('estatus' => 'Ok', 'mensaje' => 'Usuario creado');
echo json_encode($respuesta);
?>