<?php
var_dump($_FILES);
$nameFolder = 'case';
$micarpeta = './upload/actoCorrupsion/';
if (!file_exists($micarpeta)) {
    mkdir($micarpeta.$nameFolder, 0777, true);
}
$conteo = count($_FILES["archivos"]["name"]);
for ($i = 0; $i < $conteo; $i++) {
    $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
    $nombreArchivo = $_FILES["archivos"]["name"][$i];
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    // Renombrar archivo
    $nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);
    // Mover del temporal al directorio actual
    move_uploaded_file($ubicacionTemporal, '/upload/'.$nuevoNombre);
}
// Responder al cliente
echo json_encode(true);