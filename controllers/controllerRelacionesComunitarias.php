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
    $rptController["msg"] = 'No es por POST';
    echo json_encode($rptController);
    return;
}

if (!isset($_FILES['file']['name'][0]) || empty($_FILES['file']['name'][0])) {
    // El archivo fue subido a través de una solicitud POST
    // Procesa el archivo, por ejemplo, mueve el archivo a otra carpeta o almacena los datos en una base de datos
    $rptController["msgFile"] = 'No se adjunto archivo';
    echo json_encode($rptController);
    return;
}

foreach ($_FILES['file']['name'] as $key => $fileName) {
    $uploadedFile = $_FILES['file']['tmp_name'][$key];
    $uploadDestination = './controllers/' . $fileName;
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

    if (move_uploaded_file($uploadedFile, $uploadDestination)) {
        // El archivo se ha subido correctamente
        // Procesa el archivo, por ejemplo, almacenándolo en una base de datos
    } else {
        // Ha ocurrido un error al subir el archivo
        // Muestra un mensaje de error o redirige a otra página
    }
}
var_dump($_FILES['file']['name']);

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
