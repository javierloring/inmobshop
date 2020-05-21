<?php
//utilizamos recursos de la aplicación
require_once '../vendor/autoload.php';
//la configuración general
require_once '../config.php';
//la capa de datos
require_once '../datos/Usuario.php';
require_once '../datos/Particular.php';
require_once '../datos/Profesional.php';
//la capa de negocio
require '../negocio/funciones-inmobshop.php';
//iniciamos sesión
session_start();
//inicializamos variables
$id_usuario = '';
$tipo_usuario = '';
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
		$usuario_row = Usuario::obtenUsuario($id_usuario);
		$nombre = $usuario_row['usuario'];
	}
}
//nuestra posición--------------------------------------------------------------
#echo $_SERVER['PHP_SELF'];
$url = $_SERVER['PHP_SELF'];
//nuestro nombre y ubicación
$nombre_pag = 'crea tu anuncio';
#var_dump($url, $nombre);
//declaramos la variable errors para almacenar los errores
$errors = array();
//---------------------------------------------------------------------AUTO POST
//Esta página dispone de dos formularios: formulario_1 con las fotos subida por
//el usuario y que se envía a la base de datos por medio de una petición asíncrona
//utilizando la interfaz FormData que captura los datos del formulario
//recuperamos los datos del formulario
if(!empty($_POST)) {

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
        <header class="w3-bar w3-inmobshop w3-border w3-border-red"	style="top: 0;z-index: 1;">
			<a  class="w3-bar-item w3-mobile w3-text-amber w3-myfont w3-center w3-border w3-border-white"
				href="/inmobshop/index.php"
				style = "text-decoration: none; width:14%; padding: 0px;">
				<span style="font-size:50px;">IS </span><span style="font-size:22px;">inmobshop</span>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center w3-border w3-border-white"
			   style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= BUSCAR_OFERTAS ?>">
				<p class="<?php if($nombre_pag == 'buscar ofertas'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white w3-border w3-border-white"
				style="margin-bottom:0px;font-weight: bold;">
					Buscar ofertas
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center w3-border w3-border-white"
			   style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= CREA_TU_ANUNCIO ?>">
				<p class="<?php if($nombre_pag == 'crea tu anuncio'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white w3-border w3-border-white"
				style="margin-bottom:0px;font-weight: bold;">
					Crea tu anuncio
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center w3-border w3-border-white"
			  style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= REGISTRATE ?>">
				<p class="<?php if($nombre_pag == 'regístrate'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white w3-border w3-border-white"
				style="margin-bottom:0px;font-weight: bold;">
					Regístrate
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center w3-border w3-border-white"
			 style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= INICIA_SESION ?>">
				<p class="<?php if($nombre_pag == 'inicia sesión'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white w3-border w3-border-white"
				style="margin-bottom:0px;font-weight: bold;">
					Inicia sesión
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
						$html .= '<li><a href="/inmobshop/index.php">Home</a></li>';
							#var_dump($html);
					  	echo $html;
					  	?>
                  		<li><?= $nombre_pag ?></li>
                    </ul>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
			<div class="w3-row w3-panel" style="margin-top:1%">
                <div class="w3-col" style="width: 16.66%">
                    <p></p>
                </div>
				<div id="central" class="w3-col" style="width: 66.66%">
					<form id="fotos" class="" action="crear_anuncio.php" method="post">
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
						action = "<?= $_SERVER['PHP_SELF']?>"
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
			   							    <option value="terreno_cons">Terreno&const.</option>
			   							    <option value="vivienda">Vivienda</option>
			   							    <option value="local">Local</option>
			   							    <option value="oficina">Oficina</option>
			   							    <option value="garaje">Garaje</option>
			   							    <option value="trastero">Trastero</option>
			   							    <option value="Nave">Nave</option>
			   						  	</select></td></tr>
								</table>
							</div>
							<div id="locationField" class="w3-col w3-text-inmobshop w3-border-2 w3-border-inmobshop" style="width: 50%;border: dashed; margin-top: 40px;"
                                title="Introduce la dirección del inmueble en el campo central; selecciona la dirección cuando aparezca completa en el desplegable; mueve el mapa hasta que el marcador rojo esté sobre tu inmueble, pulsa OK para confirmarla.">
								<table id="anuncio02" class="w3-table">
									<tr>
										<td><label for="local" class="">
                                            <b>Localización</b>
										</label></td>
										<td><input id="autocomplete"
											type="text"
											name="localizacion"
											placeholder="Introduzca la dirección del inmueble..."
											size="40"
											value=""></td>
                                        <td><button id="ok" type="button"
                                            name="confirmar"
                                            class="">
                                            <b>Ok</b>
                                        </button></td>
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
						<div id="mapa_env" class="w3-panel w3-border-red" style="width: 100%;height:100%">
							<table class="w3-table w3-text-inmobshop">
								<tr><th>Marque la zona donde se ubica el inmueble</th></tr>
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
										<td><textarea name="name"
												rows="8"
												cols=""
												style="width: 150%"
												maxlength="255"
												title="Realice una descripción del inmueble todo lo detalladada que desee."
												></textarea></td>
									</tr>
								</table>
							</div>
						</div>
                        <div id="inputses" class="w3-row">
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
	                                        required
											title="introduce el tipo de suelo al que pertenece el inmueble."
	                                        style="">
			   							    <option value="" disabled selected>Tipo de terreno</option>
			   							    <option value="s_urbano">Suelo urbano</option>
			   							    <option value="s_uebaniz">Suelo urbanizable</option>
			   							    <option value="s_rustico">Suelo Rústico</option>
			   						  		</select>
										</td></tr>
									<tr><td><input class="w3-check"
                                            name="agua"
											title="Si el terreno dispone de agua en la actualidad."
                                            type="checkbox">
											<label for="agua">Agua</label>
                                            <input class="w3-check"
                                            name="luz"
											title="Si el terreno dispone de electricidad en la actualidad."
                                            type="checkbox">
											<label for="luz">Luz</label>
										</td></tr>
									<tr><th>Tipo de vivienda</th></tr>
									<tr><td><select id="tipo_vivienda"
	                                        class="w3-select w3-inmobshop"
	                                        name="tipo_vivienda"
	                                        required
											title="Seleccione el tipo de vivienda con el que corresponda el inmueble."
	                                        style="">
			   							    <option value="" disabled selected>Tipo de vivienda</option>
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
	                                        required
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
									<tr><td><input type="text" name="superficie" value="" title="La superficie característica del inmueble: terreno o construcción."></td></tr>
									<tr><td>Nº habitaciones:</td></tr>
									<tr><td><input type="text" name="num_habit" value=""></td></tr>
									<tr><td>Nº baños:</td></tr>
									<tr><td><input type="text" name="banyos" value=""></td></tr>
									<tr><td>Nº planta:</td></tr>
									<tr><td><input type="text" name="num_planta" value=""></td></tr>
									<tr><th>Estado de vivienda</th></tr>
									<tr><td><input class="w3-radio" type="radio" name="estado" value="male" checked>
										 	<label>Nueva</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="estado" value="male" checked>
											<label>Bueno</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="estado" value="male" checked>
										 	<label>Rehabilitar</label></td></tr>
									<tr><th>Equipamiento</th></tr>
									<tr><td><input class="w3-radio" type="radio" name="equipamiento" value="male" checked>
										 	<label>Vacío</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="equipamiento" value="male" checked>
										 	<label>Cocina</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="equipamiento" value="male" checked>
										 	<label>Amueblado</label></td></tr>
									<tr><th>Fachada</th></tr>
									<tr><td><input class="w3-radio" type="radio" name="fachada" value="male" checked>
										 	<label>Exterior</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="fachada" value="male" checked>
										 	<label>Interior</label></td></tr>
								</table>
							</div>
							<div id="anuncio3" class="w3-col w3-text-inmobshop" style="width: 25%;">
								<table class="w3-table">
									<tr><th>Orientación</th></tr>
									<tr><td><input class="w3-radio" type="radio" name="orientacion" value="male" checked>
										 	<label>Norte</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="orientacion" value="male" checked>
										 	<label>Sur</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="orientacion" value="male" checked>
										 	<label>Este</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="orientacion" value="male" checked>
										 	<label>Oeste</label></td></tr>
									<tr><th>Otras características</th></tr>
									<tr><td><input class="w3-check"
											name="ascensor"
											type="checkbox">
											<label for="ascensor">Ascensor</label>
											</td></tr>
									<tr><td><input class="w3-check"
												name="arm_empotrados"
												type="checkbox">
											<label for="arm_empotrados">Arm. empotrados</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="calefaccion"
											type="checkbox">
											<label for="calefaccion">Calefacción</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="aire_acond"
											type="checkbox">
											<label for="aire_acond">Aire Acond.</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="terraza"
											type="checkbox">
											<label for="terraza">Terraza</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="balcon"
											type="checkbox">
											<label for="balcon">Balcón</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="trastero"
											type="checkbox">
											<label for="trastero">Trastero</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="plaza_garaje"
											type="checkbox">
											<label for="plaza_garaje">Plaza garaje</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="piscina_propia"
											type="checkbox">
											<label for="piscina_propia">Piscina propia</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="urbanzacion"
											type="checkbox">
											<label for="urbanizacion">Urbanización</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="piscina_comun"
											type="checkbox">
											<label for="piscina_comun">Piscina común</label>
											</td></tr>
									<tr><td><input class="w3-check"
											name="zonas_verdes"
											type="checkbox">
											<label for="zonas_verdes">Zonas verdes</label>
										</td></tr>
								</table>
							</div>
							<div id="anuncio4" class="w3-col w3-text-inmobshop" style="width: 25%;">
								<table class="w3-table">
									<tr><th>Precio</th><tr>
									<tr><td><input type="number"
											name="precio"
											min="0"
											max="1000000000"
											value=""><span><b> Euros</b></td></tr>											</span></td></tr>
									<tr><th>Tiempo del precio</th></tr>
									<tr><td><input class="w3-radio" type="radio" name="tiempo" value="male" checked>
										 	<label>Semana</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="tiempo" value="male" checked>
											<label>Quincena</label></td></tr>
									<tr><td><input class="w3-radio" type="radio" name="tiempo" value="male" checked>
										 	<label>Mes</label></td></tr>
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
        <footer class="w3-bar w3-inmobshop w3-border w3-border-red">
			<div class="w3-bar-item w3-mobile w3-border w3-border-white" style="width:16.66%;">
				<p class="w3-text-amber w3-small">Javier Loring Moreno</p>
				<p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
			</div>
			<div class="w3-bar-item w3-mobile w3-border w3-border-white" style="width:66.66%;">
				<p class = "w3-text-amber w3-small"
				   style = "text-align: center;padding-top: 0px;">
					2020
				</p>
			</div>
		</footer>
		<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places&callback=initMap"
		async defer></script>
		<script type="text/javascript">

		</script>
		<script src="..\js\crear-anuncio.js" charset="utf-8"></script>
		<script src="..\js\anuncio-mapa.js" charset="utf-8"></script>
    </body>
</html>
