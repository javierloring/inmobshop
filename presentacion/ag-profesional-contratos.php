<?php
session_start();
//utilizamos recursos de la aplicación
require_once '../vendor/autoload.php';
//la configuración general
require_once '../config.php';
//la capa de datos
require_once '../datos/Usuario.php';
require_once '../datos/Particular.php';
require_once '../datos/Contrato.php';
//la capa de negocio
require '../negocio/funciones-inmobshop.php';

#var_dump($_SESSION, $_GET);
//ya se ha realizado el registro e iniciado sesión $_SESSION
$nombre_pag = 'contratos';
//definimos variables
$id_usuario = '';
if(isset($_SESSION['id']) && isset($_SESSION['tipo_usuario'])){
	$id_usuario = $_SESSION['id'];
	$tipo_usuario = $_SESSION['tipo_usuario'];
	//obtenemos el registro del usuario
	$usuario_row = Usuario::obtenUsuarioId($id_usuario);
	//obtenemos el nombre del usuario
	$nombre = $usuario_row['usuario'];
	#var_dump($nombre);
	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Sesión-Particular-inmobshop</title>
        <link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
        <link href='https://fonts.googleapis.com/css?family=Poller One' rel='stylesheet'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
                <div class="w3-col w3-border" style="width:14%;">
					<input id="id_usuario"
						type="hidden"
						name="id_usuario"
						value="<?= $id_usuario ?>">
					<input id="tipo_usuario"
						type="hidden"
						name="tipo_usuario"
						value="<?= $tipo_usuario ?>">
                </div>
                <div class="w3-col " style="width:70%;">
                    <ul class="breadcrumb w3-ul">
                      	<?php
					  	$html = '';
						$html .= '<li><a class="w3-hover-text-blue" href="/inmobshop/index.php">Home</a></li>';
						$html .= '<li><a class="w3-hover-text-blue" href="/inmobshop/presentacion/iniciar-sesion.php">iniciar sesión</a></li>';
							#var_dump($html);
					  	echo $html;
					  	?>
                  		<li><?= $nombre_pag ?></li>
                    </ul>
                </div>
                <div class="w3-col w3-text-inmobshop " style="width:16%;">
					<span>Sesión iniciada por: <b><?= $nombre ?></b></span>
                </div>
            </div>
			<div class="w3-row w3-panel " style="margin-top:1%">
                <div class="w3-col w3-panel " style="width: 12.66%">
                    De tu interés
                </div>
				<div id="central" class="w3-col w3-panel  w3-text-inmobshop " style="width: 44%">
						<p><b >Servicios de anuncios disponibles</b></p>
						<div id="cuerpo_servicios_tipo" class="w3-col w3-text-inmobshop " style="width: 100%;margin: 0;padding-left: 30px;">
						</div>
						<hr>
						<p id="p_contratos"><b >Contratos del usuario <span id="nombre"><?= $nombre ?></span></b></p>
						<div id="anuncios" class="">

						</div>
						<!-- <div id="contratos_vigor" class="w3-col w3-small w3-text-inmobshop " style="width: 100%;margin: 0;padding-left: 30px;">
							<div id="salida_nombre_contrato" class="w3-col w3-panel "
							style="width: 50%;margin: 0;">
							</div>
							<div class="w3-col w3-panel "
							style="width: 25%;margin: 0;text-align: right;">
								<b>Fecha</b>
							</div>
							<div id="salida_fecha_contrato" class="w3-col w3-panel "
							style="width: 25%;margin: 0;">
							</div>
						</div>
						<div id="salida_anuncios_vinculados" class="w3-col w3-small w3-text-inmobshop "
						style="width: 100%;margin: 0;">
						</div> -->
				</div>
				<div class="w3-col w3-panel " style="width: 26.66%;">
					<div id="detalle_servicio" class="w3-panel w3-text-inmobshop ">
						<p class="" style="margin: 0px;"><b>Detalles del servicio</b></p>
						<p class="" style="margin: 0px;"><b>Nombre</b></p>
						<div id="salida_nombre" class="w3-row ">
						</div>
						<div class="w3-col w3-panel " style="width: 33.33%;margin: 0;">
							<b>Nivel</b>
						</div>
						<div class="w3-col w3-panel " style="width: 33.33%;margin: 0;">
							<b>Nº Anuncios</b>
						</div>
						<div class="w3-col w3-panel " style="width: 33.33%;margin: 0;">
							<b>Nº Días</b>
						</div>
						<div id="salida_nivel" class="w3-col w3-panel " style="width: 33.33%;margin: 0;">
						</div>
						<div id="salida_num_anuncios" class="w3-col w3-panel " style="width: 33.33%;margin: 0;">
						</div>
						<div id="salida_num_dias" class="w3-col w3-panel " style="width: 33.33%;margin: 0;">
						</div>
						<div class="w3-row ">
							<p class="" style="margin: 0px;"><b>Descripción</b></p>
						</div>
						<div id="salida_descripcion" class="w3-row w3-panel " style="margin: 0px;">
						</div>
						<div class="w3-col w3-panel " style="width: 33.33%">
							<b>Precio:</b>
						</div>
						<div id="salida_precio" class="w3-col w3-panel "
							style="width: 33.33%; text-align: right">
						</div>
						<div class="w3-col w3-panel " style="width: 33.33%">
							<b>Euros</b>
						</div>
					</div>
					<div id="contratar" class="w3-container w3-inmobshop w3-hover-blue w3-center w3-padding w3-margin"
						title="Pulsa para contratar y poder publicar tus anuncios.">
						Contratar Servicio
					</div>
					<div id="pagar" class="w3-container w3-inmobshop w3-hover-blue w3-center w3-padding w3-margin"
						title="Debes realizar el pago de tus contratos pendientes.">
						Pagar Servicio
					</div>
					<div class="w3-container w3-small w3-text-inmobshop w3-margin">
						<b>Nota sobre el servicio de resaltado de anuncios:</b>
					</div>
					<div class="w3-container w3-small w3-text-inmobshop w3-padding w3-margin"
						style="border: solid #000066 2px;">
						Nivel 1: normal,<br>
						Nivel 2: Nivel 1 + color + posición mejorada en lista,<br>
						Nivel 3: Nivel 2 + posición mejorada en mapa,<br>
						Nivel 4: Nivel 3 + presencia 1/3 principal 5 días alternos,<br>
						NIvel 5: Nivel 4 + presencia Portada 5 días alternos.<br>
					</div>

                </div>
			</div>
			<div class="w3-row w3-panel" style="margin-top:1%">
			<div class="">

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
		<footer class="w3-bar w3-inmobshop ">
			<div class="w3-bar-item w3-mobile " style="width:16.66%;">
				<p class="w3-text-amber w3-small">Javier Loring Moreno</p>
				<p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
			</div>
			<div class="w3-bar-item w3-mobile " style="width:66.66%;">
				<p class = "w3-text-amber w3-small"
				   style = "text-align: center;padding-top: 0px;">
					2020
				</p>
			</div>
		</footer>
		<script src="..\js\contratos-anunciantes.js" charset="utf-8"></script>
		<script type="text/javascript">
			//recuperamos las variables de la sesión de usuario de los campos ocultos
			var tipo_usuario = $('#tipo_usuario').val();
			var id_usuario = $('#id_usuario').val();
			//mostramos los servicios que están disponibles para el tipo de usuario
			mostrar_servicios_tipo(tipo_usuario);
			//mostramos los contratos en vigor
			mostrar_contratos_en_vigor();
			//si no hay contrato pendiente de pago registramos la función contratar
			var cont_pendiente = contrato_pendiente(id_usuario, tipo_usuario);
		    //if(!cont_pendiente){
			$('#contratar').on('click', contrata);
			//}
			//registramos el pago y damos de alta en el registro
			$('#pagar').on('click', pagar_servicio);
		</script>
    </body>
</html>
