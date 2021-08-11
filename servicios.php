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
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
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
        <div class="container mt-4">
            <div>
                <h1><i class="bi bi-stack"></i> Servicios</h1>
                <div>
                    <table class="table-striped table table-hover table-sm">
                        <thead>
                            <tr>
                                <th style="width:80%;">
                                    Servicio
                                </th>
                                <th style="width:20%;">
                                    <a class="float-end btn btn-primary" href="<?= BASEPATH . 'servicio' ?>" title="Crear servicio">
                                        <i class="bi-plus-circle-fill"></i> Añadir
                                    </a>
                                </th>
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
                                    <td><?= $servicio['servicio'] ?></td>
                                    <td>
                                        <a class="float-end btn btn-sm btn-outline-primary" href="<?= BASEPATH . 'servicio?id=' . $servicio['id'] ?>" title="Editar servicio">
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