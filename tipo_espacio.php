
<?php
require('vendor/autoload.php');
use Rakit\Validation\Validator;
if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once './conexion.php';
    $sql = 'select id, tipo from tipos_espacio where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $tipos_espacio = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $tipos_espacio) {
        require_once './error_no_encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $tipos_espacio);
}
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear espacio</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
<?php
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <i class="bi bi-building"></i> tipo de  espacio
                </div>
                <div class="card-body">
                    <?php
                    if ('POST' == $_SERVER['REQUEST_METHOD']) {
                        // validamos los datos
                        $validator = new Validator;
                        $validation = $validator->make($_POST, [
                            'tipo' => 'required|in:Oficina,Salon,Auditorio'
                        ]);
                        
                        // then validate
                        $validation->validate();
                        $errors = $validation->errors();
                    }
                    if ('GET' == $_SERVER['REQUEST_METHOD'] || $validation->fails()) {
                    ?>
                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                        <div class="mb-3">
                            
                            <label for="tipo1" class="form-label">Tipo de espacio</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="tipo1" value="Oficina">
                                    <label class="form-check-label" for="tipo1">
                                        Oficina
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="tipo2" value="Salon">
                                    <label class="form-check-label" for="tipo2">
                                        Salon
                                        
                                    </label>
                                    </div>
                                     <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="tipo3" value="Auditorio">
                                    <label class="form-check-label" for="tipo3">
                                        Auditorio
                                        <div>
                                    </label>
                                </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-sm"> <i class="bi bi-plus-lg"></i> Enviar</button>    

                        <div class="alert alert-secondary" role="alert">   
                      <a href="tipo_espacio.php" class="btn btn-secondary btn-sm">cancelar</a>
                    </form>
                    <?php
                   } else {
                    // es post y todo está bien
                   require_once './conexion.php';
                   $sql = <<<fin
insert into tipos_espacio
(
tipo
) values (
:tipo
)
fin;

$sentencia = $conexion->prepare($sql);
$sentencia->bindValue(':tipo', $_REQUEST['tipo'], PDO::PARAM_STR);
$sentencia->execute();
echo '<h2>Usuario creado</h2>';

 // asociar 
 $espacio_id = $conexion->lastInsertId();
 $sql = <<<fin
insert into espacios_tipo_espacio
(espacio_id, tipo_espacio_id)
values(:espacio_id, :espacio_id)
fin;
 $sentencia = $conexion->prepare($sql);
 foreach($_POST['tipo_espacio_id'] as $tipo_espacio_id) {
     $sentencia->bindValue(':espacio_id', $espacio_id, PDO::PARAM_INT);
     $sentencia->bindValue(':tipo_espacio_id', $tipo_espacio_id, PDO::PARAM_INT);
     $sentencia->execute();
 }

}
    
                    
                    ?>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
<script src="js/validacion_bootstrap.js"></script>
</body>
</html>