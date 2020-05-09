<?php
include ('./Anuncio.php');
use datos\Anuncio;
var_dump('entrar entra');
/**
 * Devuelve el id y la url de la foto principal del anuncio a colocar en portada
 * @param  array $nivel5   el conjunto de anuncios de nivel 5 ('id', 'url', 'fecha_n5')
 * @return array $anuncio  el anuncio cuya fecha coincide con la de hoy ('id', 'url')
 */
function anuncio_a_colocar_en_portada($nivel5){
    //obtenemos el id y la url de la foto principal del anuncio con fecha de hoy
    //inincializamos las variables
    $id_anuncio = 0;
    $url_foto_principal = '';
    //la fecha de hoy
    $fecha_hoy = getdate();
    $hoy = $fecha_hoy['mday'];
    $hoy .= '/' .$fecha_hoy['mon'];
    $hoy .= '/' .$fecha_hoy['year'];
    //comprobamos qué anuncio tiene la fecha de hoy, que será el buscado para
    //colocar en portda
    foreach ($nivel5 as $key => $value) {
        //obtenemos la fecha del anuncio
        $fecha = $value['fecha_n5'];
        $fecha_prevista = $fecha['mday'];
        $fecha_prevista .= '/' .$fecha['mon'];
        $fecha_prevista .= '/' .$fecha['year'];
        //comparamos si la fecha del anuncio coincide con la de hoy
        if($fecha_prevista === $hoy){
            $id_anuncio = $value['id'];
            $url_foto_anuncio = $value['url_foto_principal'];
            $localidad = $value['localidad'];
            $precio = $value['precio'];
        }
    }
    //pasamos al anuncio los datos id y url
    $anuncio[] = $id_anuncio;
    $anuncio[] = $url_foto_anuncio;
    $anuncio[] = $localidad;
    $anuncio[] = $precio;
    //devolvemos el anuncio que se debe colocar en la portada y su foto
    var_dump($anuncio);
    die();
    echo json_encode($anuncio);
    $dbh = null;
}
/**
 * elimina anuncios con servicio caducado (5 portadas) y asigna fechas consecutivas
 * con diferencia de un día a los anuncios que no tienen fecha o la fecha es anterior
 * sin que haya caducado el servicio (apariciones > 0 y apariciones < 5)
 * @param  array  $nivel5        el conjunto de anuncios de nivel 5 ('id', 'url', 'fecha_n5', 'apariciones')
 * @param  array  $ultima_fecha  la fecha a partir de la que asignar nuevas fechas
 * @return array  $nivel5        el conjunto de anuncios con las nuevas fechas
 */
function asigna_nuevas_fechas(&$nivel5, $ultima_fecha){
    //eliminamos anuncios con 5 apariciones
    $cont = 0;
    foreach ($nivel5 as $key => $value) {
        if($value['apariciones'] == 5){
            unset($nivel5[$cont]);
            $nivel5 = array_values($nivel5);
            continue;
        }
        $cont ++;
    }
    //asignamos a los nuevos anuncios fechas consecutivas a la última con 1 día
    //de diferencia
    $hoy = time();//segundos
    $dia = 3600*24;
    foreach ($nivel5 as $key => $value) {
        if(!isset($value['fecha_n5']) || $value['fecha_n5'][0] < $hoy) {
            $value['fecha_n5'] = getdate($ultima_fecha + $dia);
            $value['apariciones'] = 0;
            $ultima_fecha += $dia;
        }
    }
    //devolvemos el conjunto de anuncios con fechas actualizadas y sin anuncios caducados
    return $nivel5;
}
/**
 *actualizamos el nuevo array con los datos del array anterior y
 *obtenemos la fecha más lejana para colocar los nuevos anuncios en la cola
 * @param  array   $nivel5_ant el conjunto de anuncios de nivel 5 en vigor
 * @param  array   $nivel5     el nuevo conjunto de anuncios de nivel 5
 * @return integer $ultima_fecha             [description]
 */
function obtener_fecha_mas_lejana($nivel5_ant, &$nivel5){
    //la fecha más lejana o última fecha
    $ultima_fecha = 0;

    foreach ($nivel5_ant as $key_ant => $value_ant) {
        foreach ($nivel5 as $key => $value) {
            if($value_ant['id'] == $value['id']){
                $value['fecha_n5'] = $value_ant['fecha_n5'];
                $value['apariciones'] = $value_ant['apariciones'];
            }
            //se obtiene la última fecha asignada
            if($value['fecha_n5'][0] > $ultima_fecha) {
                $ultima_fecha = $value['fecha_n5'][0];
            }
        }
    }
    return $ultima_fecha;
}
//la primera publicación de la portada
if (!isset($GLOBALS['nivel5'])) {
    //creamos un array global con la foto principal de los anuncios de nivel 5
    //ordenados por id
    $GLOBALS['nivel5'] = Anuncio::obtenNivel5_portada();
    $nivel5 =& $GLOBALS['nivel5'];
    $fecha_n5 = time();//segundos
    foreach($nivel5 as $key => $value){
        //asociamos a los anuncios una fecha (array asociativo de claves:
        //'seconds', 'minutes', 'hours', 'mday', 'wday', 'mon', 'year', 'yday',
        //'weekday', 'month', 0)
        //a cada anuncio damos fechas con días consecutivos
        $value['fecha_n5'] = getdate($fecha_n5);
        //añadimos el número de apariciones en portada
        $value['apariciones'] = 0;
        $fecha_n5 += (3600*24);
    }
    anuncio_a_colocar_en_portada($nivel5);
}else{
    //sucesivas publicaciones
    //actualizamos el array con los anuncios de nivel 5 existente añadiendo los
    //nuevos anuncios de nivel 5
    //anuncios anteriores con nivel 5
    $nivel5_ant = $GLOBALS['nivel5'];
    //anuncios actuales con nivel 5
    $niveln5 = Anuncio::obtenNivel5_portada();
    //actualizamos el nuevo array con los datos del array anterior y
    //comprobamos la fecha más lejana para colocar los nuevos anuncios en la cola
    $ultima_fecha = obtener_fecha_mas_lejana($nivel5_ant, $nivel5);
    //eliminamos los anuncios que han sido visualizados durente 5 días y asignamos
    //nuevas fechas
    $nivel5 = asigna_nuevas_fechas($nivel5, $ultima_fecha);
    anuncio_a_colocar_en_portada($nivel5);
}
