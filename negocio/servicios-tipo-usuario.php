<?php
//obtiene los servicios existentes para un tipo de anunciante
require_once '../datos/Servicio.php';
//comprobamos que hemos recibido el tipo de usuario
if(isset($_POST['tipo_usuario'])){
    $destinatario = $_POST['tipo_usuario'];
    $servicios = Servicio::obtenServicios($destinatario);
    #var_dump($servicios);
    echo json_encode($servicios);
}else {
    echo json_encode("No se encontraron servicios.");
}
