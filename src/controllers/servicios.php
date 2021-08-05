<?php
$sql = <<<fin
select id, servicio
from servicios order by servicio asc;
fin;

$sentencia = $conexion->prepare($sql);
$sentencia->execute();
