<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta de espacios | REOE</title>
    <link rel="stylesheet" href="<?=BASEPATH . 'resources/css/bootstrap.min.css'?>">
    <link rel="stylesheet" href="<?=BASEPATH . 'resources/css/index.css'?>">
    <link rel="stylesheet" href="<?=BASEPATH . 'resources/css/estilosGlobales.css'?>">
     <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/catalogo.css' ?>">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    include('./menu.php')
    ?>
    <div id="carousel-index" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="7000">
                <img src="img/oficina1.jpg" class="d-block w-100 indexCarousel" alt="Espacio para eventos con pista de baile">
                <div class="carousel-caption">
                    <h1 class="display-1 text-white mb-5">Espacios para eventos y oficinas</h1>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="7000">
                <img src="img/espacio1.jpg" class="d-block w-100 indexCarousel" alt="Espacio para eventos con pista de baile">
                <div class="carousel-caption">
                    <h6 class="display-1 text-white mb-5">Encuentra los mejores espacios</h6>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="7000">
                <img src="img/oficina2.jpg" class="d-block w-100 indexCarousel" alt="Espacio para eventos con pista de baile">
                <div class="carousel-caption">
                    <h6 class="display-1 text-white mb-5">Revisa nuestro catálogo virtual</h6>
                </div>
            </div>
        </div>
        <form action="catalogo" method="GET" class="buscador shadow">
            <input class="form-control" name="busqueda" id="busqueda" type="search" placeholder="¿Qué estás buscando?">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Buscar</button>
            </div>
        </form>

        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-index" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-index" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section id="catalogo_mini" class="container px-5 mt-5 mb-1">
        <div class="container px-4 w-100">
            <h2 class="h1 mb-4">Destacados</h2>
            <div class="row align-items-start">
                <?php
                $pagina_inicio = true;
                include('src/controllers/catalogo.php');
                $pagina_inicio = false;
                ?>
            </div>
        </div>
    </section>
    <section id="servicios" class="container px-5 mt-3 mb-4">
        <div class="container px-4 w-100">
            <h2 class="h1 mb-4">Servicios</h2>
            <div class="row align-items-start">
                <?php
                include('src/controllers/servicios.php');
                foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    include('resources/components/tarjeta_servicio.php');
                }
                ?>
            </div>
        </div>
    </section>
    <section id="contacto" class="container px-5 mt-1 mb-4">
        <form class="container px-4 w-100">
            <h2 class="h1">Contactános</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="correo_electronico" class="form-label w-100">Asunto </label>
                        <input type="email" class="form-control" id="correo_electronico" placeholder="Intercambio de espacio">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="md-3">
                        <label for="correo_electronico" class="form-label w-100">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico" placeholder="correo@dominio.com">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar mensaje</button>
        </form>
    </section>
    <?php
    include_once('footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>