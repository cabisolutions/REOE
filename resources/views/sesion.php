<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/sesion.css' ?>">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="row v-center">
        <div class="col-sm-6 d-flex">
            <img src="svg/sesion.svg" alt="Inicia sesión">
        </div>
        <div class="col-sm-6 d-flex">
            <div class="justify-content-start">
                <h1>Inicio de sesión</h1>
                <form action="sesion" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="correo_electronico" class="form-label">Correo electrónico</label>
                        <input type="email" placeholder="correo@dominio.com" required class="form-control" name="correo_electronico" id="correo_electronico" required>
                        <div class="invalid-feedback">
                            Ingresa tu correo electrónico
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" placeholder="******" required class="form-control" name="contrasena" id="contrasena" required>
                        <div class="invalid-feedback">
                            Ingresa tu contraseña
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="<?=BASEPATH.'resources/js/validacion_bootstrap.js'?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>