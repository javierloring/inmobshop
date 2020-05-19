<?php
//con este script guardamos las fotos subidas en la carpeta mis-fotos
//de la aplicación con el nombre asignado en el dropzone
//entre los tipos de archivo admitidos se incluye vídeo aunque no se usa
$tipo ;
if (isset($_FILES['misFotos'])) {
    $tipo = $_FILES['misFotos']['type'];
    if ($tipo == 'image/pjpeg'
        || $tipo == 'image/jpeg'
        || $tipo == 'image/png'
        || $tipo == 'image/gif'
        || $tipo == 'image/webp'
        || $tipo == 'video/mpeg'
        || $tipo == 'video/mp4'
        || $tipo == 'video/ogg'
        || $tipo == 'video/webm'
        || $tipo == 'video/3gpp'
        || $tipo == 'video/3gpp2') {
            // Example:
            move_uploaded_file($_FILES['misFotos']['tmp_name'], "mis-fotos/" . $_FILES['misFotos']['name']);
            exit;
    }
}
