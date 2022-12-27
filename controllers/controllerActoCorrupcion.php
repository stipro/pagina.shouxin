<?php
header('Content-type: application/json; charset=utf-8');

$rptController = array();

// Verficar envio POST
if (!$_POST) {
    return;
}

// Verificar aceptación de terminos
if ($_POST['acceptedTerms'] != 1) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'No acepto Términos y Condiciones';
    //echo json_encode($rptController);
    return;
}

// Verificar Anonimato
if ($_POST['anonymityactCorruption'] != 'Si') {
    $verifyForm = FALSE;
    if (!$_POST['namesSurnames']) {
        $verifyForm = TRUE;
        /* echo 'Falta ingresar Nombre y apellido'; */
    }
    if (!$_POST['dni']) {
        $verifyForm = TRUE;
        /* echo 'Falta ingresar DNI'; */
    }
    if (!$_POST['cellphone']) {
        $verifyForm = TRUE;
        /* echo 'Falta ingresar Telefono'; */
    }
    if (!$_POST['address']) {
        $verifyForm = TRUE;
        /* echo 'Falta ingresar Dirección'; */
    }
    if (!$_POST['email']) {
        $verifyForm = TRUE;
        /* echo 'Falta ingresar Correo'; */
    }
    if ($verifyForm) {
        $rptController["status"] = 404;
        $rptController["msg"] = 'Falta un dato';
        //echo json_encode($rptController);
        return;
    };
}

if (!$_POST['lift']) {
    $rptController["status"] = 404;
    $rptController["msg"] = 'Falta sustento';
    //echo json_encode($rptController);
    return;
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



$valArchive = (!$_FILES["file"]["name"][0]) ? 0 : 1;

$rptSql = $actoCorrupcion->insert(
    $val_acceptedTerms,
    $val_anonymityactCorruption,
    $val_namesSurnames,
    intval($val_dni),
    intval($val_cellphone),
    $val_address,
    $val_email,
    $val_typeofcomplaint,
    $val_lift,
    $valArchive
);

if (!$rptSql) {
    return;
}

// Obtener ultimo registro
$lastRow = $actoCorrupcion->getLast_row();
$val_lastRow = $lastRow[0]['lastRow'];
$path_actscorruption = './../sistema/assets/uploads/actoCorrupcion/case' . $val_lastRow . '/';

if (!file_exists($path_actscorruption)) {
    $rptController["msg2"] = 'No existe carpeta, se va crear carpeta';
    mkdir($path_actscorruption, 0777, true);
}


$listArchiveNew;
$conteo = count($_FILES["file"]["name"]);
for ($i = 0; $i < $conteo; $i++) {
    $ubicacionTemporal = $_FILES["file"]["tmp_name"][$i];
    $nombreArchivo = $_FILES["file"]["name"][$i];
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    // Renombrar archivo
    $nuevoNombre = sprintf("%s.%s", uniqid(), $extension);
    // Almacena lista de archivos renombrados
    $listArchiveNew[] = $nuevoNombre;
    // Mover del temporal al directorio actual
    if (!move_uploaded_file($ubicacionTemporal, $path_actscorruption . $nuevoNombre)) {
        return;
    }
}
// Declaramos el nombre del archivo comprimido
$name_zip = 'case' . $val_lastRow . '.zip';

// Instanciamos la clase, esta viene en el paquete de PHP
$mizip = new ZipArchive();
$mizip->open($name_zip, ZipArchive::CREATE);

// Agregamos los archivos a comprimir
foreach ($listArchiveNew as $nuevo) {
    $parth_new = './../sistema/assets/uploads/actoCorrupcion/case' . $val_lastRow . '/' . $nuevo;

    $mizip->addFile($parth_new, str_replace('./../sistema/assets/uploads/actoCorrupcion/', '', $parth_new));
}

$mizip->close();

// Generar la descarga en el navegador
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=' . $name_zip);
header('Content-Length: ' . filesize($name_zip));
readfile($name_zip);

//Movemos Archivo
rename($name_zip, $path_actscorruption . $name_zip);

$rptController["status"] = 201;
$rptController["msg"] = 'Se registro correctamente';
/* echo json_encode($rptController); */
