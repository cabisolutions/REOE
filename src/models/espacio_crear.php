<?php

if(isset($_POST['mapa']) && $_POST['mapa'] != '' && $_POST['mapa'] != null ){
    $_POST['mapa'] = str_replace('width="600"', 'width="100%"', $_POST['mapa']);
}

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
    :codigo_postal,
    :mapa
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
$sentencia->bindValue(':mapa', $_POST['mapa'], PDO::PARAM_STR);
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
$sentencia->bindValue(':disponible_para', implode(",", $_POST['disponible_para']) , PDO::PARAM_STR);
$sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
$sentencia->bindValue(':costo', $_POST['costo'], PDO::PARAM_STR);
$sentencia->bindValue(':costo_renta_dia', $_POST['costo_renta_dia'], PDO::PARAM_STR);
$sentencia->execute();

$espacio_id = $conexion->lastInsertId(); 

$sql = <<<fin
    insert into espacios_tipo_espacio (
    espacio_id,
    tipo_espacio_id
    ) values (
    :espacio_id,
    :tipo_espacio_id
    )
    fin;

$sentencia = $conexion->prepare($sql);
foreach($_POST['tipo_espacio_id'] as $tipo_espacio_id) {
    $sentencia->bindValue(':espacio_id', $espacio_id, PDO::PARAM_INT);
    $sentencia->bindValue(':tipo_espacio_id', $tipo_espacio_id, PDO::PARAM_INT);
    $sentencia->execute();
}

$sql = <<<fin
    insert into espacios_tipo_espacio (
    espacio_id, 
    tipo_espacio_id
    ) values (
    :espacio_id, 
    :tipo_espacio_id
    )
    fin;

$sentencia = $conexion->prepare($sql);
foreach ($_POST['tipo_espacio'] as $tipo_espacio) {
    $sentencia->bindValue(':espacio_id', $espacio_id, PDO::PARAM_INT);
    $sentencia->bindValue(':tipo_espacio_id', $tipo_espacio, PDO::PARAM_INT);
    $sentencia->execute();
}

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
for ($numero = 0; $numero < 4; $numero++) {
    // ¿se ha cargado el archivo?
    if (is_uploaded_file($_FILES['fotografia']['tmp_name'][$numero])) {
        $nombre_fotografia = uniqid('ei-', true) . '.jpg'; //se supone sólo admite .jpg
        //mover el archivo a su ubicación final 
        move_uploaded_file($_FILES['fotografia']['tmp_name'][$numero], 'uploads/espacios/fotografias/' . $nombre_fotografia);
        $sentencia->bindValue(':espacio_id', $espacio_id, PDO::PARAM_INT);
        $sentencia->bindValue(':fotografia', $nombre_fotografia, PDO::PARAM_STR);
        $sentencia->execute();
    }
}

include('espacio.php');
echo "
<script>
    Swal.fire({
        icon: 'success',
        title: 'Espacio creado',
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: `Continuar`
      }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }
      })
</script>";

