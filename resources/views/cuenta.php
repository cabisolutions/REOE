<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container mt-4 pt-5">
        <h1>Mi cuenta</h1>
        <p class="fst-normal"><?= $segment->get('nombre') ?></p >
        <p class="fst-normal"><?= $segment->get('perfil') ?></p >
        <p class="fst-normal"><?= $segment->get('estatus') ?></p >
    </div>
</body>

</html>