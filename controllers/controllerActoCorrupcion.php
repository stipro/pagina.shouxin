<?php
header('Content-type: application/json; charset=utf-8');
// Verficar envio POST
if (!$_POST) {
    return;
}

// Verificar aceptación de terminos
if ($_POST['acceptedTerms'] != 1) {
    echo 'No acepto Términos y Condiciones';
    return;
}

// Verificar Anonimato
if ($_POST['anonymityactCorruption'] != 'Si') {
    if (!$_POST['namesSurnames']) {
        echo 'Falta ingresar Nombre y apellido';
    }
    if (!$_POST['dni']) {
        echo 'Falta ingresar DNI';
    }
    if (!$_POST['cellphone']) {
        echo 'Falta ingresar Telefono';
    }
    if (!$_POST['address']) {
        echo 'Falta ingresar Dirección';
    }
    if (!$_POST['email']) {
        echo 'Falta ingresar Correo';
    }
}

require_once '../models/actosCorrupcion.php';
$actoCorrupcion = new actosCorrupcion();

$val_acceptedTerms = $_POST['acceptedTerms'] ? $_POST['acceptedTerms'] : '';
$val_anonymityactCorruption = $_POST['anonymityactCorruption'] ? $_POST['anonymityactCorruption'] : '';
$val_namesSurnames = $_POST['namesSurnames'] ? $_POST['namesSurnames'] : '';
$val_dni = $_POST['dni'] ? $_POST['dni'] : '';
$val_cellphone = $_POST['cellphone'] ? $_POST['cellphone'] : '';
$val_address = $_POST['address'] ? $_POST['address'] : '';
$val_email = $_POST['email'] ? $_POST['email'] : '';
$val_typeofcomplaint = $_POST['typeofcomplaint'] ? $_POST['typeofcomplaint'] : '';
$val_lift = $_POST['lift'] ? $_POST['lift'] : '';
$rptSql = $actoCorrupcion->insert(

    $val_acceptedTerms,
    $val_anonymityactCorruption,
    $val_namesSurnames,
    intval($val_dni),
    intval($val_cellphone),
    $val_address,
    $val_email,
    $val_typeofcomplaint,
    $val_lift
);

if (!$rptSql) {
    return;
}

// Obtener ultimo registro
$lastRow = $actoCorrupcion->getLast_row();
$val_lastRow = $lastRow[0]['lastRow'];
$path_actscorruption = './../uploads/actoCorrupcion/case' . $val_lastRow . '/';

if (!file_exists($path_actscorruption)) {
    echo 'No existe carpeta, se va crear carpeta';
    mkdir($path_actscorruption, 0777, true);
}

$conteo = count($_FILES["file"]["name"]);
for ($i = 0; $i < $conteo; $i++) {
    $ubicacionTemporal = $_FILES["file"]["tmp_name"][$i];
    $nombreArchivo = $_FILES["file"]["name"][$i];
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    // Renombrar archivo
    $nuevoNombre = sprintf("%s.%s", uniqid(), $extension);
    // Mover del temporal al directorio actual
    if (!move_uploaded_file($ubicacionTemporal, $path_actscorruption . $nuevoNombre)) {
        return;
    }
}