<?php
require_once '../datos/Anuncio.php';
require_once '../datos/Contrato.php';

if(isset($_POST['id_usuario']) &&
    isset($_POST['tipo_usuario'])){
    $id_usuario = $_POST['id_usuario'];
    $tipo_usuario = $_POST['tipo_usuario'];
    //necesitamos seleccionar todos los contratos y los anuncios que tiene  el
    //id_usuario, también queremos los nombres de los servicios
    //$contratros es un array con los contratos y sus servicios contratados
    //[[contrato+servicio],[contrato+servicio]]
    $contratos = Contrato::obtenContratos($id_usuario, $tipo_usuario);
    if(isset($contratos)){
        $respuesta['contratos'] = $contratos;
        foreach($contratos as $contrato){
            $id_contrato = $contrato['id_contrato'];
            if(null != ($anuncios = Anuncio::obtenAnunciosContrato($id_usuario, $tipo_usuario, $id_contrato))){
                $anuncios_vinculados[$id_contrato] = $anuncios;
            }
        }
        if(isset($anuncios_vinculados)){
            $respuesta['anuncios'] = $anuncios_vinculados;
        }else {
            $mensaje = 'No tiene anuncios vinculados.';
        }
        echo json_encode($respuesta);//ojo no poner decode!!!
    }else{
        echo json_encode('No tiene contratos.');
    }
}
