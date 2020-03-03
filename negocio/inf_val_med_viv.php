<?php

//requerimos el autocargador de clases de composer

require_once '../vendor/autoload.php';
#require_once 'dompdf/autoload.inc.php';

//accedemos al uso de la calse Dompdf

use Dompdf\{Dompdf, Options};

//habilitamos HTML5
$options = new Options();
$options->setIsHtml5ParserEnabled(true);

//instanciamos un objeto dela clase Dompdf

$dompdf = new Dompdf($options);

//obtenemos el html fuente del informe
//--------------------------------------------------
//realizamos una petición al servidor para que nos devuelva el
//valor_medio_vivienda.php procesado por el interprete php del servidor

$html = '<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1>Informe sobre el valor medio de las viviendas anunciadas.</h1>';

        //fecha del informe
        $fecha = date('d/m/Y h:i:s');
        //precios de venta anuncios seleccionados
        $precios_venta = [1255.25, 1300, 1524, 1125];
        //precios de alquiler de anuncios seleccionados
        $precios_alquiler = [620.5, 535, 585];
        //media de ventas
        $i = 0; $suma = 0;
        foreach ($precios_venta as $value) {
            $i +=1;
            $suma +=$value;
        }
        $med_venta = round($suma/$i, 2);
        //media de alquileres
        $i = 0; $suma = 0;
        foreach ($precios_alquiler as $value) {
            $i +=1;
            $suma +=$value;
        }
        $med_alquiler =round($suma/$i, 2);

$html.= '<p>'. $fecha .'</p>
        <p>Precio de venta por m2: '. $med_venta .' €</p>
        <p>Precio de alquiler por mes: ' . $med_alquiler .' €</p>
    </body>
</html>';
var_dump($html);
#died();
//--------------------------------------------------

#$filename = '../negocio/valor_medio_vivienda.php';
#$html = file_get_contents($filename);


//cargamos el contenido html a renderizar

$dompdf->loadHtml($html);

//cargamos el archivo html a renderizar

#$dompdf->loadHtmlFile($filename); da problemas de Options::chroot

//formato del papel de salida

$dompdf->setPaper('A4', 'portrait');

//renderizado del HTML a PDF

$dompdf->render();

//enviamos el PDF al explorador

$options = ["Attachment" => 0];
$dompdf->stream('', $options);

?>
