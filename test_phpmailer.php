<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';

// Crea una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

// Configura el servidor SMTP para enviar el correo
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'sistema.shouxin@gmail.com';
//$mail->Password = 'sistemas2022';
$mail->Password = 'ecbjwfygpyjwbzxo';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Configura los encabezados del correo electrónico
$mail->setFrom('webmaster@example.com', 'Intranet');
$mail->addAddress('stipro150197@gmail.com', 'destinatario');
$mail->Subject = utf8_decode('Actos de Corrupción');

// Configura el cuerpo del mensaje
$mail->Body = 'Se genero solicito, se envia detalles.';

// Adjuntamos el archivo
$mail->addAttachment('uploads/test.pdf', 'Archivito');

// Envía el correo electrónico
if (!$mail->send()) {
    echo 'El mensaje no se pudo enviar.';
    echo 'Error de PHPMailer: ' . $mail->ErrorInfo;
} else {
    echo 'Email enviado correctamente';
}
