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
//$sentencia->bindValue(':id', $_POST['direccion_id'], PDO::PARAM_INT);
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
$sentencia->bindValue(':direccion_id', $_GET['id'], PDO::PARAM_STR);
$sentencia->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
$sentencia->bindValue(':descripcion', $_POST['descripcion'], PDO::PARAM_STR);
$sentencia->bindValue(':metros_cuadrados', $_POST['metros_cuadrados'], PDO::PARAM_INT);
$sentencia->bindValue(':disponible_para', implode(",", $_POST['disponible_para']) , PDO::PARAM_STR);
$sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
$sentencia->bindValue(':costo', $_POST['costo'], PDO::PARAM_STR);
$sentencia->bindValue(':costo_renta_dia', $_POST['costo_renta_dia'], PDO::PARAM_STR);
$sentencia->bindValue(':id', $_POST['direccion_id'], PDO::PARAM_INT);
//$sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$sentencia->execute();

$sql = <<<fin
    insert ignore into
    espacios_tipo_espacio (
    espacio_id,
    tipo_espacio_id
    ) values (
    :espacio_id,
    :tipo_espacio_id
    )
    fin;

$sentencia = $conexion->prepare($sql);
foreach($_POST['tipo_espacio'] as $tipo_espacio) {
    $sentencia->bindValue(':espacio_id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->bindValue(':tipo_espacio_id', $tipo_espacio, PDO::PARAM_INT);
    $sentencia->execute();
}
 // eliminamos los tipos de espacio previos que estaban asociados y que dejaron de estarlo
 /*$tipo_espacio_ids = implode(',', $_POST['tipo_espacio_id']);
 $sql = "delete from espacios_tipo_espacio where espacio_id = :espacio_id and tipo_espacio_id not in ({$tipo_espacio_ids})";
 $sentencia = $conexion->prepare($sql);
 $sentencia->bindValue(':espacio_id', $_GET['id'], PDO::PARAM_INT);
 $sentencia->execute();*/

$sql = <<<fin
    insert into fotografias (
    espacio_id,
    fotografia
    ) values (
    :espacio_id,
    :fotografia
    )
    fin;

$sentencia = $conexion->prepare($sql);
// print_r($_FILES);
for ($numero = 0; $numero < 4; $numero ++){
    // ¿se ha cargado el archivo?
    if (is_uploaded_file($_FILES['fotografia']['tmp_name'][$numero])){
        $nombre_fotografia = uniqid ('ei-', true) . '.jpg'; //se supone sólo admite .jpg
        //mover el archivo a su ubicación final 
        move_uploaded_file($_FILES['fotografia']['tmp_name'][$numero], 'uploads/espacios/fotografias/' . $nombre_fotografia);
        $sentencia->bindValue(':espacio_id', $espacio_id, PDO::PARAM_INT);
        $sentencia->bindValue(':fotografia', $nombre_fotografia, PDO::PARAM_STR);
        $sentencia->execute();
    }
    else //cambio de archivos
        $sentencia = $conexion->prepare('select fotografia from fotografias where id = :id');
        $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $sentencia->execute();
        $nombre_identificacion= $sentencia->fetchColumn(0);
}

echo '<h6>Espacio actualizado</h6>';
echo '<div><a href="espacios.php" class="btn btn-secondary btn-sm">espacios</a></div>';