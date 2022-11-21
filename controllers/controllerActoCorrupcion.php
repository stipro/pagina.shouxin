<?php
header('Content-type: application/json; charset=utf-8');
// Verficar envio POST
if (!$_POST) {
    echo 'Hola no es post';
    return;
}

// Verificar aceptación de terminos
if ($_POST['acceptedTerms'] != 1) {
    echo 'No acepto Términos y Condiciones';
    return;
}

// Verificar Anonimato
if ($_POST['anonymityactCorruption'] != 'Si') {
    echo 'No es anonimó';

    var_dump($_POST['namesSurnames']);
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
    require_once '../models/Personas.php';
    $val_namesSurnames = $_POST['namesSurnames'];
    $val_dni = $_POST['dni'];
    $val_cellphone = $_POST['cellphone'];
    $val_address = $_POST['address'];
    $val_email = $_POST['email'];
}

$val_acceptedTerms = $_POST['acceptedTerms'];
$val_anonymityactCorruption = $_POST['anonymityactCorruption'];
$val_typeofcomplaint = $_POST['typeofcomplaint'];
$val_lift = $_POST['lift'];


echo 'Hola';
