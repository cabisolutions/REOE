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
    update espacios set
        direccion_id = :direccion_id,
        nombre = :nombre,
        descripcion = :descripcion,
        metros_cuadrados = :metros_cuadrados,
        disponible_para = :disponible_para,
        estatus = :estatus,
        costo = :costo,
        costo_renta_dia = :costo_renta_dia
    where
        id = :id
    fin;

$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':direccion_id', $direccion_id, PDO::PARAM_STR);
$sentencia->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
$sentencia->bindValue(':descripcion', $_POST['descripcion'], PDO::PARAM_STR);
$sentencia->bindValue(':metros_cuadrados', $_POST['metros_cuadrados'], PDO::PARAM_INT);
$sentencia->bindValue(':disponible_para', $_POST['disponible_para'], PDO::PARAM_STR);
$sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
$sentencia->bindValue(':costo', $_POST['costo'], PDO::PARAM_STR);
$sentencia->bindValue(':costo_renta_dia', $_POST['costo_renta_dia'], PDO::PARAM_STR);
$sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$sentencia->execute();



echo '<h6>Espacio actualizado</h6>';
echo '<div><a href="espacios.php" class="btn btn-secondary btn-sm">espacios</a></div>';