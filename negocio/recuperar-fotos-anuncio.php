<?php
require_once '../datos/Anuncio.php';
#var_dump($_POST);
//recuperamos el id del anuncio
if(isset($_POST['id_anuncio'])){
    $id_anuncio = $_POST['id_anuncio'];
}
//recuperamos las fotos de la base de datos pasando el id del anuncio
$fotos = Anuncio::obtener_fotos_anuncio($id_anuncio);
echo json_encode($fotos);
$dbh = null;
