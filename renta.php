<?php
//require_once './checa-sesion.php';
require('vendor/autoload.php');

use Rakit\Validation\Validator;

if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['espacio']) && is_numeric($_GET['espacio'])) {
    require_once './conexion.php';
    $sql = 'select * from espacios where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['espacio'], PDO::PARAM_INT);
    $sentencia->execute();
    $espacio_id = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $espacio_id) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $espacio_id);
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta</title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/estilosGlobales.css' ?>">
</head>

<body>
    <?php
    require_once './menu.php';
    ?>
    <br>
    <br>

    <div class="d-flex">

        <div class="container pt-4">

            <h4> <?php echo htmlentities($_POST['nombre']) ?> </h4>

            <?php
            if ('POST' == $_SERVER['REQUEST_METHOD']) {

                $validator = new Validator;
                $validation = $validator->make($_POST, [
                    'renta' => 'required|min:4|max:25'
                ]);
                $validation->setMessages([
                    'required' => ':attribute es requerido', 'min' => ':attribute longitud mínima no se cumple', 'max' => ':attribute longitud máxima no se cumple'
                ]);

                $validation->validate();
                $errors = $validation->errors();
            }
            if ('GET' == $_SERVER['REQUEST_METHOD'] || $validation->fails()) {
            ?>
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                    <div class="mb-3">
                        <name="espacio_id" <?php echo isset($errors) && $errors->has('espacio_id') ? ' is-invalid' : 'is-valid' ?> id="espacio_id" aria-describedby="espacio_idHelp" value="<?php echo $_POST['espacio_id'] ?? '' ?>">
                            <div id="espacio_idHelp" class="invalid-feedback"><?php echo isset($errors) && $errors->first('espacio_id') ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div>
                                <?php
                                require('vendor/autoload.php');
                                if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['espacio']) && is_numeric($_GET['espacio'])) {
                                    require_once './conexion.php';
                                    $sql = 'select * from direcciones where id = :id';
                                    $sentencia = $conexion->prepare($sql);
                                    $sentencia->bindValue(':id', $_GET['espacio'], PDO::PARAM_INT);
                                    $sentencia->execute();
                                    $espacio_id = $sentencia->fetch(PDO::FETCH_ASSOC);
                                    if (null == $espacio_id) {
                                        require_once './error-no-encontrado.php';
                                        exit;
                                    }
                                    $_POST = array_merge($_POST, $espacio_id);
                                }
                                ?>

                                <?php
                                require('vendor/autoload.php');
                                if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['espacio']) && is_numeric($_GET['espacio'])) {
                                    require_once './conexion.php';
                                    $sql = 'select id, estado from estados where id = :id';
                                    $sentencia = $conexion->prepare($sql);
                                    $sentencia->bindValue(':id', ($_POST['estado_id']) , PDO::PARAM_INT);
                                    $sentencia->execute();
                                    $estado = $sentencia->fetch(PDO::FETCH_ASSOC);
                                    if (null == $estado) {
                                        require_once './error-no-encontrado.php';
                                        exit;
                                    }
                                    $_POST = array_merge($_POST, $estado);
                                }
                                ?>

                                <?php
                                require('vendor/autoload.php');
                                if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['espacio']) && is_numeric($_GET['espacio'])) {
                                    require_once './conexion.php';
                                    $sql = 'select id, municipio from municipios where id = :id';
                                    $sentencia = $conexion->prepare($sql);
                                    $sentencia->bindValue(':id', ($_POST['municipio_id']), PDO::PARAM_INT);
                                    $sentencia->execute();
                                    $municipio = $sentencia->fetch(PDO::FETCH_ASSOC);
                                    if (null == $municipio) {
                                        require_once './error-no-encontrado.php';
                                        exit;
                                    }
                                    $_POST = array_merge($_POST, $municipio);
                                }
                                ?>

                                Estado: <?php echo htmlentities($_POST['estado']) ?> <br>
                                Municipio: <?php echo htmlentities($_POST['municipio']) ?> <br>
                                Calle: <?php echo htmlentities($_POST['calle']) ?> <br>
                                Colonia: <?php echo htmlentities($_POST['colonia']) ?> <br>
                                Numero exterior: <?php echo htmlentities($_POST['numero_exterior']) ?> <br>
                                Numero interior: <?php echo htmlentities($_POST['numero_interior']) ?> <br>
                                CP: <?php echo htmlentities($_POST['codigo_postal']) ?>

                            </div>
                            <div class="mb-3">


                                <div>
                                    Metros cuadrados: <?php echo htmlentities($_POST['metros_cuadrados']) ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div>
                                    Descripción: <?php echo htmlentities($_POST['descripcion']) ?>
                                </div>
                            </div>
                            <div class="mb-3">

                                <div>
                                    Servicios:

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6"> </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div>
                                            <label for="check_in" class="form-label">Check-in</label>
                                            <input type="date" name="check_in" required class="form-control form-control-sm" id="check_in" value="<?php echo htmlentities($_POST['check_in'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div>
                                            <label for="check_out" class="form-label">Check-out</label>
                                            <input type="date" name="check_out" required class="form-control form-control-sm" id="check_out" value="<?php echo htmlentities($_POST['check_out'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="mb-3">
                                    <img src="img/espacio1.jpg" class="col-md-12 rounded float-md-end mb-3 ms-md-3" alt="Imagen espacio 1">
                                </div>
                                <div class="mb-3">
                                    <div>
                                        Precio de renta: <?php echo htmlentities($_POST['costo']) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <div>
                                            Precio por dia: <?php echo htmlentities($_POST['costo_renta_dia']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn btn-primary">Reservar</button>
                            <a href="<?= BASEPATH . 'renta' ?>" class="btn btn-secondary btn-sm">cancelar</a>
                </form>
            <?php
            } else {
                require_once './conexion.php';
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {

                    $sql = 'update rentas set espacio_id = :espacio_id where id = :id';
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindValue(':espacio_id', $_POST['espacio_id'], PDO::PARAM_STR);
                    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                    $sentencia->execute();
                    echo '<h6>Renta actualizada</h6>';
                    echo '<div><a href=' . BASEPATH . 'renta class="btn btn-secondary btn-sm">Rentas</a></div>';
                } else {

                    $sql = 'insert into rentas (espacio_id) values (:espacio_id)';
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindValue(':espacio_id', $_POST['espacio_id'], PDO::PARAM_STR);
                    $sentencia->execute();
                    echo '<h6>Renta creada</h6>';
                    echo '<div><a href=' . BASEPATH . 'rentas class="btn btn-secondary btn-sm">Rentas</a></div>';
                }
            }
            ?>
        </div>
        </form>
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