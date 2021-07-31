<?php
$sql = "
    select id, nombre, descripcion, metros_cuadrados, disponible_para, estatus, costo_renta_dia
    from espacios where nombre like :busqueda ";
$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':busqueda', '%' . $_GET['busqueda'] . '%', PDO::PARAM_INT);
$sentencia->execute();

