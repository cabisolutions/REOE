<?php
//require_once './checa-sesion.php';
require('vendor/autoload.php');

use Rakit\Validation\Validator;

if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['espacio']) && is_numeric($_GET['espacio'])) {
    require_once './conexion.php';
    $sql = 'select * from espacios where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['espacio'], PDO::PARAM_INT);
    $sentencia->execute();
    $espacio_id = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $espacio_id) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $espacio_id);
}
?>
<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" class="mt-2">
    <div class="mb-3">
        <h2> <i class="bi bi-cash-coin"></i> Rentame</h2> <h6 class="fst-normal"><?= $segment->get('nombre') ?></h6>
    </div>
    <label for="fecha_renta" class="form-label">Fecha de solicitud</label>
    <input type="date" name="fecha_renta" required class="form-control form-control-sm" id="fecha_renta" value="<?php echo htmlentities($_POST['fecha_renta'] ?? '') ?>">
    <div class="invalid-feedback">
        Ingresa la fecha de renta
    </div>
    <div class="mb-3">
        <label for="fecha_entrega" class="form-label">Inicio de renta</label>
        <input type="date" name="fecha_entrega" required class="form-control form-control-sm" id="fecha_entrega" value="<?php echo htmlentities($_POST['fecha_entrega'] ?? '') ?>">
        <div class="invalid-feedback">
            Ingresa la fecha de entrega
        </div>
    </div>
    <div class="mb-3">
        <label for="fecha_devolucion" class="form-label">Fecha de vencimiento</label>
        <input type="date" name="fecha_devolucion" required class="form-control form-control-sm" id="fecha_devolucion" value="<?php echo htmlentities($_POST['fecha_devolucion'] ?? '') ?>">
        <div class="invalid-feedback">
            Ingresa la fecha de devolucion
        </div>
    </div>

    <div class="mb-3">
        <label for="costo" class="form-label">Costo</label>
        <input type="text" name="costo" required class="form-control form-control-sm" id="costo" value="<?php echo htmlentities($_POST['costo'] ?? '') ?>">
        <div class="invalid-feedback">
            Ingresa el costo
        </div>
    </div>


    <label for="costo_penalizacion" class="form-label">Costo de penalizacion</label>
    <input type="text" name="costo_penalizacion" required class="form-control form-control-sm" id="costo_penalizacion" value="<?php echo htmlentities($_POST['costo_penalizacion'] ?? '') ?>">
    <div class="invalid-feedback">
        Ingresa el costo de penalizacion
    </div>



    <div class="mb-3">
        <label for="estatus1" class="form-label">Estatus</label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="estatus" id="estatus1" value="Reservado" <?php echo 'Reservado' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                <label class="form-check-label" for="estatus1">
                    Reservado
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="estatus" id="estatus2" value="Finalizado" <?php echo 'Finalizado' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                <label class="form-check-label" for="estatus2">
                    Disponible
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="estatus" id="estatus3" value="Cancelado" <?php echo 'Cancelado' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                <label class="form-check-label" for="estatus3">
                    Cancelado
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="estatus" id="estatus4" value="Cancelado" <?php echo 'Cancelado' == ($_POST['estatus'] ?? '') ? 'checked' : '' ?>>
                <label class="form-check-label" for="estatus4">
                    Finalizado
                </label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <button type="submit" class="btn btn btn-primary">Reservar</button>
    <a href="<?= BASEPATH . 'renta' ?>" class="btn btn-secondary btn-sm">cancelar</a>
    </div>
</form>