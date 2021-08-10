<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espacios</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="d-flex mt-5">
        <?php
        $opcion = 'espacios';
        include_once('menu_admin.php');
        ?>
        <div class="container mt-4">
            <h1><i class="bi bi-house-door-fill"></i> Espacios</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Disponible para</th>
                            <th>Estatus</th>
                            <th>
                                <a href="<?= BASEPATH . 'espacio' ?>" class="float-end btn btn-primary btn-hover" title='Crear espacio'>
                                    <i class="bi-plus-circle-fill"></i> Añadir
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once './conexion.php';
                        $sql = <<<fin
                                select
                                    e.id
                                    , e.nombre
                                    , e.descripcion
                                    , e.disponible_para
                                    , e.estatus 
                                from
                                    espacios e
                            fin;
                        $sentencia = $conexion->prepare($sql);
                        $sentencia->execute();
                        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        ?>
                            <tr>
                                <td><?php echo htmlentities($row['nombre']) ?></td>
                                <td><?php echo htmlentities($row['descripcion']) ?></td>
                                <td><?php echo htmlentities($row['disponible_para']) ?></td>
                                <td><?php echo htmlentities($row['estatus']) ?></td>
                                <td>
                                    <a href="<?= BASEPATH . 'espacio?id=' . $row['id'] ?>" class="float-end btn btn-outline-primary btn-sm">
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
    <?php
    include_once('footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>