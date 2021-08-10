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
$sentencia->bindValue(':id', $_POST['direccion_id'], PDO::PARAM_INT);
$sentencia->execute();


$sql = <<<fin
    update espacios set
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
$sentencia->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
$sentencia->bindValue(':descripcion', $_POST['descripcion'], PDO::PARAM_STR);
$sentencia->bindValue(':metros_cuadrados', $_POST['metros_cuadrados'], PDO::PARAM_INT);
$sentencia->bindValue(':disponible_para', implode(",", $_POST['disponible_para']), PDO::PARAM_STR);
$sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
$sentencia->bindValue(':costo', $_POST['costo'], PDO::PARAM_STR);
$sentencia->bindValue(':costo_renta_dia', $_POST['costo_renta_dia'], PDO::PARAM_STR);
//$sentencia->bindValue(':id', $_POST['direccion_id'], PDO::PARAM_INT);
$sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$sentencia->execute();

$espacio_id = $conexion->lastInsertId();

// eliminamos los tipos de espacio previos que estaban asociados y que dejaron de estarlo
$tipo_espacio_ids = implode(',', $_POST['tipo_espacio']);
//echo 'actualizar';
//print($tipo_espacio_ids);
$sql = "delete from espacios_tipo_espacio where espacio_id = :espacio_id";
$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':espacio_id', $_GET['id'], PDO::PARAM_INT);
$sentencia->execute();
//$sentencia = $conexion->prepare($sql);
//foreach ($_POST['tipo_espacio'] as $tipo_espacio) {
//    $sentencia->bindValue(':espacio_id', $espacio_id, PDO::PARAM_INT);
//    $sentencia->bindValue(':tipo_espacio_id', $tipo_espacio, PDO::PARAM_INT);
//    $sentencia->execute();
//}
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
foreach ($_POST['tipo_espacio'] as $tipo_espacio) {
    $sentencia->bindValue(':espacio_id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->bindValue(':tipo_espacio_id', $tipo_espacio, PDO::PARAM_INT);
    $sentencia->execute();
}

//if (is_uploaded_file($_FILES['fotografia']['tmp_name'])) {
//    $sql = "delete fotografias where espacio_id = :espacio_id";
//    $sentencia = $conexion->prepare($sql);
//    $sentencia->bindValue(':espacio_id', $_GET['id'], PDO::PARAM_INT);
//    $sentencia->execute();
//}

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
//print_r($_FILES['fotografia']);
for ($numero = 0; $numero < 4; $numero ++){
    // ¿se ha cargado el archivo?
    if (is_uploaded_file($_FILES['fotografia']['tmp_name'][$numero])){
        $nombre_fotografia = uniqid ('ei-', true) . '.jpg'; //se supone sólo admite .jpg
        //mover el archivo a su ubicación final 
        move_uploaded_file($_FILES['fotografia']['tmp_name'][$numero], 'uploads/espacios/fotografias/' . $nombre_fotografia);
        $sentencia->bindValue(':espacio_id', $_GET['id'], PDO::PARAM_INT);
        $sentencia->bindValue(':fotografia', $nombre_fotografia, PDO::PARAM_STR);
        $sentencia->execute();
    }
}

include('espacio.php');
echo "
<script>
    Swal.fire({
        icon: 'success',
        title: 'Espacio actualizado',
        showDenyButton: false,
        showCancelButton: false,
        confirmButtonText: `Continuar`
      }).then((result) => {
        if (result.isConfirmed) {
            location.href = '" . BASEPATH . "espacio?id=" . $_GET['id'] . "'
            location.assign()
        }
      })
</script>";

