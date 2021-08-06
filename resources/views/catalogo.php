<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/bootstrap.min.css' ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="<?= BASEPATH . 'resources/css/catalogo.css' ?>">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container mt-4 pt-5">
        <h1>Catálogo</h1>
    </div>
    <div class="container pt-4">
        <form action="<?= BASEPATH . 'catalogo' ?>" method="GET" class="d-flex flex-row">
            <input class="form-control" name="busqueda" id="busqueda" type="search" placeholder="¿Qué estás buscando?" value="<?= $_GET['busqueda'] ?? '' ?>">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle p-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Filtrar
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <?php
                    require_once './conexion.php';
                    $sql = 'select id, tipo from tipos_espacio order by tipo asc';
                    $tipos_espacios = $conexion->prepare($sql);
                    $tipos_espacios->execute();
                    foreach ($tipos_espacios->fetchAll(PDO::FETCH_ASSOC) as $tipo) {
                        $tipo['tipo'] = htmlentities($tipo['tipo']);
                        $isChecked = '';
                        if(isset($_GET['tipo_espacio']) && in_array($tipo['id'] ,$_GET['tipo_espacio'])){
                            $isChecked = 'checked';
                        }
                        echo'
                        <div class="dropdown-item" onclick="dropdown_item_check(' . $tipo['id']. ')">
                            <div class="form-check">
                                <input class="form-check-input" onclick="dropdown_item_check(' . $tipo['id']. ')" name="tipo_espacio[]"  type="checkbox"' . $isChecked   .' value="' . $tipo['id'] .'" id="' . $tipo['id'] .'">
                                <label class="form-check-label" for="flexCheckDefault">
                                    ' . $tipo['tipo'] . '
                                </label>
                            </div>
                        </div>';
                    }
                    ?>  
                </ul>
            </div>
            <button class="btn btn-success" type="submit">Buscar</button>
        </form>
        <div class="pt-5 row align-items-start">
            <?php
            if ($sentencia->rowCount() < 1) {
            ?>
                <div class="container text-center">
                    <h3>Lo sentimos, no hay espacios que coincidan con la búsqueda.</h3>
                </div>
            <?php
            } else {
                foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    include('resources/components/tarjeta_espacio.php');
                }
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
    <?php
    include_once('footer.php');
    ?>
    <script src="<?= BASEPATH . 'resources/js/catalogo.js' ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>