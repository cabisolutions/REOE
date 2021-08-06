<?php

require_once('./vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);


try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                  //Enable SMTP authentication
    $mail->Username   = "{$_ENV['CORREO']}";                     //SMTP username
$mail->Password   = "{$_ENV['CORREO_CONTRASENA']}";                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    
    $mail->setFrom($_ENV['CORREO'], 'REOE');
    $mail->addAddress($correo_electronico);     // Receptor

    // Contenido
    $mail->CharSet = 'utf-8';
    $mail->isHTML(true);                                  
    $mail->Subject = 'Restaura tu contraseña';
    $mail->Body    = '
        <h2>Hola ' . $nombre . ', restaura tu contraseña</h2>
        <p>Recibimos una petición para restaurar tu contraseña, haz click solo sin fuiste tu.
        <br>
        <a href="https://rentadeespacios.herokuapp.com/restaurar_contraseña?key=' . $key.'&correo_electronico='.$correo_electronico  . '">Restaurar contraseña</a>
        </p>';

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
