<?php
//utilizamos recursos de la aplicación
require '../../vendor/autoload.php';
//la configuración general
require '../../config.php';
//los capa de datos

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Plantilla-inmobshop</title>
		<link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="..\..\css\w3.css">
        <link rel="stylesheet" href="..\..\css\inmobshop.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="..\..\js\jquery-3.4.0.js" charset="utf-8"></script>
		<script src="..\..\js\index.js" charset="utf-8"></script>
		<script src="..\..\js\registro.js"></script>
        <script src="..\..\js\w3.js"></script>
    </head>
    <body>
		<header class="w3-container w3-inmobshop w3-border w3-border-white"
		style="position: sticky; position: -webkit-sticky; top: 0;z-index: 1;">
	            <div class = "w3-row w3-container w3-inmobshop w3-border w3-border-white">
	                <div class="w3-col l2 m12 s12 w3-inmobshop w3-border w3-border-white" style="height: 80px;">
	                    <a  href="#">
	                        <img class = "w3-button w3-hover-inmobshop"
	                             style = "height: 100%; padding-bottom: 10px;"
	                               src = "<?= LOGO_INMOBSHOP ?>"/>
	                    </a>
	                </div>
	                <div class="w3-col l2 m3 s12 w3-inmobshop w3-border w3-border-white" style="height: 80px;">
	                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large w3-center"
	                       style = "text-decoration: none;"
	                        href = "<?= BUSCAR_OFERTAS ?>">
	                        <p style="padding-top: 20px;">
	                            Buscar ofertas
	                        </p>
	                    </a>
	                </div>
	                <div class="w3-col l2 m3 s12 w3-inmobshop w3-border w3-border-white" style="height: 80px;">
	                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large  w3-center"
	                       style = "text-decoration: none;"
	                        href = "<?= CREA_TU_ANUNCIO ?>">
	                        <p style="padding-top: 20px;">
	                            Crea tu anuncio
	                        </p>
	                    </a>
	                </div>
	                <div class="w3-col l2 m3 s12 w3-inmobshop w3-border w3-border-white" style="height: 80px;">
	                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large  w3-center"
	                       style = "text-decoration: none;"
	                        href = "<?= REGISTRATE ?>">
	                        <p style="padding-top: 20px;">
	                            Regístrate
	                        </p>
	                    </a>
	                </div>
	                <div class="w3-col l2 m3 s12 w3-inmobshop w3-border w3-border-white" style="height: 80px;">
	                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large w3-center"
	                       style = "text-decoration: none;"
	                        href = "<?= INICIA_SESION ?>">
	                        <p style="padding-top: 20px;">
	                            Inicia sesión
	                        </p>
	                    </a>
	                </div>
	                <div class="w3-col l2 m12 s12 w3-inmobshop w3-border w3-border-white" style="height: 80px;">
	                    <p></p>
	                </div>
	            </div>
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
