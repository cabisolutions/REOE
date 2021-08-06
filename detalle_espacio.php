
<?php
require('vendor/autoload.php');
use Rakit\Validation\Validator;
if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once './conexion.php';
    $sql = 'select id from espacios where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $id = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $id) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $id);
}
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>
    <link rel="stylesheet" href="<?=BASEPATH.'resources/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=BASEPATH.'resources/css/estilosGlobales.css'?>">
</head>    
<body>
<?php
require_once './menu.php';
?>
<br>
<br>

<div class="d-flex">
        <?php
        $opcion = 'usuarios';
        include_once('menu_admin.php');
        ?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
<h4> Detalles del espacio</h4>
            </div>
                <div class="card-body">

                <?php 
    require_once './conexion.php';
    $sql = <<<fin
        select
            espa.id
            ,espa.descripcion
            ,espa.nombre
            ,d.calle
            ,d.colonia
            ,d.numero_exterior
            ,d.codigo_postal
            ,espa.costo_renta_dia
            ,espa.metros_cuadrados
         
        from
        espacios espa INNER JOIN direcciones d ON espa.direccion_id = d.id 
        fin;
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
    $espacio = $sentencia->fetch(PDO::FETCH_ASSOC);
    ?>
    <?php
    require_once './conexion.php';
    $sql = <<<fin
        select
          es.id
          ,lm.id
          ,lm.estado_id
          ,lm.municipio_id
          ,e.estado
          ,m.municipio
          from
        espacios es INNER JOIN direcciones lm on es.direccion_id=lm.id
        INNER JOIN estados e on lm.estado_id = e.id
        INNER JOIN municipios m on lm.municipio_id = m.id
        order by e.estado, m.municipio,es.id asc

        fin;
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $direccion = $sentencia->fetch(PDO::FETCH_ASSOC);

    ?>
    </head>

<body>

 
                    <div class="container">
                    
                            <?php
$direccion_completa=($espacio['numero_exterior']).','.
($espacio['calle']).','.
($espacio['codigo_postal']).','.
($espacio['colonia']).','.
($direccion['municipio']).','.
($direccion['estado']);
?>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
      <h5 class="mb-1">Nombre</h5>
    </div>
    <td><?php echo htmlentities($espacio['nombre']) ?></td> 

  </a>
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Descripcion</h5>
    </div>
    <td><?php echo htmlentities($espacio['descripcion']) ?></td> 

  </a>
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Direccion</h5>
    </div>
    <td><?php echo $direccion_completa?></td> 

    </a>
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Costo de renta/dia</h5>
    </div>
    <td><?php echo htmlentities($espacio['costo_renta_dia']) ?></td> 

  </a>

  </a>
  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Metros cuadrados</h5>
    </div>
    <td><?php echo htmlentities($espacio['metros_cuadrados']) ?></td> 

    </a>

</div>

  
  

</table>





                            </div>
                           
                        </div>
                    </div>
                </div>
           
    <?php
    include_once('footer.php');
    ?>
    <script src="<?=BASEPATH.'resources/js/bootstrap.min.js'?>"></script>
    <script src="<?=BASEPATH.'resources/js/validacion_bootstrap.js'?>"></script>
    <script src="<?=BASEPATH.'resources/js/jquery-3.6.0.min.js'?>"></script>
    <script src="<?=BASEPATH.'resources/js/estilosGlobales.js'?>"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
