<?php

//requerimos el autocargador de clases de composer

require_once '../vendor/autoload.php';
#require_once 'dompdf/autoload.inc.php';

//accedemos al uso de la calse Dompdf

use Dompdf\{Dompdf, Options};

//instanciamos un objeto dela clase Dompdf

$dompdf = new Dompdf();

//obtenemos el html fuente del informe

$filename = 'informe.php';
$html = file_get_contents($filename);


//cargamos el contenido html a renderizar

$dompdf->loadHtml(utf8_decode($html));

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
