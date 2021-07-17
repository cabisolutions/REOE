<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/usuario.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="container pt-3">
        <h1 class="mb-0">Usuarios</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover table bg-ligth">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Perfil</th>
                        <th>Estatus</th>
                        <th>
                            <button type="button" class="btn btn-primary btn-hover btn-sm w-100" onclick="limpiarCampos()" data-bs-toggle="modal" data-bs-target="#modalUsuario" data-bs-whatever="<?php echo $row['id'] ?>">
                                <i class="bi-plus-circle-fill"></i> Crear
                            </button>
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
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="obtenerDatos(<?php echo $row['id'] ?>)" data-bs-toggle="modal" data-bs-target="#modalUsuario" data-bs-whatever="<?php echo $row['id'] ?>">
                                    <i class="bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <form id="formulario_usuario" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="number" name="direccion_id_usuario" id="direccion_id_usuario" class="d-none">
                                <input type="number" name="id_usuario" id="id_usuario" class="d-none">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input required type="text" name="nombre" disabledno class="form-control form-control-sm" id="nombre">
                                    <div class="invalid-feedback">
                                        Ingresa tu nombre
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="primer_apellido" class="form-label">Primer Apellido</label>
                                    <input type="text" name="primer_apellido" disabledno class="form-control form-control-sm" id="primer_apellido">
                                    <div class="invalid-feedback">
                                        Ingresa tu primer apellido
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                                    <input type="text" name="segundo_apellido" disabledno class="form-control form-control-sm" id="segundo_apellido">
                                    <div class="invalid-feedback">
                                        Ingresa tu segundo apellido
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="sexo1" class="form-label">Sexo</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo1" disabledno value="Femenino">
                                        <label class="form-check-label" for="sexo1">
                                            Femenino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo2" disabledno value="Masculino">
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
                                    <input type="date" name="fecha_nacimiento" disabledno class="form-control form-control-sm" id="fecha_nacimiento">
                                    <div class="invalid-feedback">
                                        Ingresa tu fecha de nacimiento
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="numero_celular" class="form-label">Número de celular</label>
                                            <input type="tel" name="numero_celular" disabledno class="form-control form-control-sm" id="numero_celular">
                                            <div class="invalid-feedback">
                                                Escribe tu número de celular
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="correo_electronico" class="form-label">Correo electrónico</label>
                                            <input type="email" name="correo_electronico" disabledno class="form-control form-control-sm" id="correo_electronico">
                                            <div class="invalid-feedback">
                                                Escribe tu correo electrónico
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="contrasena" class="form-label">Contraseña</label>
                                            <input type="password" name="contrasena" class="form-control form-control-sm" id="contrasena">
                                            <div class="invalid-feedback">
                                                Escribe una contraseña
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="contrasena_confirma" class="form-label">Contraseña
                                                (confirma)</label>
                                            <input type="password" name="contrasena_confirma" class="form-control form-control-sm" id="contrasena_confirma">
                                            <div class="invalid-feedback">
                                                Confirma tu contraseña
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="perfil1" class="form-label">Perfil</label>
                                            <div class="form-check">
                                                <input disabledno class="form-check-input" type="radio" name="perfil" id="perfil1" value="Administrador">
                                                <label class="form-check-label" for="perfil1">
                                                    Administrador
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input disabledno class="form-check-input" type="radio" name="perfil" id="perfil2" value="Cliente">
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
                                                <input disabledno class="form-check-input" type="radio" name="estatus" id="estatus1" value="Activo">
                                                <label class="form-check-label" for="estatus1">
                                                    Activo
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input disabledno class="form-check-input" type="radio" name="estatus" id="estatus2" value="Inactivo">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="identificacion" class="form-label">Identificación (.jpg)</label>
                                            <img id="imagen_identificacion" alt="" class="img-fluid rounded d-block mx-auto mb-3">
                                            <input required type="file" name="identificacion" class="form-control form-control-sm" id="identificacion" accept=".jpg" onchange="mostrarImagen(event,'identificacion')">
                                            <div class="invalid-feedback">
                                                Selecciona una imagen .jpg de tu identificación
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="comprobante_domicilio" class="form-label">Comprobante de domicilio
                                                (.jpg)</label>
                                            <img id="imagen_comprobante_domicilio" alt="" class="img-fluid rounded d-block mx-auto mb-3">
                                            <input required type="file" name="comprobante_domicilio" class="form-control form-control-sm" id="comprobante_domicilio" accept=".jpg" onchange="mostrarImagen(event,'comprobante_domicilio')">
                                            <div class="invalid-feedback">
                                                Selecciona una imagen .jpg de tu comrpobante de domicilio
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="calle_usuario" class="form-label">Calle</label>
                                            <input disabledno type="text" name="calle_usuario" class="form-control form-control-sm" id="calle_usuario">
                                            <div class="invalid-feedback">
                                                Escribe tu calle
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="colonia_usuario" class="form-label">Colonia</label>
                                            <input disabledno type="text" name="colonia_usuario" class="form-control form-control-sm" id="colonia_usuario">
                                            <div class="invalid-feedback">
                                                Escribe tu colonia
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="numero_exterior_usuario" class="form-label">Número exterior</label>
                                            <input disabledno type="text" name="numero_exterior_usuario" class="form-control form-control-sm" id="numero_exterior_usuario">
                                            <div class="invalid-feedback">
                                                Escribe tu número exterior
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="numero_interior_usuario" class="form-label">Numero interior</label>
                                            <input disabledno type="text" name="numero_interior_usuario" class="form-control form-control-sm" id="numero_interior_usuario" aria-describedby="numero_interior_usuarioHelp">
                                            <div id="numero_interior_usuarioHelp" class="form-text">Opcional</div>
                                            <div class="valid-feedback">
                                                Ok, es opcional
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="codigo_postal_usuario" class="form-label">Cóigo postal</label>
                                            <input disabledno type="text" name="codigo_postal_usuario" class="form-control form-control-sm" id="codigo_postal_usuario">
                                            <div class="invalid-feedback">
                                                Escribe tu código postal
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="estado_id_usuario" class="form-label">Estado</label>
                                            <select disabledno name="estado_id_usuario" id="estado_id_usuario" class="form-select form-select-sm">
                                                <option value="" id='estado_id_usuario_default'>Selecciona</option>
                                                <?php
                                                $sql = 'select id, estado from estados order by estado asc';
                                                foreach ($conexion->query($sql, PDO::FETCH_ASSOC) as $row) {
                                                    echo <<<fin
                                                    <option value="{$row['id']}">{$row['estado']}</option>
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
                                            <label for="municipio_id_usuario" class="form-label">Municipio</label>
                                            <select disabledno name="municipio_id_usuario" id="municipio_id_usuario" class="form-select form-select-sm">
                                                <option selected value="">Selecciona primero un estado</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Selecciona un municipio
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formulario_usuario" onclick="formSubmit(event)" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal mensaje -->
    <div class="modal fade" id="modalMensaje" tabindex="-1" aria-labelledby="modalMensaje" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMensajeTitulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Presiona continuar para guardar los cambios</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-dismiss="modal" href="#modalUsuario" role="button">Cancelar</button>
                    <button type="button" onclick="enviarPost()" class="btn btn-primary">Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/validacion_bootstrap.js"></script>
    <script src="js/usuarios.js"></script>
    <script src="js/usuario.js"></script>
</body>

</html>