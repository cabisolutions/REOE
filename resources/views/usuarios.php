<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="<?=BASEPATH.'resources/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="d-flex mt-5">
        <?php
        $opcion = 'usuarios';
        include_once('menu_admin.php');
        ?>
        <div class="container pt-3">
            <h1 class="mb-0"><i class="bi bi-people-fill"></i> Usuarios</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Perfil</th>
                            <th>Estatus</th>
                            <th>
                                <a href="<?=BASEPATH.'usuario'?>" class="btn btn-primary btn-hover btn-sm w-100" alt='crear'>
                                    <i class="bi-plus-circle-fill"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once './conexion.php';
                        $sql = <<<fin
                            select
                                u.id
                                , concat(u.primer_apellido, ' ', u.segundo_apellido, ' ', u.nombre) as nombre
                                , u.correo_electronico 
                                , u.perfil 
                                , u.estatus 
                            from
                                usuarios u
                        fin;
                        $sentencia = $conexion->prepare($sql);
                        $sentencia->execute();
                        foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        ?>
                            <tr>
                                <td><?php echo htmlentities($row['nombre']) ?></td>
                                <td><?php echo htmlentities($row['correo_electronico']) ?></td>
                                <td><span class="badge bg-<?php if ('Administrador' == $row['perfil']) {
                                                                echo 'info';
                                                            } else {
                                                                echo 'light';
                                                            }
                                                            ?>">
                                        <?php echo htmlentities($row['perfil']) ?></span></td>
                                <td><span class="badge bg-<?php if ('Activo' == $row['estatus']) {
                                                                echo 'success';
                                                            } else {
                                                                echo 'light';
                                                            }
                                                            ?>">
                                        <?php echo htmlentities($row['estatus']) ?></span></td>
                                <td>
                                    <a href="<?=BASEPATH.'usuario?id='.$row['id'] ?>" class="btn btn-outline-primary btn-sm">
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