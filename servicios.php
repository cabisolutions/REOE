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
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/estilosGlobales.css">
</head>
<body>
    <?php
    require_once './menu.php';
    ?>
    <br>
    <br>
    <div class="container mt-3">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <i class="bi-ui-checks"></i> Servicios
                </div>
                <div class="card-body">
                    <a class="float-end btn btn-primary btn-sm" href="servicio.php" title="Crear servicio">
                        <i class="bi-plus-circle-fill"></i> crear
                    </a>
                    <table class="table-striped table table-hover table-sm">
                        <thead>
                            <tr>
                                <th style="width:80%;">servicio</th>
                                <th style="width:20%;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once './conexion.php';
                            $sql = 'select id, servicio from servicios order by servicio asc';
                            $sentencia = $conexion->prepare($sql);
                            $sentencia->execute();
                            foreach($sentencia->fetchAll(PDO::FETCH_ASSOC) as $servicio) {
                                $servicio['servicio'] = htmlentities($servicio['servicio']);
                                echo <<<fin
                            <tr>
                                <td>{$servicio['servicio']}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="servicio.php?id={$servicio['id']}" title="Clic para editar servicio">
                                        <i class="bi-pencil-square"></i>
                                    </a>
                                </td>
                            </tr>
fin;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>