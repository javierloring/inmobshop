<?php
//utilizamos recursos de la aplicación
require '../vendor/autoload.php';
//la configuración general
require '../config.php';
//los capa de datos

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Login-inmobshop</title>
		<link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
		<link href='https://fonts.googleapis.com/css?family=Poller One' rel='stylesheet'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="..\js\jquery-3.4.0.js" charset="utf-8"></script>
		<script src="..\js\index.js" charset="utf-8"></script>
		<script src="..\js\inicio-sesion.js"></script>
        <script src="..\js\w3.js"></script>
    </head>
    <body>
		<header class="w3-bar w3-inmobshop w3-border w3-border-red"
		style="position: sticky; position: -webkit-sticky; top: 0;z-index: 1;">
			<a  class="w3-bar-item w3-mobile w3-text-amber w3-myfont w3-center w3-border w3-border-white"
			href="/inmobshop/index.php"
				style = "text-decoration: none; width:14%; padding: 0px;">
				<span style="font-size:50px;">IS </span><span style="font-size:22px;">inmobshop</span>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center w3-border w3-border-white"
			   style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= BUSCAR_OFERTAS ?>">
				<p class="w3-text-amber w3-hover-text-white w3-border w3-border-white"
				style="margin-bottom:0px;font-weight: bold;">
					Buscar ofertas
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center w3-border w3-border-white"
			   style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= CREA_TU_ANUNCIO ?>">
				<p class="w3-text-amber w3-hover-text-white w3-border w3-border-white"
				style="margin-bottom:0px;font-weight: bold;">
					Crea tu anuncio
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center w3-border w3-border-white"
			  style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= REGISTRATE ?>">
				<p class="w3-text-amber w3-hover-text-white w3-border w3-border-white"
				style="margin-bottom:0px;font-weight: bold;">
					Regístrate
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center w3-border w3-border-white"
			 style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= INICIA_SESION ?>">
				<p class="w3-text-amber w3-hover-text-white w3-border w3-border-white"
				style="margin-bottom:0px;font-weight: bold;">
					Inicia sesión
				</p>
			</a>
		</header>
			<main>

			</main>
			<footer class="w3-container w3-inmobshop w3-border w3-border-white">
	            <div class = " w3-row  w3-panel w3-inmobshop w3-border w3-border-white">
	                <div class="w3-col l2 m12 s12 w3-inmobshop w3-border w3-border-white" style="height: 50px;">
	                    <p class="w3-text-amber w3-small">Javier Loring Moreno</p>
	                    <p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
	                </div>
	                <div class="w3-col l8 m12 s12 w3-inmobshop w3-border w3-border-white" style="height: 50px;">
	                    <p class = "w3-text-amber w3-small"
	                       style = "text-align: center;padding-top: 0px;">
	                        2020
	                    </p>
	                </div>
	                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 50px;">
	                </div>
	            </div>
	        </footer>
			<script type="text/javascript">
				//muestra el enlace para subir al inicio de la página
				$(document).on('scroll', subir);
				//registramos el evento para añadir campos para los tipos de usuarios
				$('#tipo_usuario').on('change', anyadir_campo);
			</script>
		</body>
	</html>
