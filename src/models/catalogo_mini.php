<?php
$sql = "
    select id, nombre, descripcion, metros_cuadrados, disponible_para, estatus, costo_renta_dia
    from espacios order by rand() limit 3";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();

