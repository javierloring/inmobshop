<?php
require_once '../datos/Anuncio.php';

if(isset($_POST['id_anuncio'])){
    $id_anuncio = $_POST['id_anuncio'];
    //necesitamos seleccionar el tipo de inmueble, si es un terreno el tipo_suelo
    //si es una construcción el tipo_construccion y si es una vivienda el tipo
    //de vivenda. Usamos los métodos estáticos
    //obtenTipoTerreno(), obtenTipoConstruccion(), obtenTipoVivienda()
    $tipo_suelo = Anuncio::obtenTipoTerreno($id_anuncio);
    #var_dump($tipo_suelo);
    $tipo_construccion = Anuncio::obtenTipoConstruccion($id_anuncio);
    #var_dump($tipo_construccion);
    $tipo_vivienda = Anuncio::obtenTipoVivienda($id_anuncio);
    #var_dump($tipo_vivienda);
    #var_dump($contratos);
    if($tipo_suelo){
        echo json_encode($tipo_suelo);//ojo no poner decode!!!
    }else if($tipo_vivienda) {
        echo json_encode($tipo_vivienda);//ojo no poner decode!!!
    }else if($tipo_construccion && !$tipo_vivienda){
        echo json_encode($tipo_construccion);//ojo no poner decode!!!
    }else {
        echo 'No se ha encontrado el tipo de inmueble';
    }
}
