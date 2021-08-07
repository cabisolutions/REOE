<?php
                                require('vendor/autoload.php');
                                use Rakit\Validation\Validator;
                                if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
                                    require_once './conexion.php';
                                    $sql = 'select id from espacios where id = :id';
                                    $sentencia = $conexion->prepare($sql);
                                    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                                    $sentencia->execute();
                                    $espacio_id= $_GET['id'];
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
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
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
      }
    ?>
    </head>

<body>

 
                    
                            <?php
$direccion_completa=($espacio['numero_exterior']).','.
($espacio['calle']).','.
($espacio['codigo_postal']).','.
($espacio['colonia']).','.
($direccion['municipio']).','.
($direccion['estado']);

?>
  <div class="col-md-15"><div class="list-group">
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
</div>
</div>




<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities($accion) ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
<?php
require_once './menu.php';
?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                <?php
                    if ('POST' == $_SERVER['REQUEST_METHOD']) {
                        // validamos los datos
                        $validator = new Validator;
                        $validation = $validator->make($_POST, [
                            'fecha_renta' => 'required|date:Y-m-d|'
                            , 'fecha_entrega' => 'required|date:Y-m-d|'
                            , 'fecha_devolucion' => 'required|date:Y-m-d|'
                            , 'costo' => 'required'
                            , 'costo_penalizacion' => 'required'
                            , 'estatus' => 'required|in:Reservado,Disponible,Finalizado,Cancelado'
                          
                        ]);
                        $validation->setMessages([
                            'required' => ':attribute es requerido'
                            , 'min' => ':attribute longitud mínima no se cumple'
                            , 'max' => ':attribute longitud máxima no se cumple'
                        ]);
                        // then validate
                        $validation->validate();
                        $errors = $validation->errors();
                    }
                    if ('GET' == $_SERVER['REQUEST_METHOD'] || $validation->fails()) {
                    ?>
                    <div class="mb-3">
                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                    <div class="mb-3">
                    <h1> <i class="bi bi-cash-coin"></i> Rentalo <p class="fst-normal"><?= $segment->get('nombre') ?></p ></div>  </h1>
                    <label for="fecha_renta" class="form-label">Fecha de solicitud</label>
                            <input type="date" name="fecha_renta" required class="form-control form-control-sm" id="fecha_renta" value="<?php echo htmlentities($_POST['fecha_renta'] ?? '') ?>">
                            <div class="invalid-feedback">
                                Ingresa la fecha de renta
                            </div>
                        </div>
                        <div class="mb-3">

                                <div class="mb-3">
                    <label for="fecha_entrega" class="form-label">Inicio de renta</label>
                            <input type="date" name="fecha_entrega" required class="form-control form-control-sm" id="fecha_entrega" value="<?php echo htmlentities($_POST['fecha_entrega'] ?? '') ?>">
                            <div class="invalid-feedback">
                                Ingresa la fecha de entrega
                            </div>
                        </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                <div class="mb-3">
                    <label for="fecha_devolucion" class="form-label">Fecha de vencimiento</label>
                            <input type="date" name="fecha_devolucion" required class="form-control form-control-sm" id="fecha_devolucion" value="<?php echo htmlentities($_POST['fecha_devolucion'] ?? '') ?>">
                            <div class="invalid-feedback">
                                Ingresa la fecha de devolucion
                            </div>
                        </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                  
                                
                                
                                        <label for="costo" class="form-label">Costo</label>
                                        <input type="text" name="costo" required class="form-control form-control-sm" id="costo" value="<?php echo htmlentities($_POST['costo'] ?? '') ?>">
                                        <div class="invalid-feedback">
                                            Ingresa el costo
                                        </div>
                                    </div> 


                                    <label for="costo_penalizacion" class="form-label">Costo de penalizacion</label>
                                        <input type="text" name="costo_penalizacion" required class="form-control form-control-sm" id="costo_penalizacion" value="<?php echo htmlentities($_POST['costo_penalizacion'] ?? '') ?>">
                                        <div class="invalid-feedback">
                                            Ingresa el costo de penalizacion
                                        </div>
                                    </div> 

      
                        <div class="mb-3">
                            <label for="estatus1" class="form-label">Estatus</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="estatus" id="estatus1" value="Reservado" <?php echo 'Reservado' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="estatus1">
                                        Reservado
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="estatus" id="estatus2" value="Finalizado" <?php echo 'Finalizado' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="estatus2">
                                       Disponible
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="estatus" id="estatus3" value="Cancelado" <?php echo 'Cancelado' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="estatus3">
                                        Cancelado
                                    </label>
                                    </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="estatus" id="estatus4" value="Cancelado" <?php echo 'Cancelado' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="estatus4">
                                        Finalizado
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                    <?php
                    } else {
                        // es post y todo está bien
                        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                            
                            //creamos
                            $sql = <<<fin
                            $segment->get('id')=$usuario_id
                          
insert into rentas (
    usuario_id
    , espacio_id
    , fecha_renta
    , fecha_entrega
    , fecha_devolucion
    , costo
    , costo_penalizacion
    , estatus
    
) values (
    : $usuario_id
    , : $espacio_id 
    , : costo
    , :costo
    , :fecha_renta
    , :fecha_entrega
    , :fecha_devolucion
    , :costo
    , :costo_penalizacion
    , :estatus
)
fin;
                           
                            $sentencia = $conexion->prepare($sql);
                            $sentencia->bindValue(':usuario_id',$segment->get('id'), PDO::PARAM_INT);
                            $sentencia->bindValue(':espacio_id',  $espacio_id, PDO::PARAM_INT);
                            $sentencia->bindValue(':fecha_renta', $_POST['fecha_renta'], PDO::PARAM_STR);
                            $sentencia->bindValue(':fecha_entrega', $_POST['fecha_entrega'], PDO::PARAM_STR);
                            $sentencia->bindValue(':fecha_devolucion', $_POST['fecha_devolucion'], PDO::PARAM_STR);
                            $sentencia->bindValue(':costo', $_POST['costo'], PDO::PARAM_INT);
                            $sentencia->bindValue(':costo_penalizacion', $_POST['costo_penalizacion'], PDO::PARAM_INT);
                            $sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
                            $sentencia->execute();
                            echo '<h6>Gracias por su eleccion</h6>';
                            echo '<div><a href="catalogo.php" class="btn btn-secondary btn-sm">usuarios</a></div>';
                        }
                    }
                    ?>
                </div>
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
