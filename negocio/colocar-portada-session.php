<?php
require '../datos/Anuncio.php';
session_start();
#var_dump($_SESSION['nivel5']);
/**
 * Devuelve el id y la url de la foto principal del anuncio a colocar en portada
 * @param  array $anuncios_n5   el conjunto de anuncios de nivel 5 ('id', 'url', 'fecha_n5')
 * @return array $anuncio  el anuncio cuya fecha coincide con la de hoy ('id', 'url')
 */
function anuncio_a_colocar_en_portada($anuncios_n5){
    //obtenemos el id y la url de la foto principal del anuncio con fecha de hoy
    //inincializamos las variables
    $id_anuncio = 0;
    $url_foto_anuncio = '';
    $localidad = '';
    $precio = 0;
    //la fecha de hoy
    $fecha_hoy = getdate();
    $hoy = $fecha_hoy['mday'];
    $hoy .= '/' .$fecha_hoy['mon'];
    $hoy .= '/' .$fecha_hoy['year'];
    //comprobamos qué anuncio tiene la fecha de hoy, que será el buscado para
    //colocar en portda
    foreach ($anuncios_n5 as $key => $value) {
        //obtenemos la fecha del anuncio
        $fecha = $value['fecha_n5'];
        $fecha_prevista = $fecha['mday'];
        $fecha_prevista .= '/' .$fecha['mon'];
        $fecha_prevista .= '/' .$fecha['year'];
        //comparamos si la fecha del anuncio coincide con la de hoy
        if($fecha_prevista === $hoy){
            $id_anuncio = $value['id_anuncio'];
            $url_foto_anuncio = $value['url_foto_anuncio'];
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
    #var_dump($anuncio);
    #die();
    echo json_encode($anuncio);
    $dbh = null;
}
/**
 * elimina anuncios con servicio caducado (5 portadas) y asigna fechas consecutivas
 * con diferencia de un día a los anuncios que no tienen fecha o la fecha es anterior
 * sin que haya caducado el servicio (apariciones > 0 y apariciones < 5)
 * @param  array  $anuncios_n5        el conjunto de anuncios de nivel 5 ('id', 'url', 'fecha_n5', 'apariciones')
 * @param  array  $ultima_fecha  la fecha a partir de la que asignar nuevas fechas
 * @return array  $anuncios_n5        el conjunto de anuncios con las nuevas fechas
 */
function asigna_nuevas_fechas(&$anuncios_n5, $ultima_fecha){
    #var_dump($ultima_fecha);
    //eliminamos anuncios con 5 apariciones
    $cont = 0;
    foreach ($anuncios_n5 as $key => $value) {
        if($value['apariciones'] == 5){
            unset($anuncios_n5[$cont]);
            $anuncios_n5 = array_values($anuncios_n5);
            continue;
        }
        $cont ++;
    }
    //asignamos a los nuevos anuncios fechas consecutivas a la última con 1 día
    //de diferencia
    $hoy = time();//segundos
    #var_dump($hoy);
    $dia = 3600*24;
    #var_dump($anuncios_n5);
    foreach ($anuncios_n5 as $key => $value) {
        if($value['fecha_n5'][0] < $hoy[0]) {
            #var_dump($ultima_fecha);
            $anuncios_n5[$key]['fecha_n5'] = getdate($ultima_fecha);
            #var_dump($anuncios_n5[$key]['fecha_n5']);
        }
        $ultima_fecha += $dia;
        #var_dump($ultima_fecha);
    }
    //devolvemos el conjunto de anuncios con fechas actualizadas y sin anuncios caducados
    #var_dump($anuncios_n5);
    return $anuncios_n5;
}
/**
 *actualizamos el nuevo array con los datos del array anterior y
 *obtenemos la fecha más lejana para colocar los nuevos anuncios en la cola
 * @param  array   $anuncios_n5_ant el conjunto de anuncios de nivel 5 en vigor
 * @param  array   $anuncios_n5     el nuevo conjunto de anuncios de nivel 5
 * @return integer $ultima_fecha             [description]
 */
function obtener_fecha_mas_lejana($anuncios_n5_ant, &$anuncios_n5){
    //adaptamos el array $anuncios_n5 añadiéndole los campos que le faltan
    $fecha_n5 = 0;//segundos
    $keys = array('id_anuncio',
            'url_foto_anuncio',
                   'localidad',
                      'precio',
                    'fecha_n5',
                'apariciones');
    for ($i=0; $i < count($anuncios_n5); $i++) {
        //asociamos a los anuncios una fecha (array asociativo de claves:
        //'seconds', 'minutes', 'hours', 'mday', 'wday', 'mon', 'year', 'yday',
        //'weekday', 'month', 0)
        $values = array($anuncios_n5[$i]['id_anuncio'],
             $anuncios_n5[$i]['url_foto_anuncio'],
                    $anuncios_n5[$i]['localidad'],
                       $anuncios_n5[$i]['precio'],
                               getdate($fecha_n5),
                                               0);
        $anuncios_n5[$i] = array_combine($keys, $values);
    }
    //vemos cual es la fecha más lejana o última fecha
    $ultima_fecha = 0;
    foreach ($anuncios_n5_ant as $key_ant => $value_ant) {
        foreach ($anuncios_n5 as $key => $value) {
            //a los anuncios que ya estaban en la ista les pasamos sus valores anteriores
            if($value_ant['id_anuncio'] == $value['id_anuncio']){
                $value['fecha_n5'] = $value_ant['fecha_n5'];
                $value['apariciones'] = $value_ant['apariciones'];
            }
            //se obtiene la última fecha asignada
            if($value['fecha_n5'][0] > $ultima_fecha) {
                $ultima_fecha = $value['fecha_n5'][0];
                #var_dump($ultima_fecha);
            }
        }
    }
    return $ultima_fecha;
}
//la primera publicación de la portada
if (!isset($_SESSION['nivel5'])) {
    //creamos un array global con la foto principal de los anuncios de nivel 5
    //ordenados por id
    #var_dump('aqui si');
    $_SESSION['nivel5'] = Anuncio::obtenNivel5_portada();
    $anuncios_n5 =& $_SESSION['nivel5'];
    #var_dump($anuncios_n5);
    $fecha_n5 = time();//segundos
    $keys = array('id_anuncio',
            'url_foto_anuncio',
                   'localidad',
                      'precio',
                    'fecha_n5',
                'apariciones');
    for ($i=0; $i < count($anuncios_n5); $i++) {
        //asociamos a los anuncios una fecha (array asociativo de claves:
        //'seconds', 'minutes', 'hours', 'mday', 'wday', 'mon', 'year', 'yday',
        //'weekday', 'month', 0)
        $values = array($anuncios_n5[$i]['id_anuncio'],
             $anuncios_n5[$i]['url_foto_anuncio'],
                    $anuncios_n5[$i]['localidad'],
                       $anuncios_n5[$i]['precio'],
                               getdate($fecha_n5),
                                               0);
        $anuncios_n5[$i] = array_combine($keys, $values);
        //a cada anuncio damos fechas con días consecutivos
        $fecha_n5 += (3600*24);
    }

    var_dump($_SESSION['nivel5']);
    anuncio_a_colocar_en_portada($anuncios_n5);
}else{
    //sucesivas publicaciones
    //actualizamos el array con los anuncios de nivel 5 existente añadiendo los
    //nuevos anuncios de nivel 5
    //anuncios anteriores con nivel 5
    $anuncios_n5_ant = $_SESSION['nivel5'];
    //anuncios actuales con nivel 5
    $anuncios_n5 = Anuncio::obtenNivel5_portada();
    #var_dump($anuncios_n5);
    //actualizamos el nuevo array con los datos del array anterior y
    //comprobamos la fecha más lejana para colocar los nuevos anuncios en la cola
    $ultima_fecha = obtener_fecha_mas_lejana($anuncios_n5_ant, $anuncios_n5);
    #var_dump($anuncios_n5);
    //eliminamos los anuncios que han sido visualizados durente 5 días y asignamos
    //nuevas fechas
    $anuncios_n5 = asigna_nuevas_fechas($anuncios_n5, $ultima_fecha);
    var_dump($anuncios_n5);
    anuncio_a_colocar_en_portada($anuncios_n5);
    session_destroy();
}
