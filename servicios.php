<?php
//require_once './checa-sesion.php';
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/estilosGlobales.css' ?>">
</head>

<body>
    <?php
    require_once './menu.php';
    ?>
    <div class="d-flex mt-5">
        <?php
        $opcion = 'servicios';
        include_once('menu_admin.php');
        ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
           
            <h1>  <i class="bi bi-stack"></i> Servicios
                    </div>  </h1>
                    <div class="card-body">
                        <a class="float-end btn btn-primary " href="<?= BASEPATH . 'servicio' ?>" title="Crear servicio">
                            <i class="bi-plus-circle-fill"></i> Crear
                        </a>
                        <table class="table-striped table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="width:80%;"><h3>Servicio</h3></th>
                                    <th style="width:20%;"><h3> &nbsp; </h3></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once './conexion.php';
                                $sql = 'select id, servicio from servicios order by servicio asc';
                                $sentencia = $conexion->prepare($sql);
                                $sentencia->execute();
                                foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $servicio) {
                                    $servicio['servicio'] = htmlentities($servicio['servicio']);
                                   ?>
                            <tr>
                                <td><?= $servicio['servicio']?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="<?= BASEPATH . 'servicio' ?>" title="Clic para editar servicio">
                                        <i class="bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
<?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASEPATH . 'resources/js/bootstrap.min.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/validacion_bootstrap.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/jquery-3.6.0.min.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/estilosGlobales.js' ?>"></script>
</body>

</html>