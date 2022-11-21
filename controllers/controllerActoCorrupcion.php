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

require_once '../models/actoCorrupcion.php';
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

$actoCorrupcion->insert(
    
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
