<?php
header('Content-type: application/json; charset=utf-8');

$rptController = array();

/* // código a ejecutar si la variable no está definida o está vacía
if (!isset($_POST['namesSurnames']) || empty($_POST['namesSurnames'])) {

    return;
}

// código a ejecutar si la variable no está definida o está vacía
if (!isset($_POST['namesSurnames']) || empty($_POST['namesSurnames'])) {

    return;
} */

// Verficar envio POST
if (!$_POST) {
    $rptController["msg"] = 'No es por POST.';
    echo json_encode($rptController);
    return;
}

if (!isset($_FILES['file']['name'][0]) || empty($_FILES['file']['name'][0])) {
    // El archivo fue subido a través de una solicitud POST
    $rptController["msgFile"] = 'No se adjunto archivo.';
    echo json_encode($rptController);
}

require_once '../models/relacionesComunitarias.php';
$relacionesComunitarias = new relacionesComunitarias();

// Obtener ultimo registro
$lastRow = $relacionesComunitarias->getLast_row();
$val_lastRow = $lastRow[0]['lastRow'];

// Verifico si es null y corrigo correlativo
$val_lastRow = is_null($lastRow[0]['lastRow']) ? 1 : $lastRow[0]['lastRow'] + 1;

$fileNameGlobal = 'case' . $val_lastRow;

$uploadDestination = './' . $fileNameGlobal . '';

// Comprobamos si existe carpeta si no existe lo creamos
if (!file_exists($uploadDestination)) {
    $rptController["msg2"] = 'No existe carpeta, se va crear carpeta.';
    mkdir($uploadDestination, 0777, true);
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
$zip->open('carpeta.zip', ZipArchive::CREATE);

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
var_dump($fileNameGlobal);
var_dump(scandir($fileNameGlobal));

function delTree($dir)
{
    var_dump($files = array_diff(scandir($dir), array('.', '..')));
    foreach ($files as $file) {
        var_dump(is_file("$dir/$file"));
    }
}
delTree($fileNameGlobal);
/* 
var_dump($files);
function delTree($dir)
{
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

delTree($fileNameGlobal); */

// Verificar Nombre
if (!$_POST['namesSurnames']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Nombre';
    echo json_encode($rptController);
    return;
}

// Verificar Direccion
if (!$_POST['direction']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Direccion';
    echo json_encode($rptController);
    return;
}

// Verificar Correo
if (!$_POST['mail']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Correo';
    echo json_encode($rptController);
    return;
}

// Verificar Correo
if (!$_POST['mobile']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Correo';
    echo json_encode($rptController);
    return;
}

// Verificar Organización
if (!$_POST['organization']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Organización';
    echo json_encode($rptController);
    return;
}

// Verificar Acompañantes
if (!$_POST['escort']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Acompañantes';
    echo json_encode($rptController);
    return;
}

// Verificar Frases Mencionadas
if (!$_POST['phrasesMentioned']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Frases Mencionadas';
    echo json_encode($rptController);
    return;
}

// Verificar Personas Referidas
if (!$_POST['referredPeople']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Personas Referidas';
    echo json_encode($rptController);
    return;
}

// Verificar Sucesos en el Tiempo
if (!$_POST['eventsInTime']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta Sucesos en el Tiempo';
    echo json_encode($rptController);
    return;
}
