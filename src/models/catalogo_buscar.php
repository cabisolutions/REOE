<?php

$consulta_tipo_espacio = '';
if (isset($_GET['tipo_espacio']) && is_array($_GET['tipo_espacio'])) {
    $andOr = 'and';
    foreach ($_GET['tipo_espacio'] as $tipo_espacio) {
        $consulta_tipo_espacio = $consulta_tipo_espacio . ' ' . $andOr . ' t.tipo_espacio_id = ' . $tipo_espacio ;
        $andOr = 'or';
    }
}

$sql = "
    select distinct id, 
        nombre, 
        descripcion, 
        metros_cuadrados,
        disponible_para,
        estatus,
        costo_renta_dia
    from (
        select 
            e.id,
            e.nombre,
            e.descripcion,
            e.metros_cuadrados,
            e.disponible_para,
            e.estatus,
            e.costo_renta_dia,
            t.espacio_id,
            t.tipo_espacio_id
        from espacios e
            inner join espacios_tipo_espacio t on e.id  = t.espacio_id 
        where 
        e.nombre like :busqueda {$consulta_tipo_espacio} ) T";

$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':busqueda', '%' . $_GET['busqueda'] . '%', PDO::PARAM_STR);
$sentencia->execute();
