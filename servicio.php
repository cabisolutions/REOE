<?php
//require_once './checa-sesion.php';
require('vendor/autoload.php');
use Rakit\Validation\Validator;
if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once './conexion.php';
    $sql = 'select id, servicio from servicios where id = :id';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $sentencia->execute();
    $servicio = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $servicio) {
        require_once './error-no-encontrado.php';
        exit;
    }
    $_POST = array_merge($_POST, $servicio);
}
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear servicio</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilosGlobales.css">
</head>
<body>
<?php
require_once './menu.php';
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <i class="bi-ui-checks"></i> Crear servicio
                </div>
                <div class="card-body">
                    <?php
                    if ('POST' == $_SERVER['REQUEST_METHOD']) {
                      
                        $validator = new Validator;
                        $validation = $validator->make($_POST, [
                            'servicio' => 'required|min:4|max:25'
                        ]);
                        $validation->setMessages([
                            'required' => ':attribute es requerido'
                            , 'min' => ':attribute longitud mínima no se cumple'
                            , 'max' => ':attribute longitud máxima no se cumple'
                        ]);
                       
                        $validation->validate();
                        $errors = $validation->errors();
                    }
                    if ('GET' == $_SERVER['REQUEST_METHOD'] || $validation->fails()) {
                    ?>
                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                        <div class="mb-3">
                            <label for="servicio" class="form-label">Servicio</label>
                            <input type="text" name="servicio" class="form-control form-control-sm<?php echo isset($errors) && $errors->has('servicio') ? ' is-invalid' : 'is-valid' ?>" id="servicio" aria-describedby="servicioHelp" value="<?php echo $_POST['servicio'] ?? '' ?>">
                            <div id="servicioHelp" class="invalid-feedback"><?php echo isset($errors) && $errors->first('servicio') ?></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">enviar</button>
                        <a href="servicios.php" class="btn btn-secondary btn-sm">cancelar</a>
                    </form>
                    <?php
                    } else {
                    
                        require_once './conexion.php';
                        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                          
                            $sql = 'update servicios set servicio = :servicio where id = :id';
                            $sentencia = $conexion->prepare($sql);
                            $sentencia->bindValue(':servicio', $_POST['servicio'], PDO::PARAM_STR);
                            $sentencia->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                            $sentencia->execute();
                            echo '<h6>Servicio actualizado</h6>';
                            echo '<div><a href="servicio.php" class="btn btn-secondary btn-sm">servicios</a></div>';
                        } else {
                           
                            $sql = 'insert into servicios (servicio) values (:servicio)';
                            $sentencia = $conexion->prepare($sql);
                            $sentencia->bindValue(':servicio', $_POST['servicio'], PDO::PARAM_STR);
                            $sentencia->execute();
                            echo '<h6>Servicio creado</h6>';
                            echo '<div><a href="servicios.php" class="btn btn-secondary btn-sm">servicios</a></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>