<div class="card bg-<?php echo $color; ?> text-white shadow m-3" style="width: <?php echo $ancho; ?>;">
    <div class="card-body">
        <div class="row">
            <div class="col-4 text-center">
                <span class="display-2">
                    <?php
                    echo htmlentities($conteo['COUNT(id)'] ?? '');
                    ?>
                </span>
            </div>
            <div class="col-8 vertical-center">
                <span class="h4 pt-2">
                    <?php
                    echo htmlentities($texto ?? '');
                    ?>
                </span>
            </div>
        </div>
        <?php
            echo $extra;
        ?>
        <a href="<?php echo $direccion; ?>" class="btn btn-<?php echo $color; ?>  shadow"><?php echo $accion; ?></a>
    </div>
</div>