<?php
require('vendor/autoload.php');
use Rakit\Validation\Validator;
if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once './conexion.php';
    $sql = 'select id from espacios where id = :id';
    $espacio = $conexion->prepare($sql);
    $espacio->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $espacio->execute();
    $espacio = $espacio->fetch(PDO::FETCH_ASSOC);
    if (null == $espacio) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $espacio);
}
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detalles del espacio </title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="resources/css/catalogo.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <?php
    require_once './conexion.php';
    $sql = <<<fin
        select
            e.id
            ,e.descripcion
            ,e.nombre
            ,e.costo_renta_dia
            ,e.metros_cuadrados
        from
            espacios e
        fin;
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
    $espacio = $sentencia->fetch(PDO::FETCH_ASSOC);

        ?>
    </head>

<body>
    
      <?php
    include_once('menu.php');
    ?>
    <div class="container mt-4 pt-5">
        <h1>Detalled del espacio</h1>
    </div>
    <div class="container pt-4">
  
        <div class="pt-5 row align-items-start">
            <?php
            
            ?>
                    <div class="container">
                    <div class="col-sm mb-5">
                    <div class="card" style="width: 40rem;">
                        <div id="carouselControls<?= $row['id'] ?>" class="carousel slide" data-bs-ride="carousel">
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
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls<?= $row['id'] ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselControls<?= $row['id'] ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                   
                            </div>
                            <p class="card-text">​<i class="fas fa-star-of-life"></i> <?php echo htmlentities($espacio['nombre']) ?></p>
                            <p class="card-text"><i class="fas fa-arrows-alt"></i> <?php echo htmlentities($espacio['descripcion']) ?>​</p>
                            <p class="card-text">​<strong> <i class="fas fa-dollar-sign"></i> <?php echo htmlentities($espacio['costo_renta_dia']) ?></strong></p>
                            <p class="card-text"><i class="fas fa-arrows-alt"></i> <?php echo htmlentities($espacio['metros_cuadrados']) ?>​</p>
                            
                           
                        </div>
                    </div>
                </div>
           
    <?php
    include_once('footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>