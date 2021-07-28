<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-nav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Renta de espacios</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?=BASEPATH?>">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?=BASEPATH.'catalogo'?>" id="navbarScrollingDropdown" role="button" aria-expanded="false">
                        Catálogo
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="catalogo">Ver todo</a></li>
                        <li><a class="dropdown-item" href="catalogo">Eventos</a></li>
                        <li><a class="dropdown-item" href="#">Oficinas</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?=BASEPATH.'resumen'?>" class="nav-link">Administrar</a>
                </li>
                <li class="nav-item">
                    <a href="<?=BASEPATH.'cuenta'?>" class="nav-link">Mi cuenta</a>
                </li>
                <li class="nav-item">
                    <a href="<?=BASEPATH.'sesion'?>" class="nav-link">Iniciar sesión</a>
                </li>
            </ul>
        </div>
        <link rel="stylesheet" href="<?=BASEPATH.'resources/css/estilosGlobales.css'?>">
        <script src="<?=BASEPATH.'resources/js/jquery-3.6.0.min.js'?>"></script>
        <script src="<?=BASEPATH.'resources/js/menu.js'?>"></script>
    </div>
</nav>