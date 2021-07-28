<?php
$sql = <<<fin
    update direcciones set
        estado_id = :estado_id, 
        municipio_id = :municipio_id, 
        calle = :calle,
        colonia = :colonia, 
        numero_exterior = :numero_exterior, 
        numero_interior = :numero_interior, 
        codigo_postal = :codigo_postal
    where
        id = :id
    fin;

$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':estado_id', $_POST['estado_id'], PDO::PARAM_INT);
$sentencia->bindValue(':municipio_id', $_POST['municipio_id'], PDO::PARAM_INT);
$sentencia->bindValue(':calle', $_POST['calle'], PDO::PARAM_STR);
$sentencia->bindValue(':colonia', $_POST['colonia'], PDO::PARAM_STR);
$sentencia->bindValue(':numero_exterior', $_POST['numero_exterior'], PDO::PARAM_STR);
$sentencia->bindValue(':numero_interior', $_POST['numero_interior'], PDO::PARAM_STR);
$sentencia->bindValue(':codigo_postal', $_POST['codigo_postal'], PDO::PARAM_STR);
$sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$sentencia->execute();


$sql = <<<fin
    update usuarios set
        direccion_id = :direccion_id, 
        nombre = :nombre,
        primer_apellido = :primer_apellido,
        segundo_apellido = :segundo_apellido,
        sexo = :sexo,
        fecha_nacimiento = :fecha_nacimiento,
        numero_celular = :numero_celular,
        correo_electronico = :correo_electronico,
        contrasena = :contrasena,
        perfil = :perfil,
        estatus = :estatus,
        identificacion = :identificacion,
        comprobante_domicilio = :comprobante_domicilio
    where
        id = :id
    fin;

// ¿cambiar contraseña?
if (!$errors->has('contrasena') && !$errors->has('contrasena_confirma') && !empty($_POST['contrasena'])) {
    $opciones = [
        'cost' => 12,
    ];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT, $opciones);
} else {
    // dejamos la misma contraseña
    $sentencia = $conexion->prepare('select contrasena from usuarios where id = :id');
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $contrasena = $sentencia->fetchColumn(0);
}

// cambio de documentos
if (is_uploaded_file($_FILES['identificacion']['tmp_name'])) {
    $nombre_identificacion = uniqid('id-', true) . '.jpg'; // se supone sólo se admiten .jpg
    // mover archivo a su ubicación final
    move_uploaded_file($_FILES['identificacion']['tmp_name'], 'uploads/usuarios/identificaciones/' . $nombre_identificacion);
}
else {
    // dejamos los mismos documentos 
    $sentencia = $conexion->prepare('select identificacion from usuarios where id = :id');
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $nombre_identificacion= $sentencia->fetchColumn(0);
}
if (is_uploaded_file($_FILES['comprobante_domicilio']['tmp_name'])) {
    $nombre_comprobante_domicilio = uniqid('cd-', true) . '.jpg'; 
    move_uploaded_file($_FILES['comprobante_domicilio']['tmp_name'], 'uploads/usuarios/comprobantes_domicilio/' . $nombre_comprobante_domicilio);
}
else {
    $sentencia = $conexion->prepare('select comprobante_domicilio from usuarios where id = :id');
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $nombre_comprobante_domicilio = $sentencia->fetchColumn(0);
}



$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':direccion_id', $_GET['id'], PDO::PARAM_STR);
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
$sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$sentencia->execute();
echo '<h6>Usuario actualizado</h6>';
echo '<div><a href="usuarios.php" class="btn btn-secondary btn-sm">usuarios</a></div>';