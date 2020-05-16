<?php
//utilizamos recursos de la aplicación
require_once '../vendor/autoload.php';
//la configuración general
require_once '../config.php';
//los capa de datos
require_once '../datos/Usuario.php';
require_once '../datos/Particular.php';
require_once '../datos/Profesional.php';
require_once '../datos/Demandante.php';
//la capa de negocio
require_once '../negocio/funciones-registro.php';
//definimos una variable para guardar los errores
$errors = [];
#var_dump($_POST);
#die();
//comprobamos el envío de campos del formulario y los guardamos en variables
if(!empty($_POST)){
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errors[] = 'La dirección de email no es válida.';
	}
	//comprobamos que el email pasado existe en la base de datos
	//si existe enviamos un email al usuario
	if(Usuario::obtenEmail($email)) {
		//obtenemos el usuario registrado, creamos un usuario a partir del registro
		//y obtenemos sus campos id y usuario
		$usuario_row = Usuario::obtenEmail($email);
		var_dump($usuario_row);
		$usuario_row = new Usuario($usuario_row);
		$id_usuario = $usuario_row->getIdUsuario();
		$nombre = $usuario_row->getUsuario();
		//creamos un token único para comprobar el correo electrónico
		$token_password = generaToken();
		//actualizamos el registro del usuario
		if(!Usuario::asignaTokenPassword($id_usuario, $token_password)){
			$errors[] = 'No se puede recuperar la contraseña.';
		}else {
			//generamos la url que vamos a enviar al usuario donde incluimos su
			//id_usuario y el token
			$url = 'http://' . $_SERVER['SERVER_NAME'] .
			'/inmobshop/presentacion/cambia-password.php?id_usuario='. $id_usuario .
			'&val=' . $token_password;
			//ahora generamos el asunto, y el cuerpo del mensaje
			$asunto = 'Recuperar Password - Aplicacion Inmobshop';
			$cuerpo = "Estimado $nombre: <br /><br />Para continuar con el"
			." proceso de recuperación de contraseña, es indispensable que pulse"
			." en el enlace siguiente <a href='$url'>Recuperar Contraseña Inmobshop</a>";
			//enviamos el email
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				//mostramos un mensaje para volver al home de la aplicación
				echo "Para terminar el proceso de registro siga las instrucciones
				que le hemos enviado a la dirección de correo electrónico: $email";
				echo "<br /><a href='index.php'>Iniciar sesión</a>";
				//salimos de registro
				exit;
			}else {
				$errors[] = 'El correo no se ha enviado correctamente.';
			}
		}

	}else {
		$errors[] = 'El email introducido no existe.';
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Recupera contraseña-inmobshop</title>
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
							$html .= '<li><a href="/inmobshop/presentacion/iniciar-sesion.php">inicia sesión</a></li>';
								#var_dump($html);
						  	echo $html;
						  	?>
	                  		<li>recupera contraseña</li>
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
				<div id="form_6_1" class ="w3-col l4 m12 s12 w3-container w3-center">
				    <form class = "w3-container w3-card-4  w3-center"
						 action = "<?= $_SERVER['PHP_SELF']?>"
						 onsubmit = "return validaFormulario();"
						 method="post">
				        <h2 class="w3-text-inmobshop" style="margin-bottom: 40px;">
							<b>Recupera Contraseña</b>
						</h2>
				        <p></p>
						<p>
				           <div class="w3-row w3-container" style="">
								<div class="w3-col l2 m6 s6 w3-center">
									<span><i class="material-icons inmobshop"
										style = "font-size: 35px;">mail</i></span>
								</div>
								<div class="w3-col l10 m6 s6">
									<input class="w3-input w3-border"
											name="email"
											maxlength="254"
											placeholder = "Correo electrónico"
											title="escriba su correo electrónico"
											required
											type="email">
								</div>
				           </div>
				        </p>
						<p></p><p></p>
				        <p>
							<div class="w3-row w3-container" style="height: 80px">
								<div class="w3-col l12 m12 s12 w3-center">
									<input class="w3-input w3-padding w3-large w3-inmobshop"
											name="enviar"
											value = "Enviar"
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
				//muestra el enlace para subir al inicio de la página
				$(document).on('scroll', subir);
				//registramos el evento para añadir campos para los tipos de usuarios
				$('#tipo_usuario').on('change', anyadir_campo);
			</script>
		</body>
	</html>
