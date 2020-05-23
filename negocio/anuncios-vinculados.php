<?php
require_once '../datos/Anuncio.php';

if(isset($_POST['id_usuario']) &&
    isset($_POST['tipo_usuario']) &&
        isset($_POST['id_contrato'])){
    $id_usuario = $_POST['id_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $id_contrato = $_POST['id_contrato'];
    //necesitamos seleccionar todos los contratos que tiene  el id_usuario
    //también queremos los nombres de los servicios
    $contratos = Anuncio::obtenAnunciosContrato($id_usuario, $tipo_usuario, $id_contrato);
    #var_dump($contratos);
    if($contratos){
        echo json_encode($contratos);//ojo no poner decode!!!
    }else {
        echo 'No tiene anuncios vinculados al contrato.';
    }
}
