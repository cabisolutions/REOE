<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta de espacios | REOE</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/estilosGlobales.css">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-nav">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Renta de espacios</a>
            
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catálogo
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="#">Eventos</a></li>
                            <li><a class="dropdown-item" href="#">Oficinas</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <a href="./sesion.php" class="btn btn-secondary btn-sm">Iniciar sesión</a>
        </div>
    </nav>
    <div id="carrsel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/espacio1.jpg" class="d-block w-100 indexCarousel" alt="Espacio para eventos con pista de baile">
                <div class="carousel-caption">
                    <h1 class="display-2 text-white mt-5 mb-3">Espacios para eventos y oficinas</h1>
                    <button class="btn btn-secondary mb-5">Renta ahora</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/oficina1.jpg" class="d-block w-100 indexCarousel" alt="...">
                <div class="carousel-caption">
                    <h1 class="display-2 text-white mt-5 mb-3">Revisa nuestro catálogo virtual</h1>
                    <button class="btn btn-secondary mb-5">Ir a catálogo</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/oficina2.jpg" class="d-block w-100 indexCarousel" alt="...">
                <div class="carousel-caption">
                    <h1 class="display-2 text-white mt-5 mb-3">¿Más información o dudas?</h1>
                    <button class="btn btn-secondary mb-5">Contáctanos</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>