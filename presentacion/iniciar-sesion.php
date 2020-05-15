<?php
//utilizamos recursos de la aplicación
require '../vendor/autoload.php';
//la configuración general
require '../config.php';
//los capa de datos

//la capa de negocio
require '../negocio/funciones-registro.php';


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
	                  		<li>inicia sesión</li>
	                    </ul>
	                </div>
	                <div class="w3-col l2 m12 s12">
	                    <p></p>
	                </div>
	            </div>
				<div class="w3-row w3-container" style="margin-top: 3%">
	                <div class="w3-col l4 m12 s12">
	                    <p></p>
	                </div>
				<div id="from_5" class ="w3-col l4 m12 s12 w3-container w3-center">
				    <form class = "w3-container w3-card-4  w3-center"
						 action = "<?= $_SERVER['PHP_SELF']?>"
						 onsubmit = "return validaFormulario();"
						 method="post">
				        <h2 class="w3-text-inmobshop" style="margin-bottom: 40px;">
							<b>Inicia Sesión</b>
						</h2>
				        <p></p>
						<h4 class="w3-text-inmobshop w3-hover-text-amber w3-border" style="margin-bottom: 40px;text-align: left;">
							<a href="/inmobshop/negocio/recuperar-password.php" style = "text-decoration: none;">
								<b>¿No recuerdas tu contraseña?</b>
							</a>
						</h4>
						<p>
				           <div class="w3-row w3-container" style="">
								<div class="w3-col l2 m6 s6 w3-center">
									<span><i class="material-icons inmobshop"
										style = "font-size: 35px;">person</i></span>
								</div>
								<div class="w3-col l10 m6 s6">
									<input class="w3-input w3-border"
											name="usuario"
											maxlength="45"
											placeholder = "Nombre de usuario"
											title="escriba un nombre para su usuario"
											required
											type="text">
								</div>
				           </div>
				        </p>
						<p>
				           <div class="w3-row w3-container" style="">
								<div class="w3-col l2 m6 s6 w3-center">
									<span><i class="material-icons inmobshop"
										style = "font-size: 35px;">lock</i></span>
								</div>
								<div class="w3-col l10 m6 s6">
									<input class="w3-input w3-border"
											name="password"
											maxlength="60"
											placeholder = "Contraseña"
											title ="escriba una contraseña de menos de 61 caracteres"
											required
											type="password">
								</div>
				           </div>
				        </p>
						<p>
							<div class="w3-row w3-container" style="margin-bottom: 40px;">
								<input class="w3-check w3-col l2 m6 s6 w3-center w3-border"
								style="margin-top: 10px;" 
								type="checkbox">
								<div class="w3-col l10 m6 s6">
									<h4 class="w3-text-inmobshop w3-border" style="margin-bottom: 40px;text-align: left;">
										Recuérdame
									</h4>
								</div>
							</div>
						</p>
				        <p>
							<div class="w3-row w3-container" style="height: 80px">
								<div class="w3-col l12 m12 s12 w3-center">
									<input class="w3-input w3-padding w3-large w3-inmobshop"
											name="enviar"
											value = "Inicia Sesión"
											type="submit">
								</div>
							</div>
				        </p>
						<p></p>
						<hr class="w3-inmobshop" />
						<h4 class="w3-text-inmobshop w3-hover-text-amber w3-border" style="margin-bottom: 40px;text-align: left;">
							<b>
								Si aún no tienes una cuenta...
								<a href="/inmobshop/presentacion/registro.php" style = "text-decoration: none;">Regístrate!</a>
							</b>
						</h4>
						<input id="honeypot" type="text" value="" hidden/>
				    </form>
					<?php  echo muestraErrores($errors);?>
					<p></p>
					<br><br><br><br><br><br><br>
				</div>
				<div class="w3-col l4 m12 s12">
					<p></p>
				</div>
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
