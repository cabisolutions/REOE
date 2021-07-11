<?php
require('vendor/autoload.php');

use Rakit\Validation\Validator;

require_once './conexion.php';
$accion = 'Crear usuario';
if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $accion = 'Editar usuario';
    $sql = 'select direccion_id, nombre, primer_apellido, segundo_apellido, sexo, fecha_nacimiento, numero_celular, correo_electronico, contrasena, perfil, estatus, identificación, comprobante_domicilio from usuarios where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $usuario) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $usuario);
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities($accion) ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                Usuario
            </div>
            <div class="card-body">
                <?php
                if ('POST' == $_SERVER['REQUEST_METHOD']) {
                    // validamos los datos
                    $validator = new Validator;
                    $validation = $validator->make($_POST, [
                        'nombre' => 'required|min:4|max:45',
                        'primer_apellido' => 'required|min:4|max:45',
                        'segundo_apellido' => 'nullable|max:45',
                        'sexo' => 'required|in:Femenino,Masculino',
                        'fecha_nacimiento' => 'required|date:Y-m-d|before:yesterday',
                        'numero_celular' => 'required|min:10|max:45',
                        'correo_electronico' => 'required|email',
                        'contrasena' => 'nullable|min:8',
                        'contrasena_confirma' => 'nullable|same:contrasena',
                        'perfil' => 'required|in:Administrador,Cliente',
                        'estatus' => 'required|in:Activo,Inactivo',
                        'calle' => 'required|min:2',
                        'colonia' => 'required|min:3',
                        'numero_exterior' => 'required|min:1',
                        'codigo_postal' => 'required|min:2'
                    ]);

                    $validation->setMessages([
                        'required' => ':attribute es requerido',
                        'min' => ':attribute longitud mínima no se cumple',
                        'max' => ':attribute longitud máxima no se cumple'
                    ]);
                    // then validate
                    $validation->validate();
                    $errors = $validation->errors();
                }
                if ('GET' == $_SERVER['REQUEST_METHOD'] ) {
                ?>
                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        <!-- <form action="valores_recibidos.php" method="POST" class="needs-validation" novalidate> -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" required class="form-control form-control-sm" id="nombre">
                                    <div class="invalid-feedback">
                                        Ingresa tu nombre
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="primer_apellido" class="form-label">Primer Apellido</label>
                                    <input type="text" name="primer_apellido" required class="form-control form-control-sm" id="primer_apellido">
                                    <div class="invalid-feedback">
                                        Ingresa tu primer apellido
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                                    <input type="text" name="segundo_apellido" required class="form-control form-control-sm" id="segundo_apellido">
                                    <div class="invalid-feedback">
                                        Ingresa tu segundo apellido
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="sexo1" class="form-label">Sexo</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo1" required value="Femenino">
                                        <label class="form-check-label" for="sexo1">
                                            Femenino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexo" id="sexo2" required value="Masculino">
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
                                    <input type="date" name="fecha_nacimiento" required class="form-control form-control-sm" id="fecha_nacimiento">
                                    <div class="invalid-feedback">
                                        Ingresa tu fecha de nacimiento
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="numero_celular" class="form-label">Número de celular</label>
                                            <input type="tel" name="numero_celular" required class="form-control form-control-sm" id="numero_celular">
                                            <div class="invalid-feedback">
                                                Escribe tu número de celular
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="correo_electronico" class="form-label">Correo electrónico</label>
                                            <input type="email" name="correo_electronico" required class="form-control form-control-sm" id="correo_electronico">
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
                                            <input type="password" name="contrasena" required class="form-control form-control-sm" id="contrasena">
                                            <div class="invalid-feedback">
                                                Escribe una contraseña
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="contrasena_confirma" class="form-label">Contraseña (confirma)</label>
                                            <input type="password" name="contrasena_confirma" required class="form-control form-control-sm" id="contrasena_confirma">
                                            <div class="invalid-feedback">
                                                Confirma tu contraseña
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="perfil1" class="form-label">Perfil</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="perfil" id="perfil1" required value="Administrador">
                                                <label class="form-check-label" for="perfil1">
                                                    Administrador
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="perfil" id="perfil2" required value="Cliente">
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
                                                <input class="form-check-input" type="radio" name="estatus" id="estatus1" required value="Activo">
                                                <label class="form-check-label" for="estatus1">
                                                    Activo
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="estatus" id="estatus2" required value="Inactivo">
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
                                <div class="mb-3">
                                    <label for="identificacion" class="form-label">Identificación (.jpg)</label>
                                    <input type="file" name="identificacion" required class="form-control form-control-sm" id="identificacion" accept=".jpg">
                                    <div class="invalid-feedback">
                                        Selecciona una imagen .jpg de tu identificación
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comprobante_domicilio" class="form-label">Comprobante de domicilio (.jpg)</label>
                                    <input type="file" name="comprobante_domicilio" required class="form-control form-control-sm" id="comprobante_domicilio" accept=".jpg">
                                    <div class="invalid-feedback">
                                        Selecciona una imagen .jpg de tu comrpobante de domicilio
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="calle" class="form-label">Calle</label>
                                            <input type="text" name="calle" required class="form-control form-control-sm" id="calle">
                                            <div class="invalid-feedback">
                                                Escribe tu calle
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="calle" class="form-label">Colonia</label>
                                            <input type="text" name="colonia" required class="form-control form-control-sm" id="colonia">
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
                                                Ok, es opcional
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
                                            <label for="municipio" class="form-label">Municipio</label>
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
                                <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>
                <?php
                } else {
                    // es post y todo está bien
                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        //actualizamos
                        $sql = <<<fin
                        update usuarios set
                            nombre = :nombre
                            , primer_apellido = :primer_apellido
                            , segundo_apellido = :segundo_apellido
                            , sexo = :sexo
                            , fecha_nacimiento = :fecha_nacimiento
                            , numero_celular = :numero_celular
                            , correo_electronico = :correo_electronico
                            , contrasena = :contrasena
                            , perfil = :perfil
                            , estatus = :estatus
                        where
                            id = :id
                        fin;
                        // ¿cambiar contraseña?
                        if (!$errors->has('contrasena') && !$errors->has('contrasena_confirma') && !empty($_POST['contrasena'])) {
                            $opciones = [
                                'cost' => 12,
                            ];
                            $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT, $opciones);
                        } else {
                            // dejamos la misma contraseña
                            $sentencia = $conexion->prepare('select contrasena from usuarios where id = :id');
                            $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                            $sentencia->execute();
                            $contrasena = $sentencia->fetchColumn(0);
                        }
                        $sentencia = $conexion->prepare($sql);
                        $sentencia->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
                        $sentencia->bindValue(':primer_apellido', $_POST['primer_apellido'], PDO::PARAM_STR);
                        $sentencia->bindValue(':segundo_apellido', $_POST['segundo_apellido'], PDO::PARAM_STR);
                        $sentencia->bindValue(':sexo', $_POST['sexo'], PDO::PARAM_STR);
                        $sentencia->bindValue(':fecha_nacimiento', $_POST['fecha_nacimiento'], PDO::PARAM_STR);
                        $sentencia->bindValue(':numero_celular', $_POST['numero_celular'], PDO::PARAM_STR);
                        $sentencia->bindValue(':correo_electronico', $_POST['correo_electronico'], PDO::PARAM_STR);
                        $sentencia->bindValue(':contrasena', $contrasena, PDO::PARAM_STR);
                        $sentencia->bindValue(':perfil', $_POST['perfil'], PDO::PARAM_STR);
                        $sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
                        $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                        $sentencia->execute();
                        echo '<h6>Usuario actualizado</h6>';
                        echo '<div><a href="usuarios.php" class="btn btn-secondary btn-sm">usuarios</a></div>';
                    } else {
                        //creamos
                        $sql = <<<fin
                        insert into direcciones(
                            estado_id, 
                            municipio_id, 
                            calle,
                            colonia, 
                            numero_exterior, 
                            numero_interior, 
                            codigo_postal
                        ) values (
                            :estado_id, 
                            :municipio_id, 
                            :calle, 
                            :colonia, 
                            :numero_exterior, 
                            :numero_interior, 
                            :codigo_postal
                            )
                        fin;
                        
                        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT, $opciones);
                        $sentencia = $conexion->prepare($sql);
                        $sentencia->bindValue(':estado_id', $_POST['estado_id'], PDO::PARAM_INT);
                        $sentencia->bindValue(':municipio_id', $_POST['municipio_id'], PDO::PARAM_INT);
                        $sentencia->bindValue(':calle', $_POST['calle'], PDO::PARAM_STR);
                        $sentencia->bindValue(':colonia', $_POST['colonia'], PDO::PARAM_STR);
                        $sentencia->bindValue(':numero_exterior', $_POST['numero_exterior'], PDO::PARAM_STR);
                        $sentencia->bindValue(':numero_interior', $_POST['numero_interior'], PDO::PARAM_STR);
                        $sentencia->bindValue(':codigo_postal', $_POST['codigo_postal'], PDO::PARAM_STR);
                        $sentencia->execute();

                        $direccion_id = $conexion->lastInsertId();

                        $sql = <<<fin
                        insert into usuarios (
                            direccion_id, 
                            nombre, 
                            primer_apellido, 
                            segundo_apellido, 
                            sexo, 
                            fecha_nacimiento, 
                            numero_celular, 
                            correo_electronico, 
                            contrasena, 
                            perfil, 
                            estatus, 
                            identificacion, 
                            comprobante_domicilio
                        ) values (
                            :direccion_id, 
                            :nombre, 
                            :primer_apellido, 
                            :segundo_apellido, 
                            :sexo, 
                            :fecha_nacimiento, 
                            :numero_celular, 
                            :correo_electronico, 
                            :contrasena, 
                            :perfil, 
                            :estatus, 
                            :identificacion, 
                            :comprobante_domicilio
                        )
                        fin;
                        // Encriptamos la contraseña
                        $opciones = [
                            'cost' => 12,
                        ];

                        if (is_uploaded_file($_FILES['identificacion']['tmp_name'])) {
                            $nombre_identificacion = uniqid('id-', true) . '.jpg'; // se supone sólo se admiten .jpg
                            // mover archivo a su ubicación final
                            move_uploaded_file($_FILES['identificacion']['tmp_name'], './usuarios/identificaciones/' . $nombre_identificacion);
                        }
                        if (is_uploaded_file($_FILES['comprobante_domicilio']['tmp_name'])) {
                            $nombre_comprobante_domicilio = uniqid('cd-', true) . '.jpg'; // se supone sólo se admiten .jpg
                            // mover archivo a su ubicación final
                            move_uploaded_file($_FILES['comprobante_domicilio']['tmp_name'], './usuarios/comprobantes_domicilio/' . $nombre_comprobante_domicilio);
                        }

                        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT, $opciones);
                        $sentencia = $conexion->prepare($sql);
                        $sentencia->bindValue(':direccion_id', $direccion_id, PDO::PARAM_STR);
                        $sentencia->bindValue(':nombre', $_POST['nombre'], PDO::PARAM_STR);
                        $sentencia->bindValue(':primer_apellido', $_POST['primer_apellido'], PDO::PARAM_STR);
                        $sentencia->bindValue(':segundo_apellido', $_POST['segundo_apellido'], PDO::PARAM_STR);
                        $sentencia->bindValue(':sexo', $_POST['sexo'], PDO::PARAM_STR);
                        $sentencia->bindValue(':fecha_nacimiento', $_POST['fecha_nacimiento'], PDO::PARAM_STR);
                        $sentencia->bindValue(':numero_celular', $_POST['numero_celular'], PDO::PARAM_STR);
                        $sentencia->bindValue(':correo_electronico', $_POST['correo_electronico'], PDO::PARAM_STR);
                        $sentencia->bindValue(':contrasena', $contrasena, PDO::PARAM_STR);
                        $sentencia->bindValue(':perfil', $_POST['perfil'], PDO::PARAM_STR);
                        $sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
                        $sentencia->bindValue(':identificacion',$nombre_identificacion, PDO::PARAM_STR);
                        $sentencia->bindValue(':comprobante_domicilio',$nombre_comprobante_domicilio, PDO::PARAM_STR);
                        $sentencia->execute();
                        echo '<h6>Usuario creado</h6>';
                        echo '<div><a href="usuario.php" class="btn btn-secondary btn-sm">usuarios</a></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="js/validacion_bootstrap.js"></script> 
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('#estado_id').change(function() {
                $.getJSON('municipios.php', {estado_id:$(this).val()}, function(data, textStatus, jqXHR) {
                    // console.log(data.data);
                    var municipios = $('#municipio_id');
                    municipios.html('<option value="">Selecciona</option>')
                    data.data.forEach(function (v, i) {
                        // console.log(v);
                        municipios.append(new Option(v['municipio'], v['id']));
                    });
                });
            });
        });
    </script>
</body>

</html>