<?php
//utilizamos recursos de la aplicación
require_once '../vendor/autoload.php';
//la configuración general
require_once '../config.php';
//los capa de datos
require_once '../datos/Usuario.php';
//la capa de negocio
require_once '../negocio/funciones-registro.php';


//si no recibimos un id de usuario, y un token reenviamos al home
if(empty($_GET['id_usuario'])){
    header('Location: ..\index.php');
}
if(empty($_GET['token'])){
    header('Location: ..\index.php');
}
//recuperamos los datos devueltos por el usuario
if(isset($_GET['id_usuario']) && isset($_GET['val'])){
    $id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_STRING);
    $token_password = filter_input(INPUT_GET, 'val', FILTER_SANITIZE_STRING);
    //verificamos que el id de usuario y el token_password sean de un registro
    //válido y que el usuario haya solicitado su password
    $solicitado = verificaTokenPassword($id_usuario, $token_password;
    if($solicitado != 0 && $solicitado != 1){
        echo $solicitado;
        exit;
    }else if ($solicitado == 0) {
        echo 'No se solicitó la contraseña.';
        exit;
    }else if($solicitado == 1){
        // code...
    }
?>
