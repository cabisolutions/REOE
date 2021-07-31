<?php
$sql = <<<fin
    insert into direcciones (
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

$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':estado_id', $_POST['estado_id'], PDO::PARAM_INT);
$sentencia->bindValue(':municipio_id', $_POST['municipio_id'], PDO::PARAM_INT);
$sentencia->bindValue(':calle', $_POST['calle'], PDO::PARAM_STR);
$sentencia->bindValue(':colonia', $_POST['colonia'], PDO::PARAM_STR);
$sentencia->bindValue(':numero_exterior', $_POST['numero_exterior'], PDO::PARAM_STR);
$sentencia->bindValue(':numero_interior', $_POST['numero_interior'], PDO::PARAM_STR);
$sentencia->bindValue(':codigo_postal', $_POST['codigo_postal'], PDO::PARAM_STR);
$sentencia->execute();

$direccion_id = $conexion->lastInsertId();

$sql = <<<fin
    insert into espacios (
    direccion_id, 
    nombre, 
    descripcion,
    metros_cuadrados, 
    disponible_para, 
    estatus, 
    costo,
    costo_renta_dia
    ) values (
    :direccion_id, 
    :nombre, 
    :descripcion, 
    :metros_cuadrados, 
    :disponible_para, 
    :estatus, 
    :costo,
    :costo_renta_dia
    )
    fin;

$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':direccion_id', $direccion_id, PDO::PARAM_STR);
$sentencia->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
$sentencia->bindValue(':descripcion', $_POST['descripcion'], PDO::PARAM_STR);
$sentencia->bindValue(':metros_cuadrados', $_POST['metros_cuadrados'], PDO::PARAM_INT);
$sentencia->bindValue(':disponible_para', $_POST['disponible_para'], PDO::PARAM_STR);
$sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
$sentencia->bindValue(':costo', $_POST['costo'], PDO::PARAM_STR);
$sentencia->bindValue(':costo_renta_dia', $_POST['costo'], PDO::PARAM_STR);
$sentencia->execute();

echo '<h6>Espacio creado</h6>';
echo '<div><a href="espacio.php" class="btn btn-secondary btn-sm">espacios</a></div>';