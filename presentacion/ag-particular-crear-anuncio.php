<?php
//iniciamos sesión
session_start();
//utilizamos recursos de la aplicación
require_once '../vendor/autoload.php';
//la configuración general
require_once '../config.php';
//la capa de datos
require_once '../datos/Usuario.php';
require_once '../datos/Particular.php';
require_once '../datos/Profesional.php';
require_once '../datos/Operacion.php';
require_once '../datos/Coordenada.php';
require_once '../datos/Inmueble.php';
require_once '../datos/Anuncio.php';
require_once '../datos/Piso.php';
//la capa de negocio
require '../negocio/funciones-inmobshop.php';

//inicializamos variables
$id_usuario = '';
$tipo_usuario = '';
$nombre = '';
//para el anuncio
$tipo_operacion = '';
$precio = '';
$tiempo = '';
//-----
$via = '';
$num_via = '';
$cod_postal = '';
$provincia = '';
$localidad = '';
//-----
$longitud = '';
$latitud = '';
//-----
$descripcion = '';
//-----
$id_fotos = '';
//-----
#var_dump($_SESSION);
//si no existe sesión el formulario se está rellenando por un visitante
if(!isset($_SESSION)){
	$tipo_usuario = 'visitante';
}else if(isset($_SESSION['id']) && isset($_SESSION['tipo_usuario'])){
	$id_usuario = $_SESSION['id'];
	$tipo_usuario = $_SESSION['tipo_usuario'];
	if($tipo_usuario == 'demandante'){
		$tipo_usuario = 'visitante';
        $id_usuario = '';
	}else {
		$usuario_row = Usuario::obtenUsuarioId($id_usuario);
		$nombre = $usuario_row['usuario'];
		#var_dump($nombre);
	}
}
//nuestra posición--------------------------------------------------------------
#echo $_SERVER['PHP_SELF'];
$url = '';
//nuestro nombre y ubicación
$nombre_pag = 'anuncios';
#var_dump($url, $nombre);
//declaramos la variable errors para almacenar los errores
$errors = array();
//---------------------------------------------------------------------AUTO POST
//------------------------------------------------------------CREAMOS EL ANUNCIO
//Esta página dispone de dos formularios: formulario_1 con las fotos subida por
//el usuario y que se envía a la base de datos por medio de una petición asíncrona
//utilizando la interfaz FormData que captura los datos del formulario
//recuperamos los datos del formulario
if(isset($_POST)){
	$fecha_anuncio = date('Y-m-d H:i:s');
	$estado = 'pendiente';
	//campos de la operación
	if(isset($_POST['tipo_operacion'])){
		$tipo_operacion = $_POST['tipo_operacion'];
	}
	if(isset($_POST['precio'])){
		$precio = $_POST['precio'];
	}
	if(isset($_POST['tiempo'])){
		$tiempo = $_POST['tiempo'];
	}
	//hacemos el registro y recuperamos el id
	$id_operacion = Operacion::registraOperacion($tipo_operacion, $precio, $tiempo);
	//-----------------------------------------------------------campos del inmueble
	if(isset($_POST['via'])){
		$via = $_POST['via'];
	}
	if(isset($_POST['num_via'])){
		$num_via = $_POST['num_via'];
	}
	if(isset($_POST['cod_postal'])){
		$cod_postal = $_POST['cod_postal'];
	}
	if(isset($_POST['provincia'])){
		$provincia = $_POST['provincia'];
	}
	if(isset($_POST['localidad'])){
		$localidad = $_POST['localidad'];
	}
	//campos del terreno, si hay terreno
	if(isset($_POST['tipo_inmueble']) && ($_POST['tipo_inmueble'] == 'terreno' || $_POST['tipo_inmueble'] == 'terreno_cons')){
		$tipo_suelo = $_POST['tipo_terreno'];
		$superficie = $_POST['superficie'];
		$unidad = $_POST['unidad_superficie'];
		$agua = $_POST['agua'];
		$luz = $_POST['luz'];
	//hacemos el registro y recuperamos el id
		$id_terreno = Terreno::registraTerreno($tipo_suelo, $superficie, $unidad, $agua, $luz);
	}else {
		$id_terreno = null;
	}
	//campos si hay construccion, vivienda, piso
	if(isset($_POST['tipo_inmueble']) && ($_POST['tipo_inmueble'] == 'vivienda' || $_POST['tipo_inmueble'] == 'local'
		|| $_POST['tipo_inmueble'] == 'oficina' || $_POST['tipo_inmueble'] == 'garaje'
		|| $_POST['tipo_inmueble'] == 'trastero' || $_POST['tipo_inmueble'] == 'nave')){
		if($_POST['tipo_inmueble'] == 'vivienda'){
			if(isset($_POST['tipo_vivienda']) && $_POST['tipo_vivienda'] == 'piso'){
				//campos de piso si hay piso
				$tipo_piso = $_POST['tipo_piso'];
				$planta = $_POST['num_planta'];
				$fachada = $_POST['fachada'];
				//hacemos el registro y recuperamos el id
				$id_piso = Piso::registraPiso($tipo_piso, $planta, $fachada);
			}else {
				$id_piso = null;
			}
			//campos de vivienda si hay vivienda
			$tipo_vivienda = $_POST['tipo_vivienda'];
			$num_habitaciones = $_POST['num_habitaciones'];
			$num_banyos = $_POST['num_banyos'];
			$estado_vivienda = $_POST['estado_viv'];
			$equipamiento = $_POST['equipamiento'];
			$orientacion = $POST['orientacion'];
			$ascensor = $_POST['ascensor'];
			$arm_empotrados = $_POST['arm_empotrados'];
			$calefaccion = $_POST['calefaccion'];
			$aire_acond = $_POST['aire_acond'];
			$terraza = $_POST['terraza'];
			$balcon = $_POST['balcon'];
			$trastero = $_POST['trastero'];
			$plaza_garaje = $_POST['plaza_garaje'];
			$piscina_propia = $_POST['piscina_propia'];
			$urbanizacion = $_POST['urbanizacion'];
			$piscina_comun = $_POST['piscina_comun'];
			$zonas_verdes = $_POST['zonas_verdes'];
			//hacemos el registro y recuperamos el id
			$id_vivienda = Vivienda::registraVivienda(
				$tipo_vivienda, $num_habitaciones, $num_banyos, $estado_vivienda,
				$equipamiento, $orientacion, $ascensor, $arm_empotrados, $calefaccion,
				$aire_acond, $terraza, $balcon, $trastero, $plaza_garaje, $piscina_propia,
				$urbanizacion, $piscina_comun, $zonas_verdes, $id_piso);
		}else {
			$id_vivienda = null;
		}
		//campos de construccion si hay construccion
		if(isset($_POST['tipo_inmueble'])){
			$tipo_construccion = $_POST['tipo_inmueble'];
		}
		if(isset($_POST['superficie'])){
			$sup_util = $_POST['superficie'];
			$sup_construida = $_POST['superficie'];
		}
		if(isset($_POST['unidad_superficie'])){
			$unidad = $_POST['unidad_superficie'];
		}
		//hacemos el registro y recuperamos el id
		$id_construccion = Construccion::registraConstruccion($tipo_construccion,
		$sup_util, $sup_construida, $unidad, $id_vivienda);
	}else {
		$id_construccion = null;
	}
	//coordenadas
	if(isset($_POST['longitud'])){
		$longitud = $_POST['longitud'];
	}
	if(isset($_POST['latitud'])){
		$latitud = $_POST['latitud'];
	}
	//hacemos el registro y recuperamos el id
	$id_coordenadas = Coordenada::registraCoordenadas($longitud, $latitud);
	//hacemos el registro y recuperamos el id
	$id_inmueble = Inmueble::registraInmueble($via, $num_via, $cod_postal, $provincia,
		$localidad, $id_terreno, $id_construccion, $id_coordenadas);
	if(isset($_POST['descripcion'])){
		$descripcion = $_POST['descripcion'];
	}
	if($tipo_usuario == 'demandante'){
		$errors[] = 'No pueden crearse anuncios si no se está registrado.';
	}elseif ($tipo_usuario == 'profesional'){
		$id_profesional = Profesional::obtenIdProfesionalIdUsuario($id_usuario);
		$id_particular = null;
	}else {
		$id_particular = Particular::obtenIdParticularIdUsuario($id_usuario);
		$id_profesional = null;
	}
	if(isset($_POST['id_fotos'])){
		$id_fotos = $_POST['id_fotos'];
		//creamos el anuncio
		//AQUÍ PUEDE HABER UN PROBLEMA DE INTEGRIDAD SI SACO EL ANUNCIO DEL IF
		Anuncio::registraAnuncio($fecha_anuncio, $estado, $id_operacion, $id_inmueble,
			$descripcion, $id_profesional, $id_particular, $id_fotos);
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Crear-Anuncio-inmobshop</title>
        <link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
        <link rel="stylesheet" href="..\css\miniaturas.css">
		<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
		<link href='https://fonts.googleapis.com/css?family=Poller One' rel='stylesheet'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
		<script src="..\js\jquery-3.4.0.js" charset="utf-8"></script>
		<script src="..\js\w3.js"></script>
        <script src="..\js\inmobshop.js" charset="utf-8"></script>
    </head>
    <body>
		<header class="w3-bar w3-inmobshop "	style="top: 0;z-index: 1;">
			<a  class="w3-bar-item w3-mobile w3-text-amber w3-myfont w3-center "
				href="/inmobshop/index.php"
				style = "text-decoration: none; width:14%; padding: 0px;">
				<span style="font-size:50px;">IS </span><span style="font-size:22px;">inmobshop</span>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center "
			   style = "text-decoration: none; width:13.80%; margin-top: 15px;"
				href = "<?= CONTRATOS_PARTICULARES ?>">
				<p class="<?php if($nombre_pag == 'contratos'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white "
				style="margin-bottom:0px;font-weight: bold;">
					Contratos
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center "
			   style = "text-decoration: none; width:13.80%; margin-top: 15px;"
				href = "<?= ANUNCIOS_PARTICULARES ?>">
				<p class="<?php if($nombre_pag == 'anuncios'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white "
				style="margin-bottom:0px;font-weight: bold;">
					Anuncios
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center "
			  style = "text-decoration: none; width:13.80%; margin-top: 15px;"
				href = "<?= CONTACTOS_PARTICULARES ?>">
				<p class="<?php if($nombre_pag == 'contactos'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white "
				style="margin-bottom:0px;font-weight: bold;">
					Contactos
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center "
			 style = "text-decoration: none; width:13.80%; margin-top: 15px;"
				href = "<?= BUSQUEDAS_Y_FAVORITOS_PARTICULARES ?>">
				<p class="<?php if($nombre_pag == 'busqueda & favoritos'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white "
				style="margin-bottom:0px;font-weight: bold;">
					Búsquedas & Favoritos
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center "
			 style = "text-decoration: none; width:13.80%; margin-top: 15px;"
				href = "<?= PERFIL_PARTICULARES ?>">
				<p class="<?php if($nombre_pag == 'perfil'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white "
				style="margin-bottom:0px;font-weight: bold;">
					Perfíl
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center "
			 style = "text-decoration: none; width:13.80%; margin-top: 15px;"
				href = "<?= CIERRA_SESION ?>">
				<p class="<?php if($nombre_pag == 'cierra sesión'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white "
				style="margin-bottom:0px;font-weight: bold;">
					Cierra sesión
				</p>
			</a>
		</header>
        <main class="w3-container">
            <div id="breadcrumbs" class="w3-row w3-container w3-padding">
                <div class="w3-col l2 m12 s12">
                    <p id="" class="oculto"></p>
					<P></P>
                </div>
                <div class="w3-col l8 m12 s12">
                    <ul class="breadcrumb w3-ul">
                      	<?php
					  	$html = '';
						$html .= '<li><a class="w3-hover-text-blue" href="/inmobshop/index.php">Home</a></li>';
							#var_dump($html);
					  	echo $html;
					  	?>
                  		<li><?= $nombre_pag ?></li>
                    </ul>
                </div>
				<div class="w3-col w3-text-inmobshop" style="width:16%;">
					<?php
					if($nombre != ''){
						echo '<span>Sesión iniciada por: <b>' . $nombre . '</b></span>';
					}
					?>
                </div>
            </div>
			<div class="w3-row w3-panel" style="margin-top:1%">
                <div class="w3-col" style="width: 16.66%">
                    <p></p>
                </div>
				<div id="central" class="w3-col" style="width: 66.66%">
					<form id="fotos" class="" action="" method="post" enctype="">
						<div id="dropzone" title="Arrastre fotos y ordénelas como quiera que aparezcan en el anuncio. Puede incluir, si lo desea, un breve comentario en cada foto.">
							<h5 class="reclamo">
								<b>Seleccione imagenes de su explorador y arrastrelas a esta zona.</b>
							</h5>
							<div class="w3-col w3-center reclamo">
								<span><i class="material-icons inmobshop"
									style = "font-size: 80px;padding-top:20px;">
									camera_alt</i>
								</span>
							</div>
						</div>
                        <input id="id_us_fotos" type="hidden" name="id_us_fotos" value="<?= $id_usuario ?>">
                        <input id="tipo_usuario" type="hidden" name="tipo_usuario" value="<?= $tipo_usuario ?>">
						<div class="w3-col w3-center w3-border" style="margin-top:5px;">
							<input id="subir_fotos" class="w3-input w3-padding w3-large w3-inmobshop"
							type="submit"
							onclick="enviar_fotos(this);"
							name="subir_fotos"
							title="Cuando hayas arrastrado todas las fotos, pulsa subir fotos para que se guarden en tu anuncio."
							value="Guardar las fotos de tu anuncio">
						</div>
					</form>
					<form id="anuncio" class = "w3-center"
						action = "crear-anuncio.php"
						onsubmit = "return validaFormulario();"
						method="post" style="margin-top: 40px;">
                        <input id="id_us_fotos2" type="hidden" name="id_us_fotos2" value="<?= $id_usuario ?>">
                        <input id="id_fotos" type="hidden" name="id_fotos" value="">
						<div id="buscador" class="w3-row">
							<div class="w3-col" style="width: 25%;">
								<table id="anuncio01" class="w3-table">
									<tr><th>Tipo de inmueble</th></tr>
									<tr><td><select id="tipo_inmueble"
	                                        class="w3-select w3-inmobshop w3-border w3-border-inmobshop"
	                                        name="tipo_inmueble"
											title="Seleccione el tipo de inmueble deseado"
	                                        required
	                                        style="">
			   							    <option value="" disabled selected>Tipo de inmueble</option>
			   							    <option value="terreno">Terreno</option>
			   							    <option value="terreno_cons">Terreno&vivienda</option>
			   							    <option value="vivienda">Vivienda</option>
			   							    <option value="local">Local</option>
			   							    <option value="oficina">Oficina</option>
			   							    <option value="garaje">Garaje</option>
			   							    <option value="trastero">Trastero</option>
			   							    <option value="nave">Nave</option>
			   						  	</select></td></tr>
								</table>
							</div>
							<div id="locationField" class="w3-col w3-text-inmobshop w3-border-2 w3-border-inmobshop" style="width: 50%;border: dashed; margin-top: 40px;"
                                title="Introduce la dirección del inmueble y selecciónala cuando aparezca completa en el desplegable; mueve el mapa hasta que el marcador rojo esté sobre tu inmueble, pulsa OK para confirmarla.">
								<table id="anuncio02" class="w3-table">
									<tr>
										<td><label for="local" class="">
                                            <b>Localización</b>
										</label></td>
										<td><input id="autocomplete"
											type="text"
											name="localizacion"
											placeholder="Introduce la dirección del inmueble..."
											size="40"
											value=""></td>
                                        <td><button id="ok" type="button"
                                            name="confirmar"
                                            class="">
                                            <b>Ok</b>
                                        </button></td>
                                    </tr>
									<tr>
										<td>
											<input id="longitud" type="hidden" name="longitud" value="">
										</td>
										<td>
											<input id="latitud" type="hidden" name="latitud" value="">
										</td>
										<td></td>
									</tr>
								</table>
							</div>
							<div class="w3-col w3-border-inmobshop" style="width: 25%;">
								<table id="anuncio03" class="w3-table">
									<tr><th>Tipo de operación</th></tr>
									<tr>
										<td><select id="tipo_operacion"
	                                        class="w3-select w3-inmobshop w3-border-inmobshop"
	                                        name="tipo_operacion"
	                                        required
											title="Seleccione el tipo de operación deseado."
	                                        style="">
			   							    <option value="" disabled selected>Tipo de operación</option>
			   							    <option value="venta">Venta</option>
			   							    <option value="alquiler">Alquiler</option>
			   							    <option value="vacacional">Vacacional</option>
			   							    <option value="compartir">Compartir</option>
			   						  	</select></td>
									</tr>
								</table>
                            </div>
						</div>
						<div id="mapa_env" class="w3-panel w3-border-red" style="width: 100%;height:50%">
							<table class="w3-table w3-text-inmobshop">
								<tr><th>Mueve el mapa bajo el marcador rojo cuando este aparezca</th></tr>
								<tr>
									<td>
										<div id="mapa" class="w3-border w3-border-inmobshop" style="width: 100%; min-height: 300px;">

										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="descripcion" class="w3-row">
							<div class="w3-col w3-text-inmobshop" style="width: 66.66%;">
								<table id="anuncio1" class="w3-table">
									<tr><th>Descripción de inmueble</th></tr>
									<tr>
										<td><textarea name="descripcion"
												rows="8"
												cols=""
												style="width: 150%"
												maxlength="255"
												title="Realiza una descripción del inmueble todo lo detalladada que desees."
												></textarea></td>
									</tr>
								</table>
							</div>
						</div>
                        <div id="inputs" class="w3-row">
							<div id="anuncio1" class="w3-col w3-border-inmobshop w3-text-inmobshop" style="width: 25%;">
								<table class="w3-table">
									<tr><th>Localización</th></tr>
									<tr><td>Vía</td></tr>
									<tr><td><input id="via" class="direccion" type="text" name="via" value="" title="introduce el nombre de la calle." disabled required></td></tr>
									<tr><td>Núm. vía</td></tr>
									<tr><td><input id="num_via" class="direccion" type="text" name="num_via" value="" title="introduce el número de la finca." disabled required></td></tr>
									<tr><td>Código postal</td></tr>
									<tr><td><input id="cod_postal" class="direccion" type="text" name="cod_postal" value="" title="introduce el código postal del inmueble." disabled required></td></tr>
									<tr><td>Localidad</td></tr>
									<tr><td><input id="localidad" class="direccion" type="text" name="localidad" value="" title="introduce la localidad del inmueble." disabled required></td></tr>
									<tr><td>Provincia</td></tr>
									<tr><td><input id="provincia" class="direccion" type="text" name="provincia" value="" title="introduce la provincia del inmueble." disabled required></td></tr>
									<tr><th>Tipo de terreno</th></tr>
									<tr><td><select id="tipo_terreno"
	                                        class="w3-select w3-inmobshop"
	                                        name="tipo_terreno"
											disabled
											title="introduce el tipo de suelo al que pertenece el inmueble."
	                                        style="">
			   							    <option value="" disabled selected>Tipo de terreno</option>
			   							    <option value="s_urbano">Suelo urbano</option>
			   							    <option value="s_uebaniz">Suelo urbanizable</option>
			   							    <option value="s_rustico">Suelo Rústico</option>
			   						  		</select>
										</td></tr>
									<tr><td><input id="agua" class="w3-check"
                                            name="agua"
											title="Si el terreno dispone de agua en la actualidad."
											disabled
                                            type="checkbox">
											<label for="agua">Agua</label>
                                            <input id="luz" class="w3-check"
                                            name="luz"
											title="Si el terreno dispone de electricidad en la actualidad."
											disabled
											type="checkbox">
											<label for="luz">Luz</label>
										</td></tr>
									<tr><th>Tipo de vivienda</th></tr>
									<tr><td><select id="tipo_vivienda"
	                                        class="w3-select w3-inmobshop"
	                                        name="tipo_vivienda"
											disabled
											title="Seleccione el tipo de vivienda con el que corresponda el inmueble."
	                                        style="">
			   							    <option value="" selected>Tipo de vivienda</option>
			   							    <option value="piso" title="Toda vivienda situada en un bloque compartido.">Piso</option>
			   							    <option value="chalet" title="Cualquier vivienda independiente para una sóla familia: exento, pareado, en hilera.">Chalet unifamiliar</option>
			   							    <option value="casa_rustica" title="Casas situadas en el campo o en entornos tipicamente rurales.">Casa rústica</option>
			   							    <option value="casa_especial" title="Cuando se trate de un palacete, castillo, etc.">Casa especial</option>
		   						  			</select>
										</td></tr>
									<tr><th>Tipo de Piso</th></tr>
									<tr><td><select id="tipo_piso"
	                                        class="w3-select w3-inmobshop"
	                                        name="tipo_piso"
	                                        disabled
											title="Seleccione el tipo de piso con el que corresponda el inmueble."
	                                        style="">
			   							    <option value="" disabled selected>Tipo de piso</option>
			   							    <option value="piso">Piso</option>
			   							    <option value="duplex">Duplex</option>
			   							    <option value="estudio">Estudio</option>
			   							    <option value="loft">Loft</option>
			   							    <option value="bajo">Bajo</option>
			   							    <option value="atico">Ático</option>
		   						  			</select>
										</td></tr>
								</table>
							</div>
							<div id="anuncio2" class="w3-col w3-text-inmobshop  w3-border-inmobshop" style="width: 25%;">
								<table class="w3-table">
									<tr><th>Superficie</th><tr>
									<tr><td><input id="superficie" type="number"
											name="superficie"
											value=""
											pattern="[0-9]+([\.,][0-9]+)?"
		 									step="0.01"
											title="La superficie característica del inmueble: terreno o construcción. Seleccionar m2 o Ha en unidades de superficie."></td></tr>
									<tr><td>Nº habitaciones:</td></tr>
									<tr><td><input id="num_habitaciones" type="text"
											name="num_habitaaciones"
											value=""
											disabled
											title="Número de habitaciones de la vivienda"></td></tr>
									<tr><td>Nº baños:</td></tr>
									<tr><td><input id="num_banyos"type="text"
											name="num_banyos"
											value=""
											disabled
											title="Número de baños y aseos de la vivienda"></td></tr>
									<tr><td>Nº planta:</td></tr>
									<tr><td><input id="num_planta"type="text"
											name="num_planta"
											value=""
											disabled
											title="La planta en la que se encuentra la vivienda"></td></tr>
									<tr><th>Estado de vivienda</th></tr>
									<tr><td><input id="nueva" class="w3-radio"
											type="radio"
											name="estado_viv"
											value="nueva"
											disabled
											title="Si la vivienda es de obra nueva">
										 	<label>Nueva</label></td></tr>
									<tr><td><input id="bueno" class="w3-radio"
											type="radio"
											name="estado_viv"
											value="bueno"
											disabled
											title="Si la vivienda se encuentra en buen estado de conservación">
											<label>Bueno</label></td></tr>
									<tr><td><input id="rehabilitar"class="w3-radio"
											type="radio"
											name="estado_viv"
											value="rehabilitar"
											disabled title="Si la vivienda precisa ser rehabilitada">
										 	<label>Rehabilitar</label></td></tr>
									<tr><th>Equipamiento</th></tr>
									<tr><td><input id="vacio" class="w3-radio"
											type="radio"
											name="equipamiento"
											value="vacio"
											disabled
											title="La vivienda está vacía">
										 	<label>Vacío</label></td></tr>
									<tr><td><input id="cocina" class="w3-radio"
											type="radio"
											name="equipamiento"
											value="cocina"
											disabled title="La cocina está amueblada">
										 	<label>Cocina</label></td></tr>
									<tr><td><input id="amueblado" class="w3-radio"
											type="radio"
											name="equipamiento"
											value="amueblado"
											disabled
											title="La vivienda está amueblada">
										 	<label>Amueblado</label></td></tr>
									<tr><th>Fachada</th></tr>
									<tr><td><input id="exterior" class="w3-radio"
											type="radio"
											name="fachada"
											value="exterior"
											disabled
											title="La vivienda es exterior">
										 	<label>Exterior</label></td></tr>
									<tr><td><input id="interior" class="w3-radio"
											type="radio"
											name="fachada"
											value="interior"
											disabled
											title="La vivienda es interior">
										 	<label>Interior</label></td></tr>
								</table>
							</div>
							<div id="anuncio3" class="w3-col w3-text-inmobshop" style="width: 25%;">
								<table class="w3-table">
									<tr><th>Orientación</th></tr>
									<tr><td><input id="norte" class="w3-radio"
											type="radio"
											name="orientacion"
											value="norte"
											disabled title="La vivienda se orienta al norte">
										 	<label>Norte</label></td></tr>
									<tr><td><input id="sur" class="w3-radio"
											type="radio"
											name="orientacion"
											value="sur"
											disabled title="La vivienda se oienta al sur">
										 	<label>Sur</label></td></tr>
									<tr><td><input id="este" class="w3-radio"
											type="radio"
											name="orientacion"
											value="este"
											disabled
											title="La vivienda se orienta al este">
										 	<label>Este</label></td></tr>
									<tr><td><input id="oeste" class="w3-radio"
											type="radio"
											name="orientacion"
											value="oeste"
											disabled
											title="La vivienda se orienta al oeste">
										 	<label>Oeste</label></td></tr>
									<tr><th>Otras características</th></tr>
									<tr><td><input id="ascensor" class="w3-check"
											name="ascensor"
											disabled
											title="La vivienda sdispone de ascensor"
											type="checkbox">
											<label for="ascensor">Ascensor</label>
											</td></tr>
									<tr><td><input id="arm_empotrados" class="w3-check"
											name="arm_empotrados"
											disabled
											title="La vivienda tiene armarios empotrados"
											type="checkbox">
											<label for="arm_empotrados">Arm. empotrados</label>
											</td></tr>
									<tr><td><input id="calefaccion" class="w3-check"
											name="calefaccion"
											disabled
											title="La vivienda dispone de calefacción"
											type="checkbox">
											<label for="calefaccion">Calefacción</label>
											</td></tr>
									<tr><td><input id="aire_acond" class="w3-check"
											name="aire_acond"
											disabled
											title="La vivienda dispone de aire acondicionado"
											type="checkbox">
											<label for="aire_acond">Aire Acond.</label>
											</td></tr>
									<tr><td><input id="terraza" class="w3-check"
											name="terraza"
											disabled
											title="La vivienda tiene terraza"
											type="checkbox">
											<label for="terraza">Terraza</label>
											</td></tr>
									<tr><td><input id="balcon" class="w3-check"
											name="balcon"
											disabled
											title="La vivienda tiene balcón"
											type="checkbox">
											<label for="balcon">Balcón</label>
											</td></tr>
									<tr><td><input id="trastero" class="w3-check"
											name="trastero"
											disabled
											title="La vivienda tiene trastero"
											type="checkbox">
											<label for="trastero">Trastero</label>
											</td></tr>
									<tr><td><input id="plaza_garaje" class="w3-check"
											name="plaza_garaje"
											disabled
											title="La vivienda tiene plaza de garaje"
											type="checkbox">
											<label for="plaza_garaje">Plaza garaje</label>
											</td></tr>
									<tr><td><input id="piscina_propia" class="w3-check"
											name="piscina_propia"
											disabled
											title="La vivienda tiene piscina individual"
											type="checkbox">
											<label for="piscina_propia">Piscina propia</label>
											</td></tr>
									<tr><td><input id="urbanizacion" class="w3-check"
											name="urbanizacion"
											disabled
											title="La vivienda forma parte de un urbanización"
											type="checkbox">
											<label for="urbanizacion">Urbanización</label>
											</td></tr>
									<tr><td><input id="piscina_comun" class="w3-check"
											name="piscina_comun"
											disabled
											title="La vivienda tiene piscina comunitaria"
											type="checkbox">
											<label for="piscina_comun">Piscina común</label>
											</td></tr>
									<tr><td><input id="zonas_verdes" class="w3-check"
											name="zonas_verdes"
											disabled
											title="La vivienda dispone de zonas verdes"
											type="checkbox">
											<label for="zonas_verdes">Zonas verdes</label>
										</td></tr>
								</table>
							</div>
							<div id="anuncio4" class="w3-col w3-text-inmobshop" style="width: 25%;">
								<table class="w3-table">
									<tr><th>Precio</th><tr>
									<tr><td><input id="precio" type="number"
											name="precio"
											min="0"
											max="1000000000"
											step="0.01"
											pattern="[0-9]+([\.,][0-9]+)?"
											required
											value=""><span><b> Euros</b></td></tr></span></td></tr>
									<tr><th>Tiempo del precio</th></tr>
									<tr><td><input id="semana" class="w3-radio"
											type="radio"
											name="tiempo"
											value="semana"
											disabled
											title="El alquiler es semanal">
										 	<label>Semana</label></td></tr>
									<tr><td><input id="quincena" class="w3-radio"
											type="radio"
											name="tiempo"
											value="qincena"
											disabled
											title="El alquiler es quincenal">
											<label>Quincena</label></td></tr>
									<tr><td><input id="mes" class="w3-radio"
											type="radio"
											name="tiempo"
											value="mes"
											disabled
											title="El alquiler es mensual">
										 	<label>Mes</label></td></tr>
									<tr><th>Unidades de superficie</th></tr>
									<tr><td><input id="m2" class="w3-radio"
											type="radio"
											name="unidad_superficie"
											value="m2"
											checked
											title="Metros cuadrados">
										 	<label>m2</label></td></tr>
									<tr><td><input id="ha" class="w3-radio"
											type="radio"
											name="unidad_superficie"
											value="ha"
											checked
											title="Hectáreas">
											<label>Ha</label></td></tr>
								</table>
							</div>
						</div>
						<div id="crea_anuncio" class="w3-col w3-center"
							style="margin-top: 10px;">
							<input class="w3-input w3-large w3-inmobshop"
								name="enviar"
								title="ATENCIÓN, asegúrate de haber guardado tus fotos antes de crear el anuncio."
								value = "Crea Anuncio"
								type="submit">
						</div>
					</form>
				</div>
			</div>
			<?php  echo muestraErrores($errors);?>
			<div class="w3-row w3-bootom" style="position:relative;bottom: 0;">
				<div class="w3-col l2 m12 s12">
					<p></p>
				</div>
				<div class="w3-col l8 m12 s12">
					<p></p>
				</div>
				<div id="subir" class="w3-col l2 m12 s12" style = "font-size: 30px;">
					<a class = "w3-text-inmobshop w3-large w3-hover-text-blue"
						href = "#"
					>
					<span><i class="material-icons inmobshop"
						>arrow_upward</i><b class="">Subir</b>
					</span>
					</a>
				</div>
			</div>
		</main>
        <footer class="w3-bar w3-inmobshop">
			<div class="w3-bar-item w3-mobile" style="width:16.66%;">
				<p class="w3-text-amber w3-small">Javier Loring Moreno</p>
				<p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
			</div>
			<div class="w3-bar-item w3-mobile" style="width:66.66%;">
				<p class = "w3-text-amber w3-small"
				   style = "text-align: center;padding-top: 0px;">
					2020
				</p>
			</div>
		</footer>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy5jl21kgBW_fqxS91inIK12QVvVh3RJc&libraries=places&callback=initMap"
		async defer></script>
		<script src="..\js\crear-anuncio.js" charset="utf-8"></script>
		<script src="..\js\anuncio-mapa.js" charset="utf-8"></script>
		<script src="..\js\inputs-anuncios.js" charset="utf-8"></script>
		<script type="text/javascript">
		//$('#crea_anuncio').on('click', crear_anuncio);
		</script>
		<!-- <script src="..\js\crear-anuncio.js" charset="utf-8"></script>
		<script src="..\js\anuncio-mapa.js" charset="utf-8"></script>
		<script src="..\js\inputs-anuncios.js" charset="utf-8"></script> -->
    </body>
</html>
