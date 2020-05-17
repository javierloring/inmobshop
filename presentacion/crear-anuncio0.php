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
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
        <link rel="stylesheet" href="..\css\miniaturas.css">
		<link href='https://fonts.googleapis.com/css?family=Poller One' rel='stylesheet'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
				<div id="form_4" class =" w3-col w3-card-4 w3-center" style="width: 66.66%">
                    <div class="w3-row w3-container w3-center w3-border w3-border-green" style="">
						<div class="w3-col w3-center w3-border w3-border-indigo">
                            <form id="form_zone" class=""
                                action="..\negocio\ca-crear-anuncio.php"
                                method="post">
                                <div id="dropzone" class="" style="height: 200px;">
                                    <div id="reclamo" class="w3-center " style="border: 5px solid blue;">
                                        <h5 class="w3-border w3-border-red">
                                            <b>Seleccione imagenes de su explorador y arrastrelas a esta zona.</b>
                                        </h5>
                                        <div class="w3-col w3-center w3-border w3-border-inmobshop">
        									<span><i class="material-icons inmobshop"
        										style = "font-size: 80px;padding-top:0%;">
                                                camera_alt</i>
                                            </span>
        								</div>
                                    </div>
									<div class="w3-container w3-center w3-border w3-border-red">
                                        <input type="submit"
                                            onclick="enviar_datos(this);"
                                                name=""
                                                value="Guardar fotos del anuncio">
                                    </div>
                                </div>
                            </form>
						</div>
						<div class="">
							<form id="anuncio" class = "w3-container  w3-center"
								 action = "<?= $_SERVER['PHP_SELF']?>"
								 onsubmit = "return validaFormulario();"
								 method="post">
						        <p></p>

                        	<div class="w3-col w3-center w3-border w3-border-indigo">
							<input class="w3-input w3-padding w3-large w3-inmobshop"
									name="enviar"
									value = "Crea Anuncio"
									type="submit">
							</div>

		    				</form>
						</div>
					<?php  echo muestraErrores($errors);?>
					<p></p>
					<br><br><br><br><br><br><br>
				</div>
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
