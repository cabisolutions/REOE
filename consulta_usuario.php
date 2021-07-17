<?php
require_once './conexion.php';
$sql = 'select 
u.id, u.direccion_id, u.nombre, u.primer_apellido,
u.segundo_apellido, u.sexo, u.fecha_nacimiento, u.numero_celular, 
u.correo_electronico, u.contrasena, u.perfil, u.estatus, u.identificacion,
u.comprobante_domicilio, d.id, d.estado_id, d.municipio_id, d.calle, d.colonia, d.numero_exterior,
d.numero_interior, d.codigo_postal
from 
usuarios u
inner join direcciones d on u.id= d.id 
where 
u.id = :id';
$sentencia = $conexion->prepare($sql);
$sentencia->bindParam(':id', $_REQUEST['id'], PDO::PARAM_INT);
$sentencia->execute();
echo json_encode([
    'estatus' => true
    , 'data' => $sentencia->fetchAll(PDO::FETCH_ASSOC)
]);
