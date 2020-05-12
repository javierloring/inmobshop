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
require '../negocio/funciones-registro.php';

//nuestra posición
#echo $_SERVER['PHP_SELF'];
$url = $_SERVER['PHP_SELF'];
//nuestro nombre y ubicación
$breadcrumb = ['nombre' => 'Home', 'url' => '/inmobshop/index.php'];
#var_dump($url, $nombre);
//declaramos la variable errors para almacenar los errores
$errors = array();
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
	$tipo_usuario = $_POST['tipo_usuario'];
	//creamos las variables para el resto de campos necesarios para registrar al usuario
	$activado = false;
	$telefono = 0;
	$dni = '';
	$nif = '';
	//no se admiten los siguientes valores nulos
	if(isNull($usuario, $email, $password, $password_repeat, $tipo_usuario)) {
		$errors[] = 'No puede habeer ningún valor nulo ni usar caracteres especiales.';
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
		$token = generateToken();
		//registramos al usuario
		if($registro = Usuario::registraUsuario($usuario, $password_hash, $email, $activado, $telefono, $token)){
			$usuario = $registro['insert'];
			$id_usuario = $registro['id'];
			var_dump($usuario, $id_usuario, $_POST);
			if(!empty($_POST['dni'])){
				$dni = $_POST['dni'];
				//validamos el dni y registramos al usuario particular
				if(validaNif($dni)){
					if($particular = Particular::registraParticular($dni, $id_usuario)){
						var_dump($particular);
					}else {
						$errors[] = 'No se ha registrado el particular.';
					}
				}
			}else if(!empty($_POST['nif'])) {
				$nif = $_POST['nif'];
				//validamos el dni y registramos al usuario particular
				if(validaNif($nif)){
					if($profesional = Profesional::registraProfesional($nif, $id_usuario)){
						var_dump($profesional);
					}else {
						$errors[] = 'No se ha registrado el profesional.';
					}
				}
			}else{
				var_dump('pasa', $id_usuario);
				if($demandante = Demandante::registraDemandante($id_usuario)){
					var_dump($demandante);
				}else {
					$errors[] = 'No se ha registrado el demandante.';
				}
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
        <title>Anuncio-inmobshop</title>
		<link rel="icon" href="<?= FAVICON ?>" sizes="32x32" type="image/png">
        <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
        <!-- <script src="https://www.w3schools.com/lib/w3.js"></script> -->
        <link rel="stylesheet" href="..\css\w3.css">
        <link rel="stylesheet" href="..\css\inmobshop.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<script src="..\js\jquery-3.4.0.js" charset="utf-8"></script>
		<script src="..\js\index.js" charset="utf-8"></script>
		<script src="..\js\registro.js"></script>
        <script src="..\js\w3.js"></script>

    </head>
    <body>
	<header class="w3-container w3-inmobshop"
	style="position: sticky; position: -webkit-sticky; top: 0;z-index: 1;">
            <div class = "w3-row w3-container w3-inmobshop">
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 80px;">
                    <a  href="#">
                        <img class = "w3-button w3-hover-inmobshop"
                             style = "height: 100%; padding-bottom: 10px;"
                               src = "<?= LOGO_INMOBSHOP ?>"/>
                    </a>
                </div>
                <div class="w3-col l2 m3 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large w3-center"
                       style = "text-decoration: none;"
                        href = "<?= BUSCAR_OFERTAS ?>">
                        <p style="padding-top: 20px;">
                            Buscar ofertas
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m3 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large  w3-center"
                       style = "text-decoration: none;"
                        href = "<?= CREA_TU_ANUNCIO ?>">
                        <p style="padding-top: 20px;">
                            Crea tu anuncio
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m3 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large  w3-center"
                       style = "text-decoration: none;"
                        href = "<?= REGISTRATE ?>">
                        <p style="padding-top: 20px;">
                            Regístrate
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m3 s12 w3-inmobshop" style="height: 80px;">
                    <a class = "w3-hover-none w3-text-amber w3-hover-text-white w3-large w3-center"
                       style = "text-decoration: none;"
                        href = "<?= INICIA_SESION ?>">
                        <p style="padding-top: 20px;">
                            Inicia sesión
                        </p>
                    </a>
                </div>
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 80px;">
                    <p></p>
                </div>
            </div>
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
                  		<li>regístrate</li>
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
							<b>Formulario de registro</b>
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
											placeholder = "Repite la contraseña"
											title="escriba de nuevo la contraseña"
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
											title="introduzca su número de teléfono"
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
		   							    <option value="preofesional">Soy profesional inmobiliario</option>
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
									<a href="terminos-condiciones.txt">Acepto sus Términos y condiciones</a>
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
		<footer class="w3-container w3-inmobshop">
            <div class = " w3-row  w3-panel w3-inmobshop">
                <div class="w3-col l2 m12 s12 w3-inmobshop" style="height: 50px;">
                    <p class="w3-text-amber w3-small">Javier Loring Moreno</p>
                    <p class="w3-text-amber w3-small"><i>jloringm@gmail.com</i></p>
                </div>
                <div class="w3-col l8 m12 s12 w3-inmobshop" style="height: 50px;">
                    <p class = "w3-text-amber w3-small"
                       style = "text-align: center;padding-top: 20px;">
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
			//registramos el evento para añadir campos para tipo de usuarios
			$('#tipo_usuario').on('change', anyadir_campo);
		</script>
	</body>
</html>