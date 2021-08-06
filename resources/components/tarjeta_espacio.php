
<div class="col-sm mb-5">
    <div class="card">
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
        <div class="card-body">
            <div class="text-center">
                <?php
                if ($row['disponible_para'] == 'Renta') {
                ?>
                    <span class="btn btn-secondary rounded-pill">Renta</span>
                <?php
                } else {
                ?>
                    <span class="btn btn-secondary rounded-pill">Intercambio</span>
                <?php
                }
                ?>
            </div>
            <h5 class="card-title pt-3">Tipo espacio - Municipio</h5>
            <p class="card-text">​<i class="fas fa-star-of-life"></i> <?php echo htmlentities($row['nombre']) ?></p>
            <p class="card-text">​<strong> <i class="fas fa-dollar-sign"></i> <?php echo htmlentities($row['costo_renta_dia']) ?></strong></p>
            <p class="card-text"><i class="fas fa-arrows-alt"></i> <?php echo htmlentities($row['metros_cuadrados']) ?>​</p>
            <a class="btn btn-primary w-100" href="detalle_espacio.php?id=<?php echo $row['id'] ?>">
                Ver detalles
            </a>
        </div>
    </div>
</div>