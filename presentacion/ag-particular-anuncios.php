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
$nombre_pag = 'anuncios';
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
				href = "<?= ABSPATH . CONTRATOS_PARTICULARES ?>">
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
				href = "<?= ABSPATH . ANUNCIOS_PARTICULARES ?>">
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
				href = "<?= ABSPATH . CONTACTOS_PARTICULARES ?>">
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
				href = "<?= ABSPATH . BUSQUEDAS_Y_FAVORITOS_PARTICULARES ?>">
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
				href = "<?= ABSPATH . PERFIL_PARTICULARES ?>">
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
				href = "<?= ABSPATH . CIERRA_SESION ?>">
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
                <div class="w3-col w3-border w3-border-green" style="width:14%;">
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
                <div class="w3-col w3-text-inmobshop" style="width:16%;">
					<span>Sesión iniciada por: <b><?= $nombre ?></b></span>
                </div>
            </div>
			<div class="w3-row w3-panel " style="margin-top:1%">
                <div class="w3-col w3-panel " style="width: 12.66%">
                    De tu interés
                </div>
				<div id="central" class="w3-col w3-panel  w3-text-inmobshop " style="width: 69%">
					<p><b >Anuncios publicados por el usuario <?= $nombre ?></b></p>
					<div id="anuncios" class="w3-col w3-text-inmobshop " style="width: 100%;margin: 0;padding-left: 30px;">
					</div>
					<div class="w3-center">
						<div class="w3-bar">
						  <a href="#" class="w3-button">&laquo;</a>
						  <a href="#" class="w3-button">1</a>
						  <a href="#" class="w3-button">2</a>
						  <a href="#" class="w3-button">3</a>
						  <a href="#" class="w3-button">4</a>
						  <a href="#" class="w3-button">&raquo;</a>
						</div>
					</div>
					<p><b >Vincular anuncios a contratos</b></p>
					<div class="w3-col w3-panel " style="width: 100%;">
						<div id="detalle_servicio" class="w3-panel w3-text-inmobshop ">
							<div class="w3-col w3-panel " style="width: 40%;margin: 0;">
								<b>Contratos vigentes</b>
							</div>
							<div class="w3-col w3-panel " style="width: 15%;margin: 0;">
								<b>Id Anuncios</b>
							</div>
							<div class="w3-col w3-panel " style="width: 15%;margin: 0;">
								<b>Operación</b>
							</div>
							<div class="w3-col w3-panel " style="width: 15%;margin: 0;">
								<b>Inmueble</b>
							</div>
							<div class="w3-col w3-panel " style="width: 15%;margin: 0;">
								<b></b>
							</div>
							<div id="contratos_vigentes" class="w3-col w3-panel " style="width: 40%;">
							</div>
							<div id="salida_id"class="w3-col w3-panel " style="width: 15%;">

							</div>
							<div id="salida_tipo_operacion"class="w3-col w3-panel " style="width: 15%;">

							</div>
							<div id="salida_tipo_inmueble"class="w3-col w3-panel " style="width: 15%;">

							</div>
						<div id="contratar" class="w3-col w3-panel w3-padding w3-inmobshop w3-hover-blue w3-center vincular_ok"
							style="width: 15%;"
							title="Pulsa para vincular un anuncio a un contrato vigente.">
							Vincular anuncio
						</div>
					</div>
					<div class="w3-col w3-panel " style="width: 20%;">
						<b>Crear nuevo anuncio</b>
					</div>
					<div id="contratar" class="w3-col w3-container w3-inmobshop w3-hover-blue w3-center w3-padding w3-margin"
						style="width: 20%;"
						title="Pulsa para crear un nuevo anuncio.">
						<a href="ag-particular-crear-anuncio.php" style="text-decoration: none;">Nuevo anuncio</a>
					</div>
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
			<script src="..\js\anuncios-anunciantes.js" charset="utf-8"></script>
			<script type="text/javascript">
			//recuperamos las variables de la sesión de usuario de los campos ocultos
			var tipo_usuario = $('#tipo_usuario').val();
			var id_usuario = $('#id_usuario').val();
			//mostrtaos los anuncios del usuario
			mostrar_anuncios();
			rellenar_contratos_vigentes();
			</script>
	    </body>
	</html>
