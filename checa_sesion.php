<?php
require_once('vendor/autoload.php');
$session_factory = new Aura\Session\SessionFactory;
$session = $session_factory->newInstance($_COOKIE);
$segment = $session->getSegment('renta_espacios');

if (isset($usuario) && $usuario = 'Administrador') {
    if (empty($segment->get('id')) || !is_numeric($segment->get('id')) || 'Administrador' != $segment->get('perfil')) {
        header('Location: sesion?mensaje=Inicio de sesión requerido');
        exit;
    }
}
