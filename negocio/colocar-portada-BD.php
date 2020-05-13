<?php
require '../datos/Anuncio.php';
/**
 * Devuelve el id, la url de la foto principal del anuncio a colocar en portada
 * la localidad y el precio
 * @param  array $anuncios_n5   el conjunto de anuncios de nivel 5
 * @return array $anuncio       el anuncio cuya fecha coincide con la de hoy
 */
function anuncio_a_colocar_en_portada($anuncios_n5){
    //obtenemos el id y la url de la foto principal del anuncio con fecha de hoy
    //inincializamos las variables
    $id_anuncio = 0;
    $url_foto_anuncio = '';
    $localidad = '';
    $precio = 0;
    $anuncio_hoy = 0;

    $fecha_hoy = getdate();
    #var_dump($fecha_hoy[0]);
    //comprobamos qué anuncio tiene la fecha de hoy, que será el buscado para
    //colocar en portda
    $diferencia = 24*3600;
    for ($i=0; $i < count($anuncios_n5); $i++) {
        #var_dump($anuncios_n5[$i]['fecha_anuncio']);
        $dif = $anuncios_n5[$i]['fecha_anuncio'] - $fecha_hoy[0];
        if($dif < $diferencia) {
            $diferencia = $dif;
            $anuncio_hoy = $i;
        }
    }
    //pasamos al anuncio los datos id y url
    $anuncio = $anuncios_n5[$anuncio_hoy];
    //devolvemos el anuncio que se debe colocar en la portada y su foto
    #var_dump($anuncio);
    #die();
    echo json_encode($anuncio);
    $dbh = null;
}
/**
 *obtenemos la fecha más lejana para colocar los nuevos anuncios en la cola
 * @param  array   $anuncios_n5     el nuevo conjunto de anuncios de nivel 5
 * @return integer $ultima_fecha             [description]
 */
function obtener_fecha_mas_lejana($anuncios_n5){
    #var_dump($anuncios_n5);
    //vemos cual es la fecha más lejana o última fecha
    $ultima_fecha = 0;
    for ($i=0; $i < count($anuncios_n5); $i++) {
        if($anuncios_n5[$i]['fecha_anuncio']*1 >= $ultima_fecha){
            $ultima_fecha = $anuncios_n5[$i]['fecha_anuncio']*1;
            #var_dump($ultima_fecha);
        }
    }
    return $ultima_fecha;
}
/**
 * asigna fechas consecutivas con diferencia de un día a los anuncios con fecha
 * anterior a la de hoy
 * @param  array  $anuncios_n5        el conjunto de anuncios de nivel 5
 * @param  array  $ultima_fecha       la fecha a partir de la que asignar nuevas fechas
 * @return array  $anuncios_n5        el conjunto de anuncios con las nuevas fechas
 */
function asigna_nuevas_fechas(&$anuncios_n5, $ultima_fecha){
    $hoy = getdate()[0];
    $dia = 24*3600;
    #var_dump($hoy, $ultima_fecha);
    $fecha_nueva = $ultima_fecha + $dia;
    for ($i=0; $i < count($anuncios_n5); $i++) {
        if($anuncios_n5[$i]['fecha_anuncio'] < $hoy){
            $anuncios_n5[$i]['fecha_anuncio'] = getdate($fecha_nueva)[0];
            #var_dump(getdate($fecha_nueva));
        }
        $fecha_nueva += $dia;
    }
    #var_dump($anuncios_n5);
    //actualizamos los anuncios de la base de datos con las nuevas fechas
    for ($i=0; $i < count($anuncios_n5); $i++) {
        $id_anuncio = $anuncios_n5[$i]['id_anuncio'];
        $fecha_anuncio = date('Y-m-d H:i:s', $anuncios_n5[$i]['fecha_anuncio']*1);
    #var_dump($fecha_anuncio);
        Anuncio::actualiza_fecha_anuncio($id_anuncio, $fecha_anuncio);
    }
    #var_dump($anuncios_n5);
    return $anuncios_n5;
}
    //anuncios actuales con nivel 5
    $anuncios_n5 = Anuncio::obtenNivel5_portada();
    #var_dump($anuncios_n5);
    $ultima_fecha = obtener_fecha_mas_lejana($anuncios_n5);
    //asignamos nuevas fechas a los anuncios nuevos y a los ya visualizados
    $anuncios_n5 = asigna_nuevas_fechas($anuncios_n5, $ultima_fecha);
    #var_dump($anuncios_n5);
    anuncio_a_colocar_en_portada($anuncios_n5);
