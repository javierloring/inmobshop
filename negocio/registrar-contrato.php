<?php
require_once '../datos/Contrato.php';

if(isset($_POST['id_usuario']) &&
    isset($_POST['tipo_usuario']) &&
        isset($_POST['nombre_servicio'])){

    $id_usuario = $_POST['id_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $nombre_servicio = $_POST['nombre_servicio'];
//realizamos un insert en la tabla contrato apoyándonos en las clases Servicio
//Profesional y Particular
    $registro = Contrato::registraContrato($id_usuario, $tipo_usuario, $nombre_servicio);
    if($registro != 0){
        echo $registro;//es un string con el id del contrato
    }else {
        echo 'No se ha podido registrar el contrato del servicio.';
    }
}
