<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvidé mi contraseña</title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/sesion.css' ?>">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="row v-center p-0 m-0">
        <div class="col-sm-6 d-flex">
            <img src="svg/sesion.svg" alt="Inicia sesión">
        </div>
        <div class="col-sm-6 d-flex">
            <div class="justify-content-start">
                <h1>Olvidé mi contraseña</h1>
                <form action="<?= BASEPATH . 'olvide_contrasena'?>" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="correo_electronico" class="form-label">Correo electrónico</label>
                        <input type="email" placeholder="correo@dominio.com" required class="form-control" name="correo_electronico" id="correo_electronico" required>
                        <div class="invalid-feedback">
                            Ingresa tu correo electrónico
                        </div>
                        <?php if (isset($message)) {
                            echo "<div class='alert alert-danger' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error:</span>" . $message . "</div>";
                        } ?>
                        <?php if (isset($message_success)) {
                            echo "<div class='alert alert-success' role='alert'>
                      <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                      <span class='sr-only'></span>" . $message_success . "</div>";
                        } ?>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar correo</button>
                </form>
                <a class="btn btn-secondary w-100 mt-1" href="<?= BASEPATH . 'sesion' ?>">Regresar a inicio de sesión</a>
                <div class="text-center mt-1 fs-6">
                    <a class="w-100 btn text-decoration-underline " href="<?= BASEPATH . 'usuario' ?>">Quiero registrarme</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once('footer.php');
    ?>
    <script src="<?= BASEPATH . 'resources/js/validacion_bootstrap.js' ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>