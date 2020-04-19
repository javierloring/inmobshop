<?php
$concepto = 'Precio';
$informe = 'Viviendas';
require "..\..\..\datos\db.php";
	$mihtml = '
	<!doctype html>
	<html lang="en">
	  <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="favicon.ico">
	    <title>Generar Archivo PDF con PHP - BaulPHP.com</title>
	    <!-- Custom styles for this template -->
	    <link rel="stylesheet" href="index.css">
	  </head>
	  <body>
		<h1>InmobShop - '.$concepto.' de '.$informe.'</h1>
	';
	$mihtml .= '
		<table>
			<thead>
				<tr>
					<th>Código</th>
					<th>Nombre</th>
					<th style="text-align: right;">PVP</th>
					<th>Familia</th>
					<th>Stock</th>
				</tr>
			</thead>
			<tbody>
	';

	$productos = "SELECT cod, nombre, descripcion, PVP, familia, stock FROM producto";
	$productos = mysqli_query($conectar, $productos);
	while(isset($productos) &&
			$producto = mysqli_fetch_assoc($productos)){
		$mihtml .= '<tr><td>'.$producto['cod'] . '</td>';
		$mihtml .= '<td>'.$producto['nombre'] . '</td>';
		$mihtml .= '<td style="text-align: right;">'.$producto['PVP'] . ' €</td>';
		$mihtml .= '<td style="text-align: center;">'.$producto['familia'] . '</td>';
		$mihtml .= '<td style="text-align: center;">'.$producto['stock'] . '</td></tr>';
	}
	$mihtml .= '
			</tbody>
		</table>
	  </body>
	</html>
	';

#var_dump(mb_detect_encoding($mihtml));
#die(json_encode(array('compilado hasta' => 'AQUI')));
	//referencia
	use Dompdf\{Dompdf, Options};

	// incluye autoloader
	require_once "..\..\..\\vendor\dompdf\dompdf\autoload.inc.php";

	//activar parseador HTML5
	$options = new Options();
	$options->setIsHtml5ParserEnabled(true);

	//Creando instancia para generar PDF
	$dompdf = new Dompdf($options);
	$dompdf->set_paper('A4', 'landscape');
#die(json_encode(array('compilado hasta' => 'AQUI')));
	// Cargar el HTML
	$dompdf->load_html($mihtml);
#die(json_encode(array('compilado hasta' => '+AQUI')));
	//Renderizar o html
	$dompdf->render();
#die(json_encode(array('error' => 'AQUI')));
	//Exibibir nombre de archivo
	$dompdf->stream("Lista_Productos", array("Attachment" => false));//poder guardar archivo
	//$dompdf->stream("Lista_Productos");
#die(json_encode(array('error' => '+AQUI')));
?>
