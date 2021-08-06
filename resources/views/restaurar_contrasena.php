<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurar contraseña</title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
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
                <h1>Restaurar contraseña</h1>
                <form action="<?= BASEPATH . 'restaurar_contrasena'?>" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <input type="text" class="d-none" name="correo_electronico" id="correo_electronico" value="<?=$_GET['correo_electronico'] ?? ''?>">
                        <input type="text" class="d-none" name="key" id="key" value="<?=$_GET['key'] ?? ''?>">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" placeholder="******" required class="form-control" name="contrasena1" id="contrasena" required>
                        <input type="password" placeholder="******" required class="form-control" name="contrasena2" id="contrasena" required>
                        <div class="invalid-feedback">
                            Ingresa una nueva contraseña
                        </div>
                        <?php if (isset($message) && $message != '') {
                            echo "<div class='alert alert-danger' role='alert'>
                      <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                      <span class='sr-only'>Error: </span>" . $message . "</div>";
                        }
                        if (isset($message_success)) {
                            echo "<div class='alert alert-success' role='alert'>
                      <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                      <span class='sr-only'></span>" . $message_success . "</div>";
                        } ?>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Restaurar contraseña</button>
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