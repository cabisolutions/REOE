<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel administrativo</title>
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./resources/css/panel_administrador.css">
</head>

<body>
    <div class="container-fluid d-flex flex-row p-0 pe-3">
        <div class="nav flex-column nav-pills me-3 hvh-100 shadow pt-4" id="v-pills-tab" role="tablist"
            aria-orientation="vertical">
            <h2 class="h5 text-center pb-3">Administración</h2>
            <button class="nav-link shadow-sm active" id="v-pills-resumen-tab" data-bs-toggle="pill" data-bs-target="#v-pills-resumen"
                type="button" role="tab" aria-controls="v-pills-resumen" aria-selected="true">
                <i class="bi bi-house-door"></i> Resumen
            </button>
            <button class="nav-link shadow-sm" id="v-pills-espacios-tab" data-bs-toggle="pill" data-bs-target="#v-pills-espacios"
                type="button" role="tab" aria-controls="v-pills-espacios" aria-selected="false">
                <i class="bi bi-building"></i> Espacios
            </button>
            <button class="nav-link shadow-sm" id="v-pills-rentas-tab" data-bs-toggle="pill" data-bs-target="#v-pills-rentas"
                type="button" role="tab" aria-controls="v-pills-rentas" aria-selected="false">
                <i class="bi bi-cash-coin"></i> Rentas
            </button>
            <button class="nav-link shadow-sm" id="v-pills-usuarios-tab" data-bs-toggle="pill" data-bs-target="#v-pills-usuarios"
                type="button" role="tab" aria-controls="v-pills-usuarios" aria-selected="false">
                <i class="bi bi-people"></i> Usuarios
            </button>
        </div>
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-resumen" role="tabpanel" aria-labelledby="v-pills-resumen-tab">
                <div class="container">
                    <?php
                    include_once('resumen_panel_administracion.php');
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-espacios" role="tabpanel" aria-labelledby="v-pills-espacios-tab">
                <div class="container">
                    <?php
                    include_once('./espacios.php');
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-rentas" role="tabpanel" aria-labelledby="v-pills-rentas-tab">4
            </div>
            <div class="tab-pane fade" id="v-pills-usuarios" role="tabpanel" aria-labelledby="v-pills-usuarios-tab">
                <div class="container">
                    <?php
                    include_once('usuarios.php');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>