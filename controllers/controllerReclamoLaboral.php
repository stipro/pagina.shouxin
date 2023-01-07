<?php
header('Content-type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $rptController = array();

    // Verficar envio POST
    if (!$_POST) {
        $rptController["msg"] = 'No es por POST.';
        echo json_encode($rptController);
        return;
    }

    // Declaramos variables y reseteamos valor recibido
    $val_nombresApellidos = $_POST['namesSurnames'] ? $_POST['namesSurnames'] : '';
    $val_cargo = $_POST['position'] ? $_POST['position'] : '';
    $val_email = $_POST['email'] ? $_POST['email'] : '';
    $val_celular = $_POST['phone'] ? $_POST['phone'] : '';
    $val_situcionLaboral = $_POST['employmentSituation'] ? $_POST['employmentSituation'] : '';
    $val_asunto = $_POST['matter'] ? $_POST['matter'] : '';

    if (empty($_POST['array'])) {
        $rptController["msg"] = '<ul>';
        // El array está vacío o no se ha enviado
    } else {
        //$rptController["msg"] = 'Falta Nombre';
        // El array no está vacío
    }

    $verifyForm = false;
    if (!isset($val_nombresApellidos) || empty($val_nombresApellidos)) {
        $rptController["msg"] .= '<li>Falta Nombres y Apellidos.</li>';
        $verifyForm = true;
    }
    if (!isset($val_cargo) || empty($val_cargo)) {
        $rptController["msg"] .= '<li>Falta Cargo.</li>';
        $verifyForm = true;
    }
    if (!isset($val_email) || empty($val_email)) {
        $rptController["msg"] .= '<li>Falta Correo Electónico.</li>';
        $verifyForm = true;
    }
    if (!isset($val_celular) || empty($val_celular)) {
        $rptController["msg"] .= '<li>Falta Telefono.</li>';
        $verifyForm = true;
    }
    if (!isset($val_situcionLaboral) || empty($val_situcionLaboral)) {
        $rptController["msg"] .= '<li>Falta Situacion Laboral.</li>';
        $verifyForm = true;
    }
    if (!isset($val_asunto) || empty($val_asunto)) {
        $rptController["msg"] .= '<li>Falta Asunto.</li>';
        $verifyForm = true;
    }

    if ($verifyForm) {
        $rptController["status"] = 201;
        $rptController["msg"] .= '</ul>';
        echo json_encode($rptController);
        return;
    };

    $val_nombresApellidos = explode(' ', $val_nombresApellidos);

    $val_cantidad_nombresApellidos = count($val_nombresApellidos);

    $val_nombres = ($val_cantidad_nombresApellidos > 0) ? $val_nombresApellidos[0] : '';

    $val_Apellidos = ($val_cantidad_nombresApellidos > 1) ? $val_nombresApellidos[1] : '';

    require_once '../models/reclamosLaborales.php';
    $reclamosLaborales = new reclamosLaborales();

    // Obtener ultimo registro
    $lastRow = $reclamosLaborales->getLast_row();
    $val_lastRow = $lastRow[0]['lastRow'];

    // Verifico si es null y corrigo correlativo
    $val_lastRow = is_null($lastRow[0]['lastRow']) ? 1 : $lastRow[0]['lastRow'] + 1;

    $fileNameGlobal = 'reclamoLaboral' . $val_lastRow;

    $uploadDestination = './' . $fileNameGlobal . '';

    // Envia datos para registra en la base datos
    $rptSql = $reclamosLaborales->insert(
        $val_nombres,
        $val_Apellidos,
        $val_cargo,
        $val_email,
        intval($val_celular),
        $val_situcionLaboral,
        $val_asunto
    );

    if (!$rptSql) {
        $rptController["msg"] = 'Hubo un error';
        echo json_encode($rptController);
        return;
    }

    // Generamos Archivo PDF
    require('../report_reclamoLaboral.php');

    require './../vendor/phpmailer/phpmailer/src/Exception.php';
    require './../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require './../vendor/phpmailer/phpmailer/src/SMTP.php';

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
    $mail->addAttachment('reclamo_denuncia' . $val_lastRow . '.pdf', 'reclamo_denuncia' . $val_lastRow . '.pdf');

    // Envía el correo electrónico
    if (!$mail->send()) {
        $rptController["status"] = 400;
        $rptController["msgPHPMailer"] = 'El mensaje no se pudo enviar. Error de PHPMailer:' . $mail->ErrorInfo;
    } else {
        $rptController["status"] = 201;
        $rptController["msgPHPMailer"] = 'Email enviado correctamente.';
    }
} catch (Exception $e) {

    $rptController["status"] = 400;
    $rptController["msg"] .= 'Ocurrio error ' . $e->getMessage();
    //throw $th;
}

echo json_encode($rptController);