<?php
require_once('vendor/autoload.php');
// ¿se intenta iniciar sesión y los parámetros se han proporcionado?
if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['correo_electronico']) && isset($_POST['contrasena'])) {
    require_once './conexion.php';
    $sql = 'select id, nombre, primer_apellido, segundo_apellido, correo_electronico, perfil, estatus, contrasena from usuarios where correo_electronico = :correo_electronico and estatus = \'Activo\'';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindValue(':correo_electronico', $_POST['correo_electronico'], PDO::PARAM_STR);
    $sentencia->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
    if (null == $usuario) {
        header('Location: sesion?mensaje=El usuario no existe');
        exit;
    }
    // ¿contraseña válida?
    if (password_verify($_POST['contrasena'], $usuario['contrasena'])) {
        // iniciar sesión y guardar datos
        $session_factory = new Aura\Session\SessionFactory;
        $session = $session_factory->newInstance($_COOKIE);
        $segment = $session->getSegment('renta_espacios');
        $segment->set('id', $usuario['id']);
        $segment->set('nombre', $usuario['nombre'] . ' ' . $usuario['primer_apellido'] . ' ' . $usuario['segundo_apellido']);
        $segment->set('correo_electronico', $usuario['correo_electronico']);
        $segment->set('perfil', $usuario['perfil']);
        $segment->set('estatus', $usuario['estatus']);
        header('Location: ' . BASEPATH);
    } else {
        header('Location: sesion?mensaje=Contraseña incorrecta');
    }
    exit;
}
else {
    include_once('resources/views/sesion.php');
}