<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta de espacios | REOE</title>
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/index.css">
    <link rel="stylesheet" href="./resources/css/estilosGlobales.css">
</head>

<body>
    <?php
    include('./menu.php')
    ?>
    <div id="carousel-index" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="7000">
                <img src="img/espacio1.jpg" class="d-block w-100 indexCarousel" alt="Espacio para eventos con pista de baile">
                <div class="carousel-caption">
                    <h1 class="display-1 text-white mb-5">Encuentra los mejores espacios</h1>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="7000">
                <img src="img/oficina1.jpg" class="d-block w-100 indexCarousel" alt="Espacio para eventos con pista de baile">
                <div class="carousel-caption">
                    <h1 class="display-1 text-white mb-5">Espacios para eventos y oficinas</h1>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="7000">
                <img src="img/oficina2.jpg" class="d-block w-100 indexCarousel" alt="Espacio para eventos con pista de baile">
                <div class="carousel-caption">
                    <h1 class="display-1 text-white mb-5">Revisa nuestro catálogo virtual</h1>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>