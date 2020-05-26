<?php
require_once '../datos/Registro.php';
if(isset($_POST['id_contrato']) && isset($_POST['id_usuario']) &&
        isset($_POST['tipo_usuario']) && isset($_POST['nombre_servicio'])){
    $id_comtrato = $_POST['id_contrato'];
    $id_usuario = $_POST['id_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $nombre_servicio = $_POST['nombre_servicio'];
    if($registro = Registro::registroAltaContrato($id_contrato, $id_usuario, $tipo_usuario, $nombre_servicio)){
        echo $registro;//número de filas afectadas
    }else{
        echo 'No se ha registrado el alta del contrato.';
    }
}
