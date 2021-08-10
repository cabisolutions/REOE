<?php
$sql = <<<fin
select
    f.id,
    f.espacio_id,
    f.fotografia
from
    fotografias f
where 
    espacio_id = :espacio_id
order by f.id desc limit 4
fin;

$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':espacio_id', $row['id'], PDO::PARAM_INT);
$sentencia->execute();


$sql = <<<fin
    select 
        e.espacio_id, 
        e.tipo_espacio_id,
        t.id,
        t.tipo
    from 
        espacios_tipo_espacio e
        inner join tipos_espacio t on e.tipo_espacio_id  = t.id
    where
        espacio_id = :espacio_id
fin;

$tipo_espacio = $conexion->prepare($sql);
$tipo_espacio->bindValue(':espacio_id', $row['id'], PDO::PARAM_INT);
$tipo_espacio->execute();

?>
<div class="col-sm mb-5">
    <div class="card">


        <div id="carouselControls<?= $row['id'] ?>" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $i = 'active';
                foreach ($sentencia->fetchAll(PDO::FETCH_ASSOC) as $fotografia) {
                    //echo BASEPATH . 'uploads/espacios/fotografias/' . $fotografia['fotografia'];
                    echo
                    '<div class="catalogo-img carousel-item ' . $i . '">
                        <img src="' . BASEPATH . 'uploads/espacios/fotografias/' . $fotografia['fotografia'] . '"' . 'class="d-block w-100" alt="...">
                    </div>';

                    $i = '';
                }
                ?>
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
                foreach (explode(",", $row['disponible_para']) as $disponible_para) {
                    echo "<span class='btn btn-secondary rounded-pill'>{$disponible_para}</span>";
                }
                ?>
            </div>
            <h6 class="card-title pt-3">
                <?php
                $stringTipo_espacio = '';

                foreach ($tipo_espacio->fetchAll(PDO::FETCH_ASSOC) as $tipo) {
                    $stringTipo_espacio = $stringTipo_espacio . $tipo['tipo'] . ', ';
                }
                echo implode(',', array_unique(explode(',', substr_replace($stringTipo_espacio, '', -2))));
                ?></h6>
            <p class="card-text">​<i class="fas fa-star-of-life"></i> <?php echo htmlentities($row['nombre']) ?></p>
            <p class="card-text">​<strong> <i class="fas fa-dollar-sign"></i> <?php echo htmlentities($row['costo_renta_dia']) ?></strong></p>
            <p class="card-text"><i class="fas fa-arrows-alt"></i> <?php echo htmlentities($row['metros_cuadrados']) ?>​</p>
            <a class="btn btn-primary w-100" href="<?= BASEPATH . 'detalle_espacio?id=' . $row['id'] ?>">
                Ver detalles
            </a>
        </div>
    </div>
</div>