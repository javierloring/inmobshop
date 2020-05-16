<?php
//utilizamos recursos de la aplicación
require_once '../vendor/autoload.php';
//la configuración general
require_once '../config.php';
//los capa de datos
require_once '../datos/Usuario.php';
//la capa de negocio
require_once '../negocio/funciones-registro.php';

//creamos el array de errores
$errors = [];
//y el de éxitos
$exitos = [];
var_dump($_GET);
//si no recibimos un id de usuario, y un token reenviamos al home
if(empty($_GET['id_usuario']) && !isset($_POST)){
    header('Location: ..\index.php');
}
if(empty($_GET['val']) && !isset($_POST)){
    header('Location: ..\index.php');
}
//recuperamos los datos devueltos por el usuario
if(isset($_GET['id_usuario']) && isset($_GET['val'])){
    $id_usuario = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_STRING);
    $token_password = filter_input(INPUT_GET, 'val', FILTER_SANITIZE_STRING);
    //verificamos que el id de usuario y el token_password sean de un registro
    //válido y que el usuario haya solicitado su password
    $solicitado = verificaTokenPassword($id_usuario, $token_password);

    if($solicitado != 0 && $solicitado != 1){
        echo $solicitado;
        exit;
    }else if ($solicitado == 0) {
        echo 'No se solicitó la contraseña.';
        exit;
    }else if($solicitado == 1){

    }
}
//obtenemos los datos del formulario, comprobamos que son iguales las contraseñas
//y actualizamos la base de datos
var_dump($_POST);
if (!empty($_POST)) {
	//recuperamos los datos de los campos ocultos
	$id_usuario = $_POST['id_usuario'];
	$token_password = $_POST['token_password'];
	//saneamos y validamos los campos del formulario
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$password_repeat = filter_input(INPUT_POST, 'password_repeat', FILTER_SANITIZE_STRING);
	//validamos que sean iguales las contraseñas
	if(!validaPassword($password, $password_repeat)){
		$errors[] = 'Las contraseñas no son iguales.';
	}else {
		//procedemos a actualizar la contraseñarra, limpiar eltoken_password, y
		//poner a cero el password_request
		$password = hashPassword($password);
		if(Usuario::asignaPassword($id_usuario, $token_password, $password) == 1){
			$exitos[] = 'Contraseña correctamente actualizada!';
		}else {
			$errors[] = 'Error a modificar Contraseña';
		}
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
							$html .= '<li><a href="/inmobshop/presentacion/recupera-password.php">recupera contraseña</a></li>';
								#var_dump($html);
						  	echo $html;
						  	?>
	                  		<li>nueva contraseña</li>
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
							<b>Escribe una nueva Contraseña</b>
						</h2>
				        <p></p>
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
							<input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
							<input type="hidden" name="token_password" value="<?=$token_password?>">
						</p><p></p>
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
