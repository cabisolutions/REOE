<?php
//require_once ('./conexion.php');
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar espacio</title>
    <link rel="stylesheet" href="<?=BASEPATH.'resources/css/bootstrap.min.css'?>">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
        <div class="container mt-3 mb-4">
            <h1>Espacios</h1>
            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
               <!-- <form action="espacios_guarda.php" method="POST" class="needs-validation" novalidate> -->
                        <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3"> 
                                <label for="descripcion" class="form-label">Nombre del espacio</label>
                                <input type="text" name="nombre" required class="form-control form-control-sm" id="nombre" >
                                <div class="invalid-feedback">
                                    Ingresa el nombre del espacio
                                </div>
                                </div>
                                <div class="mb-3"> 
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text" name="descripcion" required class="form-control form-control-sm" id="descripción">
                                    <div class="invalid-feedback">
                                        Ingresa la descripción
                                    </div>
                                </div>
                            <div class="mb-3">
                                <label for="metros" class="form-label">Metros (cuadrados)</label>
                                <input type="text" name="metros" required class="form-control form-control-sm" id="metros">
                                <div class="invalid-feedback">
                                    Ingresa los metros
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="disponible_para" class="form-label">Disponible para</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="disponible_para" id="disponible_para" >
                                    <label class="form-check-label" for="disponible_para">
                                        Renta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="disponible_para" id="disponible_para" >
                                    <label class="form-check-label" for="disponible_para">
                                        Intercambio
                                    </label>
                                    <div class="invalid-feedback">
                                        Selecciona una opción
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="estatus">Estatus del espacio</label>
                                <select class="form-select" name="estatus" id="estatus" required class="form-control form-control-sm">
                                    <option selected value="">...</option>
                                    <option value="1">Disponible</option>
                                    <option value="2">Rentado</option>
                                    <option value="3">Fuera de servicio</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecciona el status del espacio
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="costo" class="form-label">Costo</label>
                                        <input type="text" name="costo" required class="form-control form-control-sm" id="costo">
                                        <div class="invalid-feedback">
                                            Ingresa el costo
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="costo-renta-por-dia" class="form-label">Costo de renta (por día)</label>
                                        <input type="text" name="costo-renta-por-dia" required class="form-control form-control-sm" id="costo-renta-por-dia">
                                        <div class="invalid-feedback">
                                            Ingresa el costo de la renta
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                            <div class="col-sm-6">
                                    <label for="fotografia" class="form-label">Seleccione las fotografías del espacio</label>
                                    <div class="mb-3">
                                        <input type="file" name="fotografia" class="form-control form-control-sm" id="fotografia">
                                        <div class="invalid-feedback">
                                        Selecciona una fotografía del espacio 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                    <label for="fotografia" class="form-label">(.jpg)</label>
                                        <input type="file" name="fotografia" class="form-control form-control-sm" id="fotografia">
                                        <div class="invalid-feedback">
                                        Selecciona una fotografía del espacio 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <input type="file" name="fotografia" class="form-control form-control-sm" id="fotografia">
                                        <div class="invalid-feedback">
                                        Selecciona una fotografía del espacio 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <input type="file" name="fotografia" class="form-control form-control-sm" id="fotografia">
                                        <div class="invalid-feedback">
                                        Selecciona una fotografía del espacio 
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="estado_id">Estado</label>
                                    <select name="estado_id" id="estado_id" required class="form-select form-select-sm">
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
                                        Selecciona un estado
                                    </div>
                                </div> 
                                <div class="mb-3">
                                    <label for="municipio_id" class="form-label">Municipio</label>
                                    <select name="municipio_id" id="municipio_id" required class="form-select form-select-sm">
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
                                        Selecciona un municipio
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="calle" class="form-label">Calle</label>
                                        <input type="text" name="calle" required class="form-control form-control-sm" id="calle">
                                        <div class="invalid-feedback">
                                            Ingresa tu calle
                                        </div>
                                    </div> 
                                    <div class="mb-3">
                                        <label for="colonia" class="form-label">Colonia</label>
                                        <input type="text" name="colonia" required class="form-control form-control-sm" id="colonia">
                                        <div class="invalid-feedback">
                                            Ingresa tu calonia
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="numero_exterior" class="form-label">Número exterior</label>
                                    <input type="text" name="numero_exterior" required class="form-control form-control-sm" id="numero_exterior">
                                    <div class="invalid-feedback">
                                        Escribe tu número exterior
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="numero_interior" class="form-label">Numero interior</label>
                                    <input type="text" name="numero_interior" class="form-control form-control-sm" id="numero_interior" aria-describedby="numero_interiorHelp">
                                    <div id="numero_interiorHelp" class="form-text">Opcional</div>
                                    <div class="valid-feedback">
                                         Opcional
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="codigo_postal" class="form-label">Cóigo postal</label>
                                    <input type="text" name="codigo_postal" required class="form-control form-control-sm" id="codigo_postal">
                                    <div class="invalid-feedback">
                                        Escribe tu código postal
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>   
            </div> 
        </div>
    </div>
    <script src="<?=BASEPATH.'resources/js/bootstrap.min.js'?>"></script>
    <script src="<?=BASEPATH.'resources/js/validacion_bootstrap.js'?>"></script>
    <script src="<?=BASEPATH.'resources/js/jquery-3.6.0.min.js'?>"></script> 
    <script src="<?=BASEPATH.'resources/js/espacio.js'?>"></script> 
</body>
</html>