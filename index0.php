<?php
require 'vendor/autoload.php';
require 'config.php';
#echo $_SERVER['PHP_SELF'];
$url = $_SERVER['PHP_SELF'];
$nombre = 'Home';
#var_dump($url, $nombre);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Home-inmobshop</title>
        <link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="css\w3.css">
        <link rel="stylesheet" href="css\inmobshop.css">
		<link href='https://fonts.googleapis.com/css?family=Poller One' rel='stylesheet'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="js\jquery-3.4.0.js" charset="utf-8"></script>
        <script src="js\index.js" charset="utf-8"></script>
        <script src="js\inicio-sesion.js" charset="utf-8"></script>
		<script src="js\w3.js"></script>
    </head>
    <body>
		<header class="w3-bar w3-inmobshop w3-border w3-border-red"
				style="position: sticky; position: -webkit-sticky; top: 0;z-index: 1;">
	        <a  class="w3-bar-item w3-mobile w3-text-amber w3-myfont w3-center w3-border w3-border-white" href="#"
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
        <main class="w3-container">
            <div id="breadcrumbs" class="w3-row w3-panel">
                <div class="w3-col l2 m12 s12">
					<p></p>
                    <p class="oculto"><?= $nombre ?></p>
                </div>
                <div class="w3-col l8 m12 s12">
                    <ul class="breadcrumb w3-ul">
                        <li>Home</li>
                    </ul>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div id="anuncio_nivel5" class="w3-row w3-panel">
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
                <div class="w3-col l8 m12 s12 w3-display-container">
                    <div id="portada" class="w3-center">
                    </div>
                    <div id ="enlace" class="w3-display-topright w3-container">
                        <p style="background-color: #eee; padding:  5px 40px; color: #000066;">

                        </p>
                    </div>
                </div>
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div id="heredado" class="w3-row w3-container">
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
                
                <div class="w3-col l2 m12 s12">
                    <p></p>
                </div>
            </div>
            <div id="subir" class="w3-row w3-bootom" style="position:relative;bottom: 0;">
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
        <script type="text/javascript">
			//muestra el enlace para subir al innicio de la página
			$(document).on('scroll', subir);
			//gestiona los anuncios de nivel 5
            colocar_portada();
			//probando navegación
            $('select').on('change', enviar_usuario);
        </script>
    </body>
</html>
