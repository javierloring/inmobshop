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

//nuestra posición--------------------------------------------------------------
#echo $_SERVER['PHP_SELF'];
$url = $_SERVER['PHP_SELF'];
//nuestro nombre y ubicación
$nombre_pag = 'crea tu anuncio';
#var_dump($url, $nombre);
//declaramos la variable errors para almacenar los errores
$errors = array();
//---------------------------------------------------------------------AUTO POST
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
		  <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
        <link rel="stylesheet" href="..\css\miniaturas.css">
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
        <header class="w3-bar w3-inmobshop w3-border w3-border-red"
		style="top: 0;z-index: 1;">
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
			<div class="w3-row w3-panel w3-border w3-border-red" style="margin-top:1%">
                <div class="w3-col w3-border w3-border-red" style="width: 16.66%">
                    <p></p>
                </div>
				<div class="w3-col" style="width: 66.66%">
					<form id="formulario_1" class="" action="crear_anuncio.php" method="post">
						<div id="dropzone">
							<h5 class="reclamo">
								<b>Seleccione imagenes de su explorador y arrastrelas a esta zona.</b>
							</h5>
							<div class="w3-col w3-center w3-border w3-border-inmobshop reclamo">
								<span><i class="material-icons inmobshop"
									style = "font-size: 80px;padding-top:20px;">
									camera_alt</i>
								</span>
							</div>
						</div>
						<div class="w3-col w3-center w3-border">
							<input class="w3-input w3-padding w3-large w3-inmobshop"
							type="submit"
							onclick="enviar_datos(this);"
							name=""
							value="Subir fotos">
						</div>
					</form>
					<div class="w3-border w3-border-indigo">
						<form id="anuncio" class = "w3-center"
							 action = "<?= $_SERVER['PHP_SELF']?>"
							 onsubmit = "return validaFormulario();"
							 method="post">
							 <div class="w3-row w3-border w3-inmobshop w3-border-inmobshop">
								<div class="w3-col w3-border-inmobshop" style="width: 25%;min-height:50px;margin-top: 5px;">
                                    <select id="tipo_inmueble"
	                                        class="w3-select w3-inmobshop w3-border w3-border-inmobshop"
	                                        name="tipo_inmueble"
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
		   						  	</select>
								</div>
								<div class="w3-col w3-border-inmobshop"
                                    style="width: 50%;margin-top: 5px;"
                                    title="introduzca la localización y confirmela en el mapa interactivo">
									<div class="w3-container w3-inmobshop w3-border w3-border-inmobshop"
                                        style="padding:4px;">
                                        <label for="local"
                                        class="">
                                            Localización
                                        </label>
                                        <input id="local"
                                            type="text"
                                            name="loclizacion"
                                            placeholder="Provincia, localidad..."
                                            value=""
                                            style="margin-left:30px;">
                                        <button type="button"
                                            name="confirmar"
                                            class="">
                                            <b>Ir</b>
                                        </button>
                                    </div>
								</div>
								<div class="w3-col w3-border-inmobshop" style="width: 25%;margin-top: 5px;">
                                    <select id="tipo_operacion"
                                        class="w3-select w3-inmobshop w3-border-inmobshop"
                                        name="tipo_operacion"
                                        required
                                        style="">
		   							    <option value="" disabled selected>Tipo de operación</option>
		   							    <option value="venta">Venta</option>
		   							    <option value="alquiler">Alquiler</option>
		   							    <option value="vacacional">Vacacional</option>
		   							    <option value="compartir">Compartir</option>
		   						  	</select>
								</div>
							</div>
                            <div class="w3-row w3-border w3-border-inmobshop">
								<div class="w3-col  w3-border-inmobshop w3-text-inmobshop" style="width: 25%;">
									<table id="anuncio1" class="w3-table">
										<tr><th>Localización</th></tr>
										<tr><td>Vía</td></tr>
										<tr><td><input type="text" name="via" value=""></td></tr>
										<tr><td>Núm. vía</td></tr>
										<tr><td><input type="text" name="num_via" value=""></td></tr>
										<tr><td>Código postal</td></tr>
										<tr><td><input type="text" name="cod_postal" value=""></td></tr>
										<tr><td>Localidad</td></tr>
										<tr><td><input type="text" name="localidad" value=""></td></tr>
										<tr><td>Provincia</td></tr>
										<tr><td><input type="text" name="provincia" value=""></td></tr>

										<tr><th>Tipo de terreno</th></tr>
										<tr><td><select id="tipo_terreno"
		                                        class="w3-select w3-inmobshop"
		                                        name="tipo_terreno"
		                                        required
		                                        style="">
				   							    <option value="" disabled selected>Tipo de terreno</option>
				   							    <option value="s_urbano">Suelo urbano</option>
				   							    <option value="s_uebaniz">Suelo urbanizable</option>
				   							    <option value="s_rustico">Suelo Rústico</option>
				   						  		</select>
											</td></tr>
										<tr><td><input class="w3-check"
                                                name="agua"
                                                type="checkbox">
												<label for="agua">Agua</label>
                                                <input class="w3-check"
                                                name="luz"
                                                type="checkbox">
												<label for="luz">Luz</label>
											</td></tr>
										<tr><th>Tipo de vivienda</th></tr>
										<tr><td><select id="tipo_vivienda"
		                                        class="w3-select w3-inmobshop"
		                                        name="tipo_vivienda"
		                                        required
		                                        style="">
				   							    <option value="" disabled selected>Tipo de vivienda</option>
				   							    <option value="piso">Piso</option>
				   							    <option value="chalet">Chalet unifamiliar</option>
				   							    <option value="casa_rustica">Casa rústica</option>
				   							    <option value="casa_especial">Casa especial</option>
			   						  			</select>
											</td></tr>
										<tr><th>Tipo de Piso</th></tr>
										<tr><td><select id="tipo_piso"
		                                        class="w3-select w3-inmobshop"
		                                        name="tipo_piso"
		                                        required
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
								<div class="w3-col w3-text-inmobshop  w3-border-inmobshop" style="width: 25%;">
									<table id="anuncio2" class="w3-table">
										<tr><th>Superficie</th><tr>
										<tr><td><input type="text" name="superficie" value=""></td></tr>
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
								<div class="w3-col w3-text-inmobshop" style="width: 25%;">
									<table id="anuncio3" class="w3-table">
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
								<div class="w3-col w3-text-inmobshop" style="width: 25%;">
									<table id="anuncio4" class="w3-table">
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
						<div class="w3-col w3-center w3-border w3-border-indigo">
						<input class="w3-input w3-large w3-inmobshop"
								name="enviar"
								value = "Crea Anuncio"
								type="submit">
						</div>

						</form>
					</div>
				</div>



					<?php  echo muestraErrores($errors);?>
					<p></p>
					<br><br><br><br><br><br><br>

				<!-- <div class="w3-col l4 m12 s12">
					<p></p>
				</div> -->
			</div>
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
		<script src="..\js\crear-anuncio.js" charset="utf-8"></script>
        <script type="text/javascript">

        </script>
    </body>
</html>
