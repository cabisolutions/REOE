<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body> 
    <div class="container pt-3">
        <h1 class="mb-0">Usuarios</h1>
        <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Disponible para</th>
                    <th>Estatus</th>
                    <th>
                        <a href="espacio.php" class="btn btn-primary btn-hover btn-sm w-100" alt='crear'>
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
                            <a href="espacio.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-primary btn-sm">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>