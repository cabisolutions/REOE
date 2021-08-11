<?php
require('vendor/autoload.php');

use Rakit\Validation\Validator;

if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['espacio']) && is_numeric($_GET['espacio'])) {
    require_once './conexion.php';
    $sql = 'select * from espacios where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['espacio'], PDO::PARAM_INT);
    $sentencia->execute();
    $espacio_id = $_GET['espacio'];
    $id = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $id) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $id);

    $sql = 'select * from direcciones where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_POST['direccion_id'], PDO::PARAM_INT);
    $sentencia->execute();
    $espacio_id = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $espacio_id) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $espacio_id);
    $sql = 'select id, estado from estados where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', ($_POST['estado_id']), PDO::PARAM_INT);
    $sentencia->execute();
    $estado = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $estado) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $estado);

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

    $sql = <<<fin
        select
            f.id,
            f.espacio_id,
            f.fotografia
        from
            fotografias f
        where 
            espacio_id = :espacio_id
        order by f.id desc limit 4
        fin;

    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':espacio_id', $_GET['espacio'], PDO::PARAM_INT);
    $sentencia->execute();

    $sql = <<<fin
    select 
        e.espacio_id, 
        e.tipo_espacio_id,
        t.id,
        t.tipo
    from 
        espacios_tipo_espacio e
        inner join tipos_espacio t on e.tipo_espacio_id  = t.id
    where
        espacio_id = :espacio_id
    fin;

    $tipo_espacio = $conexion->prepare($sql);
    $tipo_espacio->bindValue(':espacio_id', $_GET['espacio'], PDO::PARAM_INT);
    $tipo_espacio->execute();
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle</title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/estilosGlobales.css' ?>">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/detalle_espacio.css' ?>">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    require_once './menu.php';
    ?>

    <div class="d-flex mt-5">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-8 px-4">
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
                        <div class="mb-3">
                            <inoput name="espacio_id" <?php echo isset($errors) && $errors->has('espacio_id') ? ' is-invalid' : 'is-valid' ?> id="espacio_id" aria-describedby="espacio_idHelp" value="<?php echo $_POST['espacio_id'] ?? '' ?>">
                                <div id="espacio_idHelp" class="invalid-feedback"><?php echo isset($errors) && $errors->first('espacio_id') ?></div>
                        </div>
                        <div class="d-flex flex-column">
                            <div>
                                <div class="row">
                                    <div class="mb-3">
                                        <div id="carouselControls<?= $_GET['espacio'] ?>" class="carousel slide mb-2" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php
                                                $i = 'active';
                                                foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $fotografia) {
                                                    //echo BASEPATH . 'uploads/espacios/fotografias/' . $fotografia['fotografia'];
                                                    echo
                                                    '<div class="catalogo-img carousel-item ' . $i . '">
                        <img src="' . BASEPATH . 'uploads/espacios/fotografias/' . $fotografia['fotografia'] . '"' . 'class="d-block w-100" alt="...">
                    </div>';

                                                    $i = '';
                                                }
                                                ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls<?= $_GET['espacio'] ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Anterior</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselControls<?= $_GET['espacio'] ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Siguiente</span>
                                            </button>
                                        </div>
                                        <h2> <?php echo htmlentities($_POST['nombre']) ?> -
                                            <?php
                                            $stringTipo_espacio = '';
                                            foreach ($tipo_espacio->fetchAll(PDO::FETCH_ASSOC) as $tipo) {
                                                $stringTipo_espacio = $stringTipo_espacio . $tipo['tipo'] . ', ';
                                            }
                                            echo implode(',', array_unique(explode(',', substr_replace($stringTipo_espacio, '', -2))));
                                            ?>
                                        </h2>
                                        <span class="h5">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            <?php echo htmlentities($_POST['municipio']) ?>,
                                            <?php echo htmlentities($_POST['estado']) ?>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <h5>Tarifas:</h5>
                                        <div>
                                            <span class="fw-bold">MXN $<?php echo htmlentities($_POST['costo_renta_dia']) ?> / dia</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <div class="mb-3">
                                        <div>
                                            <h5>Descripción:</h5>
                                            <?php echo htmlentities($_POST['descripcion']) ?>
                                            <div>
                                                <span class="fw-bold">
                                                    Metros cuadrados:
                                                </span>
                                                <?php echo htmlentities($_POST['metros_cuadrados']) ?> </br>
                                                <span class="fw-bold">
                                                    Costo del lugar:
                                                   </span> MXN $<?php echo htmlentities($_POST['costo']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h5>Ubicación:</h5>
                                    </div>
                                    <?php
                                    if(isset($_POST['mapa']) && $_POST['mapa'] != '' && $_POST['mapa'] != null){
                                        echo $_POST['mapa'];
                                    }
                                    ?>
                                    <span class="fw-bold">
                                        Estado:
                                    </span> <?php echo htmlentities($_POST['estado']) ?> <br>
                                    <span class="fw-bold">
                                        Municipio:
                                    </span> <?php echo htmlentities($_POST['municipio']) ?> <br>
                                    <span class="fw-bold">
                                        Calle:
                                    </span> <?php echo htmlentities($_POST['calle']) ?> <br>
                                    <span class="fw-bold">
                                        Colonia:
                                    </span> <?php echo htmlentities($_POST['colonia']) ?> <br>
                                    <span class="fw-bold">
                                        Numero exterior:
                                    </span> <?php echo htmlentities($_POST['numero_exterior']) ?> <br>
                                    <span class="fw-bold">
                                        Numero interior:
                                    </span> <?php echo htmlentities($_POST['numero_interior']) ?> <br>
                                    <span class="fw-bold">
                                        CP:
                                    </span> <?php echo htmlentities($_POST['codigo_postal']) ?>
                                </div>

                                <div class="mb-3">
                                    <div>
                                        <h5>Servicios:</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-4">
                    <?php
                        include_once('renta.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
                    }
                    include_once('footer.php');
?>
<script src="<?= BASEPATH . 'resources/js/bootstrap.min.js' ?>"></script>
<script src="<?= BASEPATH . 'resources/js/validacion_bootstrap.js' ?>"></script>
<script src="<?= BASEPATH . 'resources/js/jquery-3.6.0.min.js' ?>"></script>
<script src="<?= BASEPATH . 'resources/js/estilosGlobales.js' ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>