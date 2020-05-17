<?php
//SUBIDA DE ARCHIVOS A LA CARPETA DEL USUARIO y crea el objeto JSON para guardar en la base de datos
//la capa de datos
require_once '../datos/Foto.php';

if(isset($_POST['archivos'])){
    #var_dump($_POST['archivos'], $_POST['comentarios']);
    $json = '';
    $url = '';
    $texto = '';
    foreach ($_POST['archivos'] as $key => $value) {
        $url = "images/".$value;
        $texto = $_POST['comentarios'][$key];
        $json .= ("\"". $url ."\": \"". $texto ."\", ");
    }
    #var_dump($json);
    $dbh = BD::conectar();
    $tabla = 'fotos';
    $campos = ['urls_textos_fotos'];
    $valores = [$json];
    BD::insertar_registro($dbh, $tabla, $campos, $valores);
}
var_dump($json);
header('Location: index.php');
