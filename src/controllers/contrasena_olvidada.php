<?php
require_once './conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $correo_electronico = $_POST['correo_electronico'];
    $sql = 'select 
    nombre, correo_electronico
    from 
    usuarios where
    correo_electronico = :correo_electronico';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':correo_electronico', $correo_electronico , PDO::PARAM_STR);
    $sentencia->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
    if ($sentencia->rowCount() > 0){
        $_POST = array_merge($_POST, $usuario);
        $nombre = $_POST['nombre'];
        $message_success = "Correo enviado, revisa en tu inbox y sigue los pasos";
        //generating the random key
        $key = md5(time()+123456789% rand(4000, 55000000));
        //insert this temporary key into database
        $sql = 'insert into contrasena_olvidada(correo_electronico,temp_key) VALUES(:correo_electronico,:key)';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(':correo_electronico', $correo_electronico, PDO::PARAM_STR);
        $sentencia->bindValue(':key', $key, PDO::PARAM_STR);
        $sentencia->execute();
        include('enviar_correo.php');
    }
    else{
        $message = "Lo sentimos, no existe una cuenta con este email";
    }
    //echo $message;
}


include('resources/views/contrasena_olvidada.php');