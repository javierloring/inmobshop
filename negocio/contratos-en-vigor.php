<?php
require_once '../datos/Contrato.php';

if(isset($_POST['id_usuario']) && isset($_POST['tipo_usuario'])){
    $id_usuario = $_POST['id_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    //necesitamos seleccionar todos los contratos que tiene  el id_usuario
    //también queremos los nombres de los servicios
    $contratos = Contrato::obtenContratos($id_usuario, $tipo_usuario);
    #var_dump($contratos);
    if($contratos){
        echo json_encode($contratos);//ojo no poner decode!!!
    }else {
        echo json_encode('No tiene contratos vigentes.');
    }
}
