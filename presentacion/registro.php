<?php
//utilizamos recursos de la aplicación
require '../vendor/autoload.php';
//la configuración general
require '../config.php';
//los capa de datos
require_once '../datos/Usuario.php';
require_once '../datos/Particular.php';
require_once '../datos/Profesional.php';
require_once '../datos/Demandante.php';
//la capa de negocio
require '../negocio/funciones-inmobshop.php';
require '../negocio/funciones-registro.php';

//nuestra posición--------------------------------------------------------------
#echo $_SERVER['PHP_SELF'];
$url = $_SERVER['PHP_SELF'];
//nuestro nombre y ubicación
$nombre_pag = 'regístrate';
#var_dump($url, $nombre);
//declaramos la variable errors para almacenar los errores
$errors = array();
//---------------------------------------------------------------------AUTO POST
// si recibimos datos por POST, recogemos los valores del formulario
if (!empty($_POST)) {
	//saneamos y validamos los campos del formulario
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errors[] = 'La dirección de email no es válida.';
	}
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$password_repeat = filter_input(INPUT_POST, 'password_repeat', FILTER_SANITIZE_STRING);
	$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
	$tipo_usuario = $_POST['tipo_usuario'];
	var_dump($usuario, $email, $password, $password_repeat, $tipo_usuario);
	//creamos las variables para el resto de campos necesarios para registrar al usuario
	$activado = false;
	$dni = '';
	$nif = '';
	//no se admiten los siguientes valores nulos
	if(isNull($usuario, $email, $password, $password_repeat, $tipo_usuario)) {
		$errors[] = 'No puede haber ningún valor nulo ni usar caracteres especiales.';
	}
	//las contraseñas deben coincidir
	if(!validaPassword($password, $password_repeat)) {
		$errors[] = 'Las contraseñas no coinciden';
	}
	//comprobamos que el usuario no existe en la base de datos
	if(Usuario::obtenUsuario($usuario)){
		$errors[] = 'Ya existe un usuario con el nombre elegido.';
	}
	//comprobamos que el email pasado no existe en la base de datos
	if(Usuario::obtenEmail($email)) {
		$errors[] = 'El email introducido ya ha sido usado por otro usuario.';
	}
	//si no hay errores procedemos al registro del usuario
	var_dump(count($errors), $errors);
	if(count($errors) == 0){
		//ciframos la contraseña
		$password_hash = hashPassword($password);
		//creamos un token único para comprobar el correo electrónico
		$token = generaToken();
		//registramos al usuario
		if($registro = Usuario::registraUsuario($usuario, $password_hash, $email, $activado, $telefono, $token)){
			//recuperamos el id, el nombre de usuario y el email del usuario creado
			$id_usuario = $registro['id'];
			$nombre = $usuario;

			var_dump($id_usuario, $_POST);
			if(!empty($_POST['dni'])){
				$dni = filter_input(INPUT_POST, 'dni', FILTER_SANITIZE_STRING);
				//validamos el dni y registramos al usuario particular
				if(validaNif($dni)){
					if($particular = Particular::registraParticular($dni, $id_usuario)){
						var_dump($particular);
					}else {
						$errors[] = 'No se ha registrado el particular.';
					}
				}
			}else if(!empty($_POST['nif'])) {
				$nif = filter_input(INPUT_POST, 'nif', FILTER_SANITIZE_STRING);
				//validamos el dni y registramos al usuario profesional
				if(validaNif($nif)){
					if($profesional = Profesional::registraProfesional($nif, $id_usuario)){
						var_dump($profesional);
					}else {
						$errors[] = 'No se ha registrado el profesional.';
					}
				}
			}else if(empty($_POST['dni']) && empty($_POST['nif'])){
				var_dump('pasa', $id_usuario);
				if($demandante = Demandante::registraDemandante($id_usuario)){
					var_dump($demandante);
				}else {
					$errors[] = 'No se ha registrado el demandante.';
				}
			}
			//vamos a enviar el correo electrónico

			//generamos la url que vamos a enviar al usuario donde incluimos su
			//id_usuario y el token
			$url = 'http://' . $_SERVER['SERVER_NAME'] .
			'/inmobshop/negocio/activar-usuario.php?id_usuario='. $id_usuario .
			'&val=' . $token;
			//ahora generamos el asunto, y el cuerpo del mensaje
			$asunto = 'Activar Cuenta - Aplicacion Inmobshop';
			$cuerpo = "Estimado $nombre: <br /><br />Para continuar con el"
			." proceso de registro, es indispensable que pulse en el enlace siguiente"
			." <a href='$url'>Activar Cuenta Inmobshop</a>";
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
		}else{
			$errors[] = 'No se ha registrado el usuario.';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro-inmobshop</title>
		<link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
		<link href='https://fonts.googleapis.com/css?family=Poller One' rel='stylesheet'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="..\js\jquery-3.4.0.js" charset="utf-8"></script>
        <script src="..\js\w3.js" charset="utf-8"></script>
		<script src="..\js\inmobshop.js" charset="utf-8"></script>
		<script src="..\js\registro.js" charset="utf-8"></script>
    </head>
    <body>
		<header class="w3-bar w3-inmobshop"
		style="top: 0;z-index: 1;">
			<a  class="w3-bar-item w3-mobile w3-text-amber w3-myfont w3-center"
			href="/inmobshop/index.php"
				style = "text-decoration: none; width:14%; padding: 0px;">
				<span style="font-size:50px;">IS </span><span style="font-size:22px;">inmobshop</span>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center"
			   style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= BUSCAR_OFERTAS ?>">
				<p class="<?php if($nombre_pag == 'buscar ofertas'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white"
				style="margin-bottom:0px;font-weight: bold;">
					Buscar ofertas
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center"
			   style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= CREA_TU_ANUNCIO ?>">
				<p class="<?php if($nombre_pag == 'crea tu anuncio'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white"
				style="margin-bottom:0px;font-weight: bold;">
					Crea tu anuncio
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center"
			  style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= REGISTRATE ?>">
				<p class="<?php if($nombre_pag == 'regístrate'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white"
				style="margin-bottom:0px;font-weight: bold;">
					Regístrate
				</p>
			</a>
			<a class = "w3-bar-item w3-mobile w3-center"
			 style = "text-decoration: none; width:16.66%; margin-top: 15px;"
				href = "<?= INICIA_SESION ?>">
				<p class="<?php if($nombre_pag == 'inicia sesión'){
									echo 'w3-text-white';
								}else {
									echo 'w3-text-amber';
								}
				?> w3-hover-text-white"
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
						$html .= '<li><a class="w3-hover-text-blue" href="/inmobshop/index.php">Home</a></li>';
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
			<div class="w3-row w3-container" style="margin-top: 3%">
                <div class="w3-col l4 m12 s12">
                    <p></p>
                </div>
				<div id="form_5" class ="w3-col l4 m12 s12 w3-container w3-center">
				    <form class = "w3-container w3-card-4  w3-center"
						 action = "<?= $_SERVER['PHP_SELF']?>"
						 onsubmit = "return validaFormulario();"
						 method="post">
				        <h2 class="w3-text-inmobshop" style="margin-bottom: 40px;">
							<b>Regístrate</b>
						</h2>
				        <p></p>
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
				           <div class="w3-row w3-container" style="">
								<div class="w3-col l2 m6 s6 w3-center">
									<span><i class="material-icons inmobshop"
										style = "font-size: 35px;">lock</i></span>
								</div>
								<div class="w3-col l10 m6 s6">
									<input class="w3-input w3-border"
											name="password_repeat"
											maxlength="60"
											placeholder = "Repita la contraseña"
											title ="repita la contraseña anterior"
											required
											type="password">
								</div>
				           </div>
				        </p>
						<p>
				           <div class="w3-row w3-container" style="">
								<div class="w3-col l2 m6 s6 w3-center">
									<span><i class="material-icons inmobshop"
										style = "font-size: 35px;">call</i></span>
								</div>
								<div class="w3-col l10 m6 s6" style="margin-bottom: 10px;">
									<input class="w3-input w3-border"
											name="telefono"
											maxlength="9"
											pattern="[0-9]{9}"
											placeholder = "Teléfono"
											title="introduzca su número de teléfono con 9 dígitos sin espacios"
											required
											type="tel">
								</div>
				           </div>
				        </p>
						<p>
							<div class="w3-row w3-container" style="margin-bottom: 18%;">
	   							<div class="w3-col l12 m12 s12 w3-center">
		   						  	<select id="tipo_usuario" class="w3-select w3-padding w3-large w3-text-inmobshop"
											 name="tipo_usuario" required>
		   							    <option value="" disabled selected>Tipo de usuario</option>
		   							    <option value="demandante">Quiero buscar ofertas</option>
		   							    <option value="particular">Soy anunciante particular</option>
		   							    <option value="profesional">Soy profesional inmobiliario</option>
		   						  	</select>
								</div>
							</div>
						</p>
						<p>
				           <div id="particular" class="w3-row w3-container oculto" style="">
								<div class="w3-col l2 m6 s6 w3-center">
									<span><i class="material-icons inmobshop"
										style = "font-size: 35px;">person</i></span>
								</div>
								<div class="w3-col l10 m6 s6">
									<input class="w3-input w3-border"
											name="dni"
											maxlength="9"
											placeholder = "DNI del usuario"
											title="introduzca un dni válido, para su usuario"
											type="text">
								</div>
				           </div>
				        </p>
						<p>
				           <div id="profesional" class="w3-row w3-container oculto" style="">
								<div class="w3-col l2 m6 s6 w3-center">
									<span><i class="material-icons inmobshop"
										style = "font-size: 35px;">person</i></span>
								</div>
								<div class="w3-col l10 m6 s6">
									<input class="w3-input w3-border"
											name="nif"
											maxlength="9"
											placeholder = "NIF del profesional"
											title="introduzca un nif válido, para su usuario"
											type="text">
								</div>
				           </div>
				        </p>
						<p>
							<div class="w3-row w3-container" style="margin-bottom: 40px;">
								<input class="w3-check w3-col l2 m6 s6 w3-center" type="checkbox" required>
								<label id="condiciones" class="w3-col l10 m6 s6 w3-text-inmobshop w3-large w3-padding w3-left-align">
									<a href="..\terminos.html">Acepto sus Términos y condiciones</a>
								</label>
							</div>
						</p>
				        <p>
							<div class="w3-row w3-container" style="height: 80px">
								<div class="w3-col l12 m12 s12 w3-center">
									<input class="w3-input w3-padding w3-large w3-inmobshop"
											name="enviar"
											value = "Registrarme"
											type="submit">
								</div>
							</div>
				        </p>
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
		<footer class="w3-bar w3-inmobshop">
			<div class="w3-bar-item w3-mobile" style="width:16.66%;">
				<p class="w3-text-amber w3-small">Javier Loring Moreno</p>
				<p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
			</div>
			<div class="w3-bar-item w3-mobile" style="width:66.66%;">
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
