<?php
require('vendor/autoload.php');
require_once './conexion.php';

use Rakit\Validation\Validator;

if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = 'select id from espacios where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $id = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $id) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $id);
}

?>
<link rel="stylesheet" href="<?= BASEPATH . 'resources/css/renta.css' ?>">
<div class="card">
    <div class="card-body">
        <?php
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            // validamos los datos
            $validator = new Validator;
            $validation = $validator->make($_POST, [
                'fecha_renta' => 'required|date:Y-m-d|',
                'fecha_entrega' => 'required|date:Y-m-d|',
                'costo' => 'required|min:2',
                'costo_penalizacion' => 'nullable'

            ]);
            //'estatus' => 'required|in:Reserva,Activa,Cancelada,Teriminada'
            $validation->setMessages([
                'required' => ':attribute es requerido',
                'min' => ':attribute longitud mínima no se cumple',
                'max' => ':attribute longitud máxima no se cumple'
            ]);
            // then validate
            $validation->validate();
            $errors = $validation->errors();
            print_r($errors);
        }
        if ('GET' == $_SERVER['REQUEST_METHOD'] || $validation->fails()) {
            //$username = $segment->get('nombre');
            //print($username);
            if(isset($segment) && !empty($segment->get('id'))) {
        ?>  
            <form action="renta.php" enctype="multipart/form-data" method="POST">
                <div class="mb-3">
                    <div class="mb-3">
                        <h1> <i class="bi bi-cash-coin"></i> Rentalo </h1>
                        <h6><?= (isset($segment)) ? $segment->get('nombre') : '' ?></h6>
                    </div>
                    <label for="fecha_renta" class="form-label">Fecha del evento</label>
                    <input type="date" name="fecha_renta" onchange="inicioFecha()" required class="form-control form-control-sm" id="inicio_renta" value="<?php echo htmlentities($_POST['fecha_renta'] ?? '') ?>">
                    <div class="invalid-feedback">
                        Ingresa la fecha de renta
                    </div>
                </div>
                <div class="mb-3">

                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">Fin de la renta</label>
                        <input type="date" name="fecha_entrega" onchange="finFecha()" required class="form-control form-control-sm" id="fin_renta" value="<?php echo htmlentities($_POST['fecha_entrega'] ?? '') ?>">
                        <div class="invalid-feedback">
                            Ingresa la fecha de entrega
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">

                            <div class="mb-3">
                                <input type="date" name="fecha_devolucion" class="form-control form-control-sm d-none" id="fecha_devolucion" value="">
                            </div>
                            <label for="costo" class="form-label">Costo total</label>
                            MXN $
                            <input type="number" required class="form-control form-control-sm disable" id="costo" value="<?php echo htmlentities($_POST['costo_renta_dia'] ?? '') ?>">
                        </div>
                        <input type="number" name="costo_penalizacion" class="form-control form-control-sm d-none" id="costo_penalizacion" value="0.0">
                    </div>


                    <div class="mb-3">
                        <label for="estatus1" class="form-label">Estatus</label>
                        <div>
                            <select class="form-select" name="estatus" aria-label="Default select example">
                                <option selected>Selecciona una opción</option>
                                <option value="Reserva">Reserva</option>
                                <option value="Activa">Activa</option>
                                <option value="Cancelada">Cancelada</option>
                                <option value="Terminada">Terminada</option>
                            </select>
                        </div>
<<<<<<< HEAD
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        <?php
            }
            else {
                ?>
                <h4>Inicia sesión para rentar</h4>
                <a class="btn btn-primary" href="<?= BASEPATH . 'sesion' ?>">Iniciar</a>
                <?php
            }
        } else {
            // es post y todo está bien
            //creamos
            //$usuario_id =  $segment->get('id');
            $usuario_id =  1;
            $espacio_id = 5;
            //$espacio_id = ($_GET['id']);
=======
                        
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                   
   
                    <?php 



                    } else {
                        // es post y todo está bien
                        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                            
                            //creamos
                            $usuario_id =  $segment->get('id');
                            $espacio_id=($_GET['id']);
                           
                            
 
                            $sql = <<<fin
                                          
insert into rentas (
    usuario_id
    , espacio_id
    , fecha_renta
    , fecha_entrega
    , fecha_devolucion
    , costo
    , costo_penalizacion
    , estatus
    
) values (
    :usuario_id
    , :espacio_id 
    , :fecha_renta
    , :fecha_entrega
    , :fecha_devolucion
    , :costo
    , :costo_penalizacion
    , :estatus
)
fin;
                           
                            $sentencia = $conexion->prepare($sql);
                            $sentencia->bindValue(':usuario_id',$usuario_id,PDO::PARAM_STR);
                            $sentencia->bindValue(':espacio_id',$espacio_id,PDO::PARAM_STR);
                            $sentencia->bindValue(':fecha_renta',$_POST['fecha_renta'],PDO::PARAM_STR);
                            $sentencia->bindValue(':fecha_entrega',$_POST['fecha_entrega'],PDO::PARAM_STR);
                            $sentencia->bindValue(':fecha_devolucion',$_POST['fecha_devolucion'],PDO::PARAM_STR);
                            $sentencia->bindValue(':costo',$_POST['costo'],PDO::PARAM_STR);
                            $sentencia->bindValue(':costo_penalizacion',$_POST['costo_penalizacion'],PDO::PARAM_STR);
                            $sentencia->bindValue(':estatus',$_POST['estatus'],PDO::PARAM_STR);
                            $sentencia->execute();
                            echo '<h6>Gracias por su eleccion</h6>';
                            echo '<div><a href="catalogo" class="btn btn-secondary btn-sm">catalogo</a></div>';
                        }
                    }
                    ?>
            
>>>>>>> ce66bb055fecf09373fec8581c86d0d9026a9d4f


            //print($_POST['estatus']);

            $sql = <<<fin

            insert into rentas (
                usuario_id
                , espacio_id
                , fecha_renta
                , fecha_entrega
                , fecha_devolucion
                , costo
                , costo_penalizacion
                , estatus

            ) values (
                :usuario_id
                , :espacio_id 
                , :fecha_renta
                , :fecha_entrega
                , :fecha_devolucion
                , :costo
                , :costo_penalizacion
                , :estatus
            )
            fin;

            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(':usuario_id', $usuario_id, PDO::PARAM_STR);
            $sentencia->bindValue(':espacio_id', $espacio_id, PDO::PARAM_STR);
            $sentencia->bindValue(':fecha_renta', $_POST['fecha_renta'], PDO::PARAM_STR);
            $sentencia->bindValue(':fecha_entrega', $_POST['fecha_entrega'], PDO::PARAM_STR);
            $sentencia->bindValue(':fecha_devolucion', $_POST['fecha_devolucion'], PDO::PARAM_STR);
            $sentencia->bindValue(':costo', $_POST['costo'] + 0.0, PDO::PARAM_STR);
            $sentencia->bindValue(':costo_penalizacion', $_POST['costo_penalizacion'] + 0.0, PDO::PARAM_STR);
            $sentencia->bindValue(':estatus', $_POST['estatus'], PDO::PARAM_STR);
            $sentencia->execute();
            
            echo "
            <script src='" . BASEPATH . 'resources/js/sweetalert2.all.min.js' . "'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Renta creada',
                    showDenyButton: false,
                    showCancelButton: false,
                    confirmButtonText: `Continuar`
                  }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = '" . BASEPATH . "detalle_espacio?espacio=" . $usuario_id . "'
                        location.assign()
                    }
                  })</script>
            ";
        }

        ?>
    </div>
</div>
</div>
<script src="<?= BASEPATH . 'resources/js/renta.js' ?>"></script>
