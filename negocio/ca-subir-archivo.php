<?php
//con este script guardamos los archivos subidos en el directorio fotos-videos
//de la aplicación con el nombre asignado en el dropzone
$tipo ;
if (isset($_FILES['myFile'])) {
    $tipo = $_FILES['myFile']['type'];
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
            move_uploaded_file($_FILES['myFile']['tmp_name'], "fotos-videos/" . $_FILES['myFile']['name']);
            exit;
    }
}
