<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./resources/css/catalogo.css">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container mt-4 pt-5">
        <h1>Catálogo</h1>
    </div>
    <div class="container pt-4">
        <div class="row align-items-start">
            <?php
            foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $row) {
            ?>
                <div class="col-sm mb-5">
                    <div class="card">
                        <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item ">
                                    <img src="img/espacio.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item active">
                                    <img src="img/espacio2.jpg" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/espacio3.jpg" class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <?php
                                if($row['disponible_para']== 'Renta'){
                                    ?>
                                    <span class="btn btn-secondary rounded-pill">Renta</span>
                                    <?php
                                }
                                else {
                                    ?>
                                    <span class="btn btn-secondary rounded-pill">Intercambio</span>
                                    <?php
                                }
                                ?>
                            </div>
                            <h5 class="card-title pt-3">Tipo espacio - Municipio</h5>
                            <p class="card-text">​<i class="fas fa-star-of-life"></i> <?php echo htmlentities($row['nombre']) ?></p>
                            <p class="card-text">​<strong> <i class="fas fa-dollar-sign"></i>  <?php echo htmlentities($row['costo_renta_dia']) ?></strong></p>
                            <p class="card-text"><i class="fas fa-arrows-alt"></i> <?php echo htmlentities($row['metros_cuadrados']) ?>​</p>
                            <a class="btn btn-primary w-100" href="/espacio?id=<?php echo $row['id'] ?>">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <!--div class="col">
                <div class="card">
                    <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item ">
                                <img src="img/espacio.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item active">
                                <img src="img/espacio2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/espacio3.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body ">
                        <div class="col text-center">
                            <button type="button" class=" btn btn-primary rounded-pill col">Renta</button>
                            <button type="button" class=" btn btn-primary rounded-pill col">Intercambio</button>
                        </div>
                        <h5 class="card-title pt-4">Tipo espacio - Municipio</h5>
                        <p class="card-text">​<i class="fas fa-star-of-life"></i> Titulo </p>
                        <p class="card-text">​<strong><i class="fas fa-dollar-sign"></i> Precio/día</strong></p>
                        <p class="card-text"><i class="fas fa-arrows-alt"></i> ​Metros cuadrados</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item ">
                                <img src="img/espacio.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item active">
                                <img src="img/espacio2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/espacio3.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body ">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary rounded-pill col">Renta</button>
                            <button type="button" class="btn btn-primary rounded-pill col">Intercambio</button>
                        </div>
                        <h5 class="card-title pt-4">Tipo espacio - Municipio</h5>
                        <p class="card-text"><i class="fas fa-star-of-life"></i> ​Titulo </p>
                        <p class="card-text">​<strong><i class="fas fa-dollar-sign"></i> Precio/día</strong></p>
                        <p class="card-text"><i class="fas fa-arrows-alt"></i> ​Metros cuadrados</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item ">
                                <img src="img/espacio.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item active">
                                <img src="img/espacio2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/espacio3.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body ">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary rounded-pill col">Renta</button>
                            <button type="button" class="btn btn-primary rounded-pill col">Intercambio</button>
                        </div>
                        <h5 class="card-title pt-4">Tipo espacio - Municipio</h5>
                        <p class="card-text">​<i class="fas fa-star-of-life"></i> Titulo </p>
                        <p class="card-text">​<strong><i class="fas fa-dollar-sign"></i> Precio/día</strong></p>
                        <p class="card-text"><i class="fas fa-arrows-alt"></i> ​Metros cuadrados</p>
                    </div>
                </div>
            </div>
            <div class="col pt-4">
                <div class="card">
                    <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item ">
                                <img src="img/espacio.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item active">
                                <img src="img/espacio2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/espacio3.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body ">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary rounded-pill col">Renta</button>
                            <button type="button" class="btn btn-primary rounded-pill col">Intercambio</button>
                        </div>
                        <h5 class="card-title pt-4">Tipo espacio - Municipio</h5>
                        <p class="card-text"><i class="fas fa-star-of-life"></i> ​Titulo </p>
                        <p class="card-text">​<strong><i class="fas fa-dollar-sign"></i> Precio/día</strong></p>
                        <p class="card-text"><i class="fas fa-arrows-alt"></i> ​Metros cuadrados</p>
                    </div>
                </div>
            </div>

            <div class="col pt-4">
                <div class="card">
                    <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item ">
                                <img src="img/espacio.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item active">
                                <img src="img/espacio2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/espacio3.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body ">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary rounded-pill col">Renta</button>
                            <button type="button" class="btn btn-primary rounded-pill col">Intercambio</button>
                        </div>
                        <h5 class="card-title pt-4">Tipo espacio - Municipio</h5>
                        <p class="card-text"><i class="fas fa-star-of-life"></i> ​Titulo </p>
                        <p class="card-text">​<strong><i class="fas fa-dollar-sign"></i> Precio/día</strong></p>
                        <p class="card-text"><i class="fas fa-arrows-alt"></i> ​Metros cuadrados</p>
                    </div>
                </div>
            </div>
            <div class="col pt-4">
                <div class="card">
                    <div id="carouselControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item ">
                                <img src="img/espacio.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item active">
                                <img src="img/espacio2.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/espacio3.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="card-body ">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary rounded-pill col">Renta</button>
                            <button type="button" class="btn btn-primary rounded-pill col">Intercambio</button>
                        </div>
                        <h5 class="card-title pt-4">Tipo espacio - Municipio</h5>
                        <p class="card-text">​<i class="fas fa-star-of-life"></i> Titulo </p>
                        <p class="card-text">​<strong><i class="fas fa-dollar-sign"></i> Precio/día</strong></p>
                        <p class="card-text"><i class="fas fa-arrows-alt"></i> ​Metros cuadrados</p>
                    </div>
                </div>
            </div-->
        </div>
    </div>
    <script src="https://kit.fontawesome.com/d6ba4337ff.js" crossorigin="anonymous"></script>
    <script src="resources/js/bootstrap.min.js"></script>
</body>

</html>