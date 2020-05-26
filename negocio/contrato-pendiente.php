<?php
require_once '../datos/Contrato.php';
if(isset($_POST['id_usuario']) && isset($_POST['tipo_usuario'])){
    $id_usuario = $_POST['id_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    //tenemos que obtener el contrato pendiente de pago (pago == 0) de un usuario
    $resultado = Contrato::contratoPendiente($id_usuario, $tipo_usuario);
    if (!$resultado){
        echo json_encode(false);
    } else {
        echo json_encode($resultado);
    }
}
