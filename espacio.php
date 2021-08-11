<?php
//require_once ('./conexion.php');
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $accion ?></title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/espacio.css'?>">
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
        <div class="container mt-4 mb-4">
            <h1><i class="bi bi-house-door-fill"></i> <?= $accion ?></h1>
            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" id="formulario-espacio" enctype="multipart/form-data">
                <!-- <form action="espacios_guarda.php" method="POST" class="needs-validation" novalidate> -->
                <input type="number" name="direccion_id" class="d-none" id="direccion_id" value="<?php echo htmlentities($_POST['direccion_id'] ?? '') ?>">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Nombre del espacio</label>
                            <input type="text" name="nombre" required class="form-control form-control-sm
                            <?= (isset($errors) && $errors->has('nombre')) ? ' is-invalid' : '' ?>" id="nombre" value="<?php echo htmlentities($_POST['nombre'] ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors) ? $errors->first('nombre') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea rows="3" type="text" name="descripcion" required class="form-control form-control-sm
                            <?= (isset($errors) && $errors->has('descripcion')) ? ' is-invalid' : '' ?>" id="descripción"><?php echo htmlentities($_POST['descripcion'] ?? '') ?></textarea>
                            <div class="invalid-feedback">
                                <?= isset($errors) ? $errors->first('descripcion') : '' ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="metros_cuadrados" class="form-label">Metros (cuadrados)</label>
                            <input type="number" name="metros_cuadrados" required class="form-control form-control-sm
                            <?= (isset($errors) && $errors->has('metros_cuadrados')) ? ' is-invalid' : '' ?>" id="metros_cuadrados" value="<?php echo htmlentities($_POST['metros_cuadrados'] ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors) ? $errors->first('metros_cuadrados') : '' ?>
                            </div>
                        </div>
                        <?php
                        //foreach($tipos_espacios->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        //$tipos_espacio_id[] = $row['tipo_espacio_id'];
                        //$_SESSION['tipos_espacio_ids'] = $_POST['tipo_espacio_id']
                        //}
                        ?>
                        <?php //print_r($tipos_espacio_id) 
                        ?>
                        <div class="mb-3">
                            <label for="tipo_espacio" class="form-label">Tipo de espacio</label>
                            <?php
                            require_once './conexion.php';
                            $sql = 'select id, tipo from tipos_espacio order by tipo asc';
                            $tipos_espacios = $conexion->prepare($sql);
                            $tipos_espacios->execute();

                            //print_r($_POST['tipo_espacio_id']);
                            foreach ($tipos_espacios->fetchAll(PDO::FETCH_ASSOC) as $tipo) {
                                $tipo['tipo'] = htmlentities($tipo['tipo']);
                                //$isChecked = '';
                                $checked = '';
                                if (isset($_POST['tipo_espacio_id'])) {
                                    $checked = in_array($tipo['id'], $_POST['tipo_espacio_id']) ? 'checked' : '';
                                }
                                //echo  $_POST['tipo_espacio_id'];
                                //$checked = in_array($row['id'], $_POST['categoria_id']) ? 'checked' : '';
                                echo '
                                <div class="form-check">
                                    <input class="form-check-input'.
                                    ((isset($errors) && $errors->has('tipo_espacio')) ? ' is-invalid' : '') . '" required onchange="attRequired(`tipo_espacio[]`)" type="checkbox" name="tipo_espacio[]" value="' . $tipo['id'] . '" id="tipo_espacio' . $tipo['id'] . '"
                                    ' . $checked . '>
                                    <label class="form-check-label" for="tipo_espacio' . $tipo['id'] . '">
                                    ' . $tipo['tipo'] . '
                                    </label>
                                    <div class="invalid-feedback">' .
                                        (isset($errors) ? $errors->first('tipo_espacio') : '') . '
                                    </div>
                                </div>';
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="disponible_para" class="form-label">Disponible para</label>
                            <div class="form-check">
                                <input class="form-check-input
                                <?= (isset($errors) && $errors->has('disponible_para')) ? ' is-invalid' : '' ?>"
                                required onchange="attRequired('disponible_para[]')" type="checkbox" name="disponible_para[]" id="disponible_para1" value="Renta" 
                                <?php
                                if (isset($_POST['disponible_para'])) {
                                    if (is_array($_POST['disponible_para']) || in_array('Renta', explode(',', $_POST['disponible_para']))) {
                                        echo 'checked';
                                    } else {
                                        if ($_POST['disponible_para'] == "Renta") {
                                            echo 'checked';
                                        }
                                    }
                                }
                                ?>>
                                <label class="form-check-label" for="disponible_para1">
                                    Renta
                                </label>
                                <div class="invalid-feedback">
                                    <?= isset($errors) ? $errors->first('disponible_para') : '' ?>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input
                                <?= (isset($errors) && $errors->has('disponible_para')) ? ' is-invalid' : '' ?>" required onchange="attRequired('disponible_para[]')" type="checkbox" name="disponible_para[]" id="disponible_para2" value="Intercambio" 
                                <?php
                                if (isset($_POST['disponible_para'])) {
                                    if (is_array($_POST['disponible_para']) || in_array('Intercambio', explode(',', $_POST['disponible_para']))) {
                                        echo 'checked';
                                    } else {
                                        if ($_POST['disponible_para'] == "Intercambio") {
                                            echo 'checked';
                                        }
                                    }
                                }
                                ?>>
                                <label class="form-check-label" for="disponible_para2">
                                    Intercambio
                                </label>
                                <div class="invalid-feedback">
                                    <?= isset($errors) ? $errors->first('disponible_para') : '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="estatus">Estatus del espacio</label>
                            <select name="estatus" id="estatus" required class="form-select form-select-sm form-control form-control-sm
                            <?= (isset($errors) && $errors->has('estatus')) ? ' is-invalid' : '' ?>">
                                <option selected value="">Seleciona una opción</option>
                                <option value="Disponible" <?php echo 'Disponible' == ($_POST['estatus'] ?? '') ? 'selected' : '' ?>>Disponible</option>
                                <option value="Rentado" <?php echo 'Rentado' == ($_POST['estatus'] ?? '') ? 'selected' : '' ?>>Rentado</option>
                                <option value="Fuera de servicio" <?php echo 'Fuera de servicio' == ($_POST['estatus'] ?? '') ? 'selected' : '' ?>>Fuera de servicio</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors) ? $errors->first('estatus') : '' ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="costo" class="form-label">Costo</label>
                                    <input type="number" name="costo" required class="form-control form-control-sm
                                    <?= (isset($errors) && $errors->has('costo')) ? ' is-invalid' : '' ?>" id="costo" value="<?php echo htmlentities($_POST['costo'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        <?= isset($errors) ? $errors->first('costo') : '' ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="costo_renta_dia" class="form-label">Costo de renta (por día)</label>
                                    <input type="number" name="costo_renta_dia" required class="form-control form-control-sm
                                    <?= (isset($errors) && $errors->has('costo_renta_dia')) ? ' is-invalid' : '' ?>" id="costo_renta_dia" value="<?php echo htmlentities($_POST['costo_renta_dia'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        <?= isset($errors) ? $errors->first('costo_renta_dia') : '' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="fotografia" class="form-label">Seleccione las fotografías del espacio</label>
                                <div class="mb-3">
                                    <input type="file" name="fotografia[]" class="form-control form-control-sm
                                    <?= (isset($fotosValidacion) && in_array('fotografia', $fotosValidacion)) ? ' is-invalid' : '' ?>" id="fotografia1" accept=".jpg" value="<?php echo htmlentities($_POST['fotografia'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Sube todas las fotografias
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="fotografia" class="form-label">(.jpg)</label>
                                    <input type="file" <?= $requerido ?> name="fotografia[]" class="form-control form-control-sm
                                    <?= (isset($fotosValidacion) && in_array('fotografia', $fotosValidacion)) ? ' is-invalid' : '' ?>" id="fotografia2" accpet=".jpg" value="<?php echo htmlentities($_POST['fotografia'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Sube todas las fotografias
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="file" <?= $requerido ?> name="fotografia[]" class="form-control form-control-sm
                                    <?= (isset($fotosValidacion) && in_array('fotografia', $fotosValidacion)) ? ' is-invalid' : '' ?>" id="fotografia3" accept=".jpg" <?php echo htmlentities($_POST['fotografia'] ?? '') ?>>
                                    <div class="invalid-feedback">
                                        Sube todas las fotografias
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="file" <?= $requerido ?> name="fotografia[]" class="form-control form-control-sm
                                    <?= (isset($fotosValidacion) && in_array('fotografia', $fotosValidacion)) ? ' is-invalid' : '' ?>" id="fotografia4" accept=".jpg" value="<?php echo htmlentities($_POST['fotografia'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Sube todas las fotografias
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="estado_id">Estado</label>
                                <select name="estado_id" id="estado_id" required class="form-select form-select-sm
                                <?= (isset($errors) && $errors->has('estado_id')) ? ' is-invalid' : '' ?>">
                                    <option selected value="">Estado...</option>
                                    <?php
                                    $sql = 'select id, estado from estados order by estado asc';
                                    foreach ($conexion->query($sql, PDO::FETCH_ASSOC) as $row) {
                                        $selected = $_POST['estado_id'] == $row['id'] ? 'selected' : '';
                                        echo <<<fin
                                                    <option value="{$row['id']}" {$selected}>{$row['estado']}</option>
                                                    fin;
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors) ? $errors->first('estado_id') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="municipio_id" class="form-label">Municipio</label>
                                <select name="municipio_id" id="municipio_id" required class="form-select form-select-sm
                                <?= (isset($errors) && $errors->has('municipio_id')) ? ' is-invalid' : '' ?>">
                                    <option selected value="">Selecciona</option>
                                    <?php
                                    $sql = 'select id, municipio from municipios where estado_id = :estado_id order by municipio asc';
                                    $sentencia = $conexion->prepare($sql);
                                    $sentencia->bindValue(':estado_id', $_POST['estado_id'], PDO::PARAM_INT);
                                    $sentencia->execute();
                                    foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                        $selected = $_POST['municipio_id'] == $row['id'] ? 'selected' : '';
                                        echo <<<fin
                                                <option value="{$row['id']}" {$selected}>{$row['municipio']}</option>
                                                fin;
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= isset($errors) ? $errors->first('municipio_id') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="calle" class="form-label">Calle</label>
                                <input type="text" name="calle" required class="form-control form-control-sm
                                <?= (isset($errors) && $errors->has('calle')) ? ' is-invalid' : '' ?>" id="calle" value="<?php echo htmlentities($_POST['calle'] ?? '') ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors) ? $errors->first('calle') : '' ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colonia" class="form-label">Colonia</label>
                                <input type="text" name="colonia" required class="form-control form-control-sm
                                <?= (isset($errors) && $errors->has('colonia')) ? ' is-invalid' : '' ?>" id="colonia" value="<?php echo htmlentities($_POST['colonia'] ?? '') ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors) ? $errors->first('colonia') : '' ?>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="numero_exterior" class="form-label">Número exterior</label>
                                    <input type="text" name="numero_exterior" required class="form-control form-control-sm
                                    <?= (isset($errors) && $errors->has('numero_exterior')) ? ' is-invalid' : '' ?>" id="numero_exterior" value="<?php echo htmlentities($_POST['numero_exterior'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        <?= isset($errors) ? $errors->first('numero_exterior') : '' ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="numero_interior" class="form-label">Numero interior</label>
                                    <input type="text" name="numero_interior" class="form-control form-control-sm" id="numero_interior" aria-describedby="numero_interiorHelp" value="<?php echo htmlentities($_POST['numero_interior'] ?? '') ?>">
                                    <div id="numero_interiorHelp" class="form-text">Opcional</div>
                                    <div class="valid-feedback">
                                        Opcional
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="codigo_postal" class="form-label">Cóigo postal</label>
                                    <input type="text" name="codigo_postal" required class="form-control form-control-sm
                                    <?= (isset($errors) && $errors->has('codigo_postal')) ? ' is-invalid' : '' ?>" id="codigo_postal" value="<?php echo htmlentities($_POST['codigo_postal'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        <?= isset($errors) ? $errors->first('codigo_postal') : '' ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="mapa" class="form-label">Mapa</label>
                                    <input type="text" name="mapa" class="form-control form-control-sm"
                                    id="codigo_postal" value="<?php echo htmlentities($_POST['mapa'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                        <button id="btn-send" type="submit" class="btn btn-primary">Enviar</button>
                        <a href="<?= BASEPATH . 'espacios'?>" class="btn btn-secondary">Volver atrás</a>
                    </div>
            </form>
        </div>
    </div>
    </div>
    <?php
    include_once('footer.php');
    ?>
    <script src="<?= BASEPATH . 'resources/js/bootstrap.min.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/validacion_bootstrap.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/jquery-3.6.0.min.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/sweetalert2.all.min.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/espacio.js' ?>"></script>
</body>

</html>