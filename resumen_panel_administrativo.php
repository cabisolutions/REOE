<?php
require_once './conexion.php';
$sql = <<<fin
        select COUNT(id) from usuarios
    fin;
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$numero_usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);

$sql = <<<fin
        select COUNT(id) from usuarios where estatus = 'Activo'
    fin;
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$numero_usuarios_activos = $sentencia->fetch(PDO::FETCH_ASSOC);

$sql = <<<fin
        select COUNT(id) from usuarios where estatus = 'Inactivo'
    fin;
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$numero_usuarios_inactivos = $sentencia->fetch(PDO::FETCH_ASSOC);

$sql = <<<fin
        select COUNT(id) from rentas
    fin;
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$numero_rentas = $sentencia->fetch(PDO::FETCH_ASSOC);

$sql = <<<fin
    select COUNT(id) from rentas where estatus = 'Procede'
    fin;
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
$numero_rentas_procede = $resultado['COUNT(id)'];

$sql = <<<fin
    select COUNT(id) from espacios
    fin;
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$numero_espacios = $sentencia->fetch(PDO::FETCH_ASSOC);

$sql = <<<fin
    select COUNT(id) from espacios where estatus = 'Rentado'
    fin;
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
$numero_espacios_rentados = $resultado['COUNT(id)'];

$sql = <<<fin
    select COUNT(id) from espacios where estatus = 'Disponible'
    fin;
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
$numero_espacios_disponibles = $resultado['COUNT(id)'];

?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/resumen_administrativo.css">
</head>

<body>
    <div class="container pt-3">
        <h1>Resumen</h1>
        <div class="row">
            <?php
                // tarjeta de infoamción con total de usuarios
                $conteo = $numero_usuarios;
                $texto = 'Total usuarios';
                $direccion = './usuarios.php';
                $accion = 'Ver usuarios';
                $color = 'secondary';
                $ancho ='18rem';
                $extra = '';
                include('./php/tarjetaInformacion.php');

                // tarjeta de información con total de usuarios activos
                $conteo = $numero_usuarios_activos;
                $texto = 'Usuarios activos';
                $direccion = './usuarios.php';
                $accion = 'Ver usuarios activos';
                $color = 'success';
                $ancho ='18rem';
                include('./php/tarjetaInformacion.php');

                // tarjeta de información con total de usuarios inactivos
                $conteo = $numero_usuarios_inactivos;
                $texto = 'Usuarios inactivos';
                $direccion = './usuarios.php';
                $accion = 'Ver usuarios inactivos';
                $color = 'danger';
                $ancho ='18rem';
                include('./php/tarjetaInformacion.php');
            ?>
        </div>
        <div class="row">
            <?php
                // tarjeta de infoamción con total de rentas
                $conteo = $numero_rentas;
                $texto = 'Total rentas';
                $direccion = './rentas.php';
                $accion = 'Ver total rentas';
                $color = 'primary';
                $ancho ='28rem';
                $extra = "
                <div class='br'></div>
                <div class='row mt-1 mb-1'>
                    <div class='col-4 text-center'>
                        <span class='display-5'>$numero_rentas_procede</span>
                    </div>
                    <div class='col-8 vertical-center'>
                        <span class='h5 pt-2'>Rentas procedentes</span>
                    </div>
                </div>
                <div class='row mt-2 mb-1'>
                    <div class='col-4 text-center'>
                        <span class='display-5'>$numero_rentas_procede</span>
                    </div>
                    <div class='col-8 vertical-center'>
                        <span class='h5 pt-2'>Rentas canceladas</span>
                    </div>
                </div>";
                include('./php/tarjetaInformacion.php');
            ?>
            <?php
                // tarjeta de infoamción con total de espacios
                $conteo = $numero_espacios;
                $texto = 'Total espacios';
                $direccion = './espacios.php';
                $accion = 'Ver total espacios';
                $color = 'info';
                $ancho ='28rem';
                $extra = "
                <div class='br'></div>
                <div class='row mt-1 mb-1'>
                    <div class='col-4 text-center'>
                        <span class='display-5'>$numero_espacios_rentados</span>
                    </div>
                    <div class='col-8 vertical-center'>
                        <span class='h5 pt-2'>Espacios en renta</span>
                    </div>
                </div>
                <div class='row mt-2 mb-1'>
                    <div class='col-4 text-center'>
                        <span class='display-5'>$numero_espacios_disponibles</span>
                    </div>
                    <div class='col-8 vertical-center'>
                        <span class='h5 pt-2'>Espacios disponibles</span>
                    </div>
                </div>";
                include('./php/tarjetaInformacion.php');
            ?>
        </div>
        
    </div>
</body>

</html>