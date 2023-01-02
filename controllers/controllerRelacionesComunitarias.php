<?php
header('Content-type: application/json; charset=utf-8');

$rptController = array();

// código a ejecutar si la variable no está definida o está vacía
if (!isset($_POST['namesSurnames']) || empty($_POST['namesSurnames'])) {
}

// código a ejecutar si la variable no está definida o está vacía
if (!isset($_POST['namesSurnames']) || empty($_POST['namesSurnames'])) {
}

// Verficar envio POST
if (!$_POST) {
    $rptController["msg"] = 'No es por POST.';
    echo json_encode($rptController);
    return;
}

// Declaramos variables y reseteamos valor recibido
$val_namesSurnames = $_POST['namesSurnames'] ? $_POST['namesSurnames'] : '';
$val_direction = $_POST['direction'] ? $_POST['direction'] : '';
$val_mail = $_POST['mail'] ? $_POST['mail'] : '';
$val_mobile = $_POST['mobile'] ? $_POST['mobile'] : '';
$val_organization = $_POST['organization'] ? $_POST['organization'] : '';
$val_escort = $_POST['escort'] ? $_POST['escort'] : '';
$val_phrasesMentioned = $_POST['phrasesMentioned'] ? $_POST['phrasesMentioned'] : '';
$val_referredPeople = $_POST['referredPeople'] ? $_POST['referredPeople'] : '';
$val_eventsInTime = $_POST['eventsInTime'] ? $_POST['eventsInTime'] : '';

if (empty($_POST['array'])) {
    $rptController["msg"] = '<ul>';
    // El array está vacío o no se ha enviado
} else {
    //$rptController["msg"] = 'Falta Nombre';
    // El array no está vacío
}
$verifyForm = false;
if (!isset($val_namesSurnames) || empty($val_namesSurnames)) {
    $rptController["msg"] .= '<li>Falta Nombre.</li>';
    $verifyForm = true;
}
if (!isset($val_direction) || empty($val_direction)) {
    $rptController["msg"] .= '<li>Falta Dirección.</li>';
    $verifyForm = true;
}
if (!isset($val_mail) || empty($val_mail)) {
    $rptController["msg"] .= '<li>Falta Correo Electónico.</li>';
    $verifyForm = true;
}
if (!isset($val_mobile) || empty($val_mobile)) {
    $rptController["msg"] .= '<li>Falta Celular.</li>';
    $verifyForm = true;
}
if (!isset($val_organization) || empty($val_organization)) {
    $rptController["msg"] .= '<li>Falta Organización que representan.</li>';
    $verifyForm = true;
}
if (!isset($val_escort) || empty($val_escort)) {
    $rptController["msg"] .= '<li>Falta Acompañantes.</li>';
    $verifyForm = true;
}
if (!isset($val_phrasesMentioned) || empty($val_phrasesMentioned)) {
    $rptController["msg"] .= '<li>Falta Frases Mencionadas.</li>';
    $verifyForm = true;
}
if (!isset($val_referredPeople) || empty($val_referredPeople)) {
    $rptController["msg"] .= '<li>Falta Personas Referidas.</li>';
    $verifyForm = true;
}
if (!isset($val_eventsInTime) || empty($val_eventsInTime)) {
    $rptController["msg"] .= '<li>Falta Sucesos en el Tiempo.</li>';
    $verifyForm = true;
}

if (!isset($_FILES['file']['name'][0]) || empty($_FILES['file']['name'][0])) {
    // El archivo fue subido a través de una solicitud POST
    $rptController["msg"] .= '<li>No se adjunto archivo.</li>';
    $verifyForm = true;
}

if ($verifyForm) {
    $rptController["status"] = 201;
    $rptController["msg"] .= '</ul>';
    echo json_encode($rptController);
    return;
};

require_once '../models/relacionesComunitarias.php';
$relacionesComunitarias = new relacionesComunitarias();

// Obtener ultimo registro
$lastRow = $relacionesComunitarias->getLast_row();
$val_lastRow = $lastRow[0]['lastRow'];

// Verifico si es null y corrigo correlativo
$val_lastRow = is_null($lastRow[0]['lastRow']) ? 1 : $lastRow[0]['lastRow'] + 1;

$fileNameGlobal = 'pacto' . $val_lastRow;

$uploadDestination = './' . $fileNameGlobal . '';

function deleteFolder($uploadDestination)
{

    // Obtener una lista de todos los archivos y carpetas en la carpeta
    $files = glob("$uploadDestination/*");

    // Recorrer la lista y eliminar cada archivo y carpeta
    foreach ($files as $file) {
        if (is_dir($file)) {
            if (!rmdir($file)) {
                echo "Error al eliminar la carpeta $file.";
            }
        } else {
            if (!unlink($file)) {
                echo "Error al eliminar el archivo $file.";
            }
        }
    }

    // Eliminar la carpeta principal
    if (!rmdir($uploadDestination)) {
        echo "Error al eliminar la carpeta $uploadDestination.";
    } else {
        echo "La carpeta $uploadDestination y su contenido han sido eliminados.";
    }
}

// Comprobamos si existe carpeta si no existe lo creamos
if (!file_exists($uploadDestination)) {
    $rptController["msg2"] = 'No existe carpeta, se va crear carpeta.';
    mkdir($uploadDestination, 0777, true);
} else {
    deleteFolder($uploadDestination);
}

// Recorremos la lisa de archivos adjuntados
foreach ($_FILES['file']['name'] as $key => $fileName) {
    $uploadedFile = $_FILES["file"]["tmp_name"][$key];
    $fileName = $_FILES["file"]["name"][$key];
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Renombrar archivo
    $newName = sprintf("%s.%s", uniqid(), $extension);

    // El archivo se ha subido correctamente
    if (move_uploaded_file($uploadedFile, $uploadDestination . '/' . $newName)) {
        $rptController["msgUpload"] = 'El archivo se ha subido correctamente.';
    }
    // Ha ocurrido un error al subir el archivo
    else {
        $rptController["msgUpload"] = 'Ha ocurrido un error al subir el archivo.';
    }
}

if (extension_loaded('zip')) {
    $rptController["msgZip"] = 'El módulo zip está habilitado.';
    // El módulo zip está habilitado
} else {
    $rptController["msgZip"] = 'El módulo zip no está habilitado.';
    // El módulo zip no está habilitado
}

// Nueva instancia de la clase "ZipArchive":
$zip = new ZipArchive();

// Abre un archivo ZIP para escribir en él utilizando el método "open"
$zip->open($fileNameGlobal . '.zip', ZipArchive::CREATE);

// Recorre la carpeta y sus contenidos utilizando la función "recursiveDirectoryIterator" 
// y agrega cada archivo al archivo ZIP utilizando el método "addFile"
$iterator = new RecursiveDirectoryIterator($uploadDestination);

foreach (new RecursiveIteratorIterator($iterator) as $file) {
    if ($file->isFile()) {
        $zip->addFile($file->getPathname());
        $rptController["msgZipStatus"] = 'Se comprimio correctamente.';
    } else {
        $rptController["msgZipStatus"] = 'Hubo un error.';
    }
}

// Envia datos para registra en la base datos
$rptSql = $relacionesComunitarias->insert(
    $val_namesSurnames,
    $val_direction,
    $val_mail,
    intval($val_mobile),
    $val_organization,
    $val_escort,
    $val_phrasesMentioned,
    $val_referredPeople,
    $val_eventsInTime
);

if (!$rptSql) {
    $rptController["msg"] = 'Hubo un error';
    echo json_encode($rptController);
    return;
}


// Generamos Archivo PDF
require('../report_pactoRelaciones.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './../vendor/phpmailer/phpmailer/src/Exception.php';
require './../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './../vendor/phpmailer/phpmailer/src/SMTP.php';

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
$mail->addAddress('stipro150197', 'destinatario');
$mail->Subject = utf8_decode('Actos de Corrupción');

// Configura el cuerpo del mensaje
$mail->Body = 'Se genero solicito, se envia detalles.';

// Adjuntamos el archivo
$mail->addAttachment($fileNameGlobal.'.zip', $fileNameGlobal.'.zip');
$mail->addAttachment('case' . $val_lastRow . '.pdf', 'case' . $val_lastRow . '.pdf');

// Envía el correo electrónico
if (!$mail->send()) {
    $rptController["msgPHPMailer"] = 'El mensaje no se pudo enviar. Error de PHPMailer:' . $mail->ErrorInfo;
} else {
    $rptController["msgPHPMailer"] = 'Email enviado correctamente.';
}

// Volvemos a elimnar carpeta
//deleteFolder($uploadDestination);
