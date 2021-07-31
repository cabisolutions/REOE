<?php

?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities($accion) ?></title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/usuario.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="d-flex mt-5">
        <?php
        if (isset($segment) && !empty($segment->get('id')) && 'Administrador' == $segment->get('perfil')) {
            $opcion = 'usuarios';
            include_once('menu_admin.php');
        }
        ?>
        <div class="container mt-3 mb-4">
            <h1><?=$accion?></h1>
            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                <!-- <form action="valores_recibidos.php" method="POST" class="needs-validation" novalidate> -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" required class="form-control form-control-sm" id="nombre" value="<?php echo htmlentities($_POST['nombre'] ?? '') ?>">
                            <div class="invalid-feedback">
                                Ingresa tu nombre
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="primer_apellido" class="form-label">Primer Apellido</label>
                            <input type="text" name="primer_apellido" required class="form-control form-control-sm" id="primer_apellido" value="<?php echo htmlentities($_POST['primer_apellido'] ?? '') ?>">
                            <div class="invalid-feedback">
                                Ingresa tu primer apellido
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                            <input type="text" name="segundo_apellido" required class="form-control form-control-sm" id="segundo_apellido" value="<?php echo htmlentities($_POST['segundo_apellido'] ?? '') ?>">
                            <div class="invalid-feedback">
                                Ingresa tu segundo apellido
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sexo1" class="form-label">Sexo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo1" required value="Femenino" <?php echo 'Femenino' == ($_POST['sexo'] ?? '') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="sexo1">
                                    Femenino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexo2" required value="Masculino" <?php echo 'Masculino' == ($_POST['sexo'] ?? '') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="sexo2">
                                    Masculino
                                </label>
                                <div class="invalid-feedback">
                                    Selecciona tu sexo
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" required class="form-control form-control-sm" id="fecha_nacimiento" value="<?php echo htmlentities($_POST['fecha_nacimiento'] ?? '') ?>">
                            <div class="invalid-feedback">
                                Ingresa tu fecha de nacimiento
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="numero_celular" class="form-label">Número de celular</label>
                                    <input type="tel" name="numero_celular" required class="form-control form-control-sm" id="numero_celular" value="<?php echo htmlentities($_POST['numero_celular'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Escribe tu número de celular
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="correo_electronico" class="form-label">Correo electrónico</label>
                                    <input type="email" name="correo_electronico" required class="form-control form-control-sm" id="correo_electronico" value="<?php echo htmlentities($_POST['correo_electronico'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Escribe tu correo electrónico
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                if ('Editar usuario' == $accion) {
                                    echo <<<fin
                                            <div class="alert alert-dark" role="alert">
                                                Solo si deseas cambiar la contraseña
                                            </div>
                                            fin;
                                }
                                ?>
                                <div class="mb-3">
                                    <label for="contrasena" class="form-label">Contraseña</label>
                                    <input type="password" name="contrasena" <?php
                                                                                echo $requerido;
                                                                                ?> class="form-control form-control-sm" id="contrasena">
                                    <div class="invalid-feedback">
                                        Escribe una contraseña
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="contrasena_confirma" class="form-label">Contraseña (confirma)</label>
                                    <input type="password" name="contrasena_confirma" <?php
                                                                                        echo $requerido;
                                                                                        ?> class="form-control form-control-sm" id="contrasena_confirma">
                                    <div class="invalid-feedback">
                                        Confirma tu contraseña
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        if (isset($segment) && !empty($segment->get('id')) && 'Administrador' == $segment->get('perfil')) {
                        ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="perfil1" class="form-label">Perfil</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="perfil" id="perfil1" required value="Administrador" <?php echo 'Administrador' == ($_POST['perfil'] ?? '') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="perfil1">
                                                Administrador
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="perfil" id="perfil2" required value="Cliente" <?php echo 'Cliente' == ($_POST['perfil'] ?? '') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="perfil2">
                                                Cliente
                                            </label>
                                            <div class="invalid-feedback">
                                                Selecciona tu perfil
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="estatus1" class="form-label">Estatus</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estatus" id="estatus1" required value="Activo" <?php echo 'Activo' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="estatus1">
                                                Activo
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="estatus" id="estatus2" required value="Inactivo" <?php echo 'Inactivo' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="estatus2">
                                                Inactivo
                                            </label>
                                            <div class="invalid-feedback">
                                                Selecciona tu estatus
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="identificacion" class="form-label">Identificación (.jpg)</label>
                                    <img id="imagen_identificacion" src="
                                            <?php
                                            if (isset($_POST['identificacion']))
                                                echo BASEPATH . 'uploads/usuarios/identificaciones/' . $_POST['identificacion']
                                            ?>" alt="" class="img-fluid rounded mx-auto <?php
                                                                                        if (isset($_POST['identificacion']))
                                                                                            echo "d-block";
                                                                                        else
                                                                                            echo "d-none";
                                                                                        ?> mb-3">
                                    <input type="file" name="identificacion" <?php
                                                                                echo $requerido;
                                                                                ?> class="form-control form-control-sm" id="identificacion" accept=".jpg" onchange="mostrarImagen(event,'identificacion')">
                                    <div class="invalid-feedback">
                                        Selecciona una imagen .jpg de tu identificación
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="comprobante_domicilio" class="form-label">Comprobante de domicilio (.jpg)</label>
                                    <img id="imagen_comprobante_domicilio" src="
                                            <?php
                                            if (isset($_POST['comprobante_domicilio']))
                                                echo BASEPATH . 'uploads/usuarios/comprobantes_domicilio/' . $_POST['comprobante_domicilio']
                                            ?>" alt="" class="img-fluid rounded mx-auto <?php
                                                                                        if (isset($_POST['comprobante_domicilio']))
                                                                                            echo "d-block";
                                                                                        else
                                                                                            echo "d-none";
                                                                                        ?> mb-3">
                                    <input type="file" name="comprobante_domicilio" <?php
                                                                                    echo $requerido;
                                                                                    ?> class="form-control form-control-sm" id="comprobante_domicilio" accept=".jpg" onchange="mostrarImagen(event,'comprobante_domicilio')">
                                    <div class="invalid-feedback">
                                        Selecciona una imagen .jpg de tu comrpobante de domicilio
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="calle" class="form-label">Calle</label>
                                    <input type="text" name="calle" required class="form-control form-control-sm" id="calle" value="<?php echo htmlentities($_POST['calle'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Escribe tu calle
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="calle" class="form-label">Colonia</label>
                                    <input type="text" name="colonia" required class="form-control form-control-sm" id="colonia" value="<?php echo htmlentities($_POST['colonia'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Escribe tu colonia
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="numero_exterior" class="form-label">Número exterior</label>
                                    <input type="text" name="numero_exterior" required class="form-control form-control-sm" id="numero_exterior" value="<?php echo htmlentities($_POST['numero_exterior'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Escribe tu número exterior
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="numero_interior" class="form-label">Numero interior</label>
                                    <input type="text" name="numero_interior" class="form-control form-control-sm" id="numero_interior" aria-describedby="numero_interiorHelp" value="<?php echo htmlentities($_POST['numero_interior'] ?? '') ?>">
                                    <div id="numero_interiorHelp" class="form-text">Opcional</div>
                                    <div class="valid-feedback">
                                        Ok, es opcional
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="codigo_postal" class="form-label">Cóigo postal</label>
                                    <input type="text" name="codigo_postal" required class="form-control form-control-sm" id="codigo_postal" value="<?php echo htmlentities($_POST['codigo_postal'] ?? '') ?>">
                                    <div class="invalid-feedback">
                                        Escribe tu código postal
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="estado_id" class="form-label">Estado</label>
                                    <select name="estado_id" id="estado_id" required class="form-select form-select-sm">
                                        <option selected value="">Selecciona</option>
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
                                        Selecciona un estado
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="municipio_id" class="form-label">Municipio</label>
                                    <select name="municipio_id" id="municipio_id" required class="form-select form-select-sm">
                                        <option selected value="">Selecciona primero un estado</option>
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
                                        Selecciona un municipio
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    include_once('footer.php');
    ?>
    <script src="<?= BASEPATH . 'resources/js/bootstrap.min.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/validacion_bootstrap.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/jquery-3.6.0.min.js' ?>"></script>
    <script src="<?= BASEPATH . 'resources/js/usuario.js' ?>"></script>
</body>

</html>