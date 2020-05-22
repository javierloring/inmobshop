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
require_once '../datos/Gestor.php';
//la capa de negocio
require_once '../negocio/funciones-inmobshop.php';
require_once '../negocio/funciones-registro.php';

$nombre_pag = 'inicia sesión';
//borrado de cookies
setcookie('id_usuario', '', time() - 3600);
setcookie('marca', '', time() - 3600);

//definimos una variable para guardar los errores
$errors = [];
//definimos una variable para guardar los éxitos
$exitos = [];
//definimos una variable para guardar el área de gestión del usuario
$tipo_usuario = '';
$area_gestion = '';
var_dump($_POST, $_COOKIE);
#die();

//lo primero que haremos será comprobar si el usuario tiene las cookies de
//reconocimiento, en cuyo caso le daremos acceso directamente al área de gestión
if(isset($_COOKIE['id_usuario']) && isset($_COOKIE['marca'])) {
    if($_COOKIE['id_usuario']!="" && $_COOKIE['marca']!=""){
        //comprobamos que existe el usuario y que posee la misma marca
        $id_usuario = $_COOKIE['id_usuario'];
		$usuario_row = Usuario::obtenUsuarioId($id_usuario);
		$cookie = $usuario_row['cookie'];
		$usuario = $usuario_row['usuario'];
        if($cookie == $_COOKIE['marca']){
			//comprobamos el tipo de usuario
			if(Demandante::esDemandante($id_usuario)){
                $area_gestion = '..\presentacion\ag-demandante-b&f.php';
            }else if(Particular::esParticular($id_usuario)){
                $area_gestion = '..\presentacion\ag-particular-contratos.php';
            }else if(Profesional::esProfesional($id_usuario)) {
                $area_gestion = '..\presentacion\ag-profesional-contratos.php';
            }
		//vamos a crear una nueva sesion para el usuario
		//asignamos este momento como la última sesión del usuario
		$last_session = Usuario::asignaLastSession($id_usuario);
		//creamos sesiones para el usuario
		$_SESSION['id'] = $id_usuario;
		//mostramos un mensaje de éxito
		$exitos[] = 'El usuario se ha identificado correctamente!';
		//abrimos el área de gestión adecuada
	    header('Location: '. $area_gestion .'?nombre='.$usuario );
        }
	}
}
//comprobamos el envío de campos del formulario y los guardamos en variables
if(isset($_POST['usuario']) && isset($_POST['password'])){
    $user = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    //comprobamos que los valores no estan vacíos
    if(isNullLogin($user, $password)){
        $errors[] = 'No puede habeer ningún valor nulo ni usar caracteres especiales.';
    }
    //comprobamos si el usuario es el administrador general
    if(!Usuario::obtenUsuario($user) && !Gestor::obtenGestor($user)) {
        if($user == 'user-inmobshop' && $password == 'pass-inmobshop'){
            $area_gestion = '..\presentacion\ag-administrador.php';
        }else {
            $errors[] = 'El usuario introducido no existe o es incorrecto.';
        }
    //comprobamos si el usuario es un gestor de la aplicación
    }else if ($usuario = Gestor::obtenGestor($user)) {
        //obtenemos contraseña almacenada y la comparamos con la pasada en el Login
        $pass = $usuario['password'];
        if(!password_verify($password, $pass)){
            $errors[] = 'La contraseña pasada no es correcta';
        }else {
            $area_gestion = '..\presentacion\ag-gestor-informes.php';
        }
    }else if($usuario_row = Usuario::obtenUsuario($user)) {
        //obtenemos el id del usuario y comprobamos que tipo de usuario es para Iniciar
        //sesión en su área de gestión
        $id_usuario = $usuario_row['id_usuario'];
		var_dump($id_usuario);
        //la contraseña guardada
        $pass = $usuario_row['password'];
        //si está activado comprobamos que tipo de usuario else {
        if($usuario_row['activado'] == 0){
            $errors[] = 'El usuario no esta activado.';
        }else if($usuario_row['activado'] == 1){
                //comprobamos que tipo de usuario es
            if(Demandante::esDemandante($id_usuario)){
                if(!password_verify($password, $pass)){
                    $errors[] = 'La contraseña pasada no es correcta';
                }else {
                    $tipo_usuario = 'demandante';
                    $area_gestion = '..\presentacion\ag-demandante-b&f.php';
                }
            }else if(Particular::esParticular($id_usuario)){
                if(!password_verify($password, $pass)){
                    $errors[] = 'La contraseña pasada no es correcta';
                }else {
                    $tipo_usuario = 'particular';
                    $area_gestion = '..\presentacion\ag-particular-contratos.php';
                }
            }else if(Profesional::esProfesional($id_usuario)) {
                if(!password_verify($password, $pass)){
                    $errors[] = 'La contraseña pasada no es correcta';
                }else {
                    $tipo_usuario = 'profesional';
                    $area_gestion = '..\presentacion\ag-profesional-contratos.php';
                }
            }
            //vamos a crear una nueva sesion para el usuario
            //asignamos este momento como la última sesión del usuario
            $last_session = Usuario::asignaLastSession($id_usuario);
            //abrimos sesión y creamos sesiones para el usuario
            session_start();
            $_SESSION['id'] = $id_usuario;
            $_SESSION['tipo_usuario'] = $tipo_usuario;
        }
    }
	//gestionamos el recuerdo de la contraseña
	if(isset($_POST['recuerdame'])){
		$cookie = generaToken();
		//obtenemos el registro del usuario
		$usuario_row = Usuario::obtenUsuario($user);
		$id_usuario = $usuario_row['id_usuario'];
		//actualizamos la cookie en la base de datos
		if(Usuario::asignaCookie($id_usuario, $cookie) == 1){
			//guardamos las cookies (1 año)en el navegador del usuario
			setcookie("id_usuario", $id_usuario, time()+(60*60*24*365));
			setcookie("marca", $cookie, time()+(60*60*24*365));
			$exitos[] = 'Los datos de inicio han sido recordados!';
		}else {
			$errors[] = 'No se han podido recordar los datos.';
		}
	}
	var_dump($id_usuario, $_SESSION);
	#die();
    //abrimos el área de gestión adecuada
    header('Location: '. $area_gestion . '?id=' . $id_usuario );
}

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
        <script src="..\js\w3.js"></script>
		<script src="..\js\inmobshop.js" charset="utf-8"></script>
		<script src="..\js\inicio-sesion.js"></script>
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
							$html .= '<li><a class="w3-hover-text-blue" href="/inmobshop/index.php">Home</a></li>';
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
				<div id="form_6" class ="w3-col l4 m12 s12 w3-container w3-center">
				    <form class = "w3-container w3-card-4  w3-center"
						 action = "<?= $_SERVER['PHP_SELF']?>"
						 onsubmit = "return validaFormulario();"
						 method="post">
				        <h2 class="w3-text-inmobshop" style="margin-bottom: 40px;">
							<b>Inicia Sesión</b>
						</h2>
				        <p></p>
						<h4 class="w3-text-inmobshop w3-hover-text-amber w3-border" style="margin-bottom: 40px;text-align: left;">
							<a href="/inmobshop/presentacion/recuperar-password.php" style = "text-decoration: none;">
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
								name="recuerdame"
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
					<?php  echo muestraExitos($exitos);?>
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
