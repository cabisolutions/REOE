<?php
require_once './conexion.php';
$message = "";
$valid = 'true';

if (isset($_GET['key']) && isset($_GET['correo_electronico'])) {
  $sql = '
    select * from
    contrasena_olvidada where
    correo_electronico = :correo_electronico and temp_key = :key';
  $sentencia = $conexion->prepare($sql);
  $correo_electronico = $_GET['correo_electronico'];
  $key = $_GET['key'];
  $sentencia->bindValue(':correo_electronico', $correo_electronico, PDO::PARAM_STR);
  $sentencia->bindValue(':key', $key, PDO::PARAM_STR);
  $sentencia->execute();

  //if key doesnt matches
  if ($sentencia->rowCount() < 1) {
    //echo "<h1 class='text-center'>Link no válido</h1>";
    include('error-no-encontrado.php');
    exit;
  }
} else {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST['correo_electronico'];
    $key = $_POST['key'];
    $password1 = $_POST['contrasena1'];
    $password2 = $_POST['contrasena2'];
    if ($password2 == $password1) {
      $message_success = "Contraseña establecida para " . $correo_electronico;
      $opciones = [
        'cost' => 12,
      ];
      $contrasena = password_hash($_POST['contrasena1'], PASSWORD_BCRYPT, $opciones);

      $sql = '
      delete from contrasena_olvidada where correo_electronico = :correo_electronico and temp_key = :key';
      $sentencia = $conexion->prepare($sql);
      $sentencia->bindValue(':correo_electronico', $correo_electronico, PDO::PARAM_STR);
      $sentencia->bindValue(':key', $key, PDO::PARAM_STR);
      $sentencia->execute();
      print_r($sentencia->errorInfo());


      $sql = '
      update usuarios set contrasena = :contrasena where correo_electronico = :correo_electronico';
      $sentencia = $conexion->prepare($sql);
      $sentencia->bindValue(':contrasena', $contrasena, PDO::PARAM_STR);
      $sentencia->bindValue(':correo_electronico', $correo_electronico, PDO::PARAM_STR);
      $sentencia->execute();
    } else {
      $message = "Verifica tu contraseña";
    }
  } else {
    header('location: ' . BASEPATH);
  }
}

include('resources/views/restaurar_contrasena.php');
