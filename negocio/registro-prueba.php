<?php
	//importamos la conexión a la BD y las funciones de la aplicación
	require 'funcs/conexion.php';
	require	'funcs/funcs.php';
	//declaramos la variable errors para almacenar los errores
	$errors = array();

	// si recibimos datos por POST, recogemos los valores del formulario
	if (!empty($_POST))
	{
		global $mysqli;
		$nombre = $mysqli->real_escape_string($_POST['nombre']);
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$con_password = $mysqli->real_escape_string($_POST['con_password']);
		$email = $mysqli->real_escape_string($_POST['email']);

		// capturamos la respuesta que se genera al pulsar el captcha
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
			#var_dump($captcha);											//VD
		//definimos algunas variables necesarias
		//el usuario está desactivado por defecto
		$activo = 0;
		//no vamos a dar de alta a administradores sólo usuario
		//sólo privilegios de usuario
		$tipo_usuario = 2;
		//guardamos la clave secreta para el captcha
		$secret = '6LfAztAUAAAAAOMC9ho4XUfG6D5vGM8-eeEEvMyz';

		//validaciones al servidor
		//el $captcha
		if (!$captcha) {
			$errors[] = 'Por favor verifica el captcha';
		}
		 //para validar los campos usamos las funciones de funcs.php
		if (isNull($nombre, $usuario, $password, $con_password, $email))
		{
			$errors[] = 'Debe rellenar todos los campos';
		}
		//correción del Email
		if (!isEmail($email)) {
			$errors[] = 'Dirección de correo invalida';
		}
		//las contraseñas son iguales
		if (!validaPassword($password, $con_password)) {
			$errors[] = 'Las contraseñas no coinciden';
		}
		//validaciones a la base de datos
		//comprobamos que el usuario no existe
		if (usuarioExiste($usuario)) {
			$errors[] = "El nombre de usuario $usuario ya existe";
		}
		//comprobamos que el email no existe
		if (emailExiste($email)) {
			$errors[] = "El email $email ya existe";
		}
		//terminadas las validaciones mostramos los resultados
		//si no tenemos errores  procedemos al Registro
		if (count($errors) == 0) {
			//respuesta de google Captcha-------------------------------------
			$response = file_get_contents(
				"https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			//convertimos la respuesta string json(UTF-8) en variable PHP
			//el parametro assoc de json_decode se configura como TRUE
			//la variable será un array asociativo
			#var_dump($response);											//VD

			$arr = json_decode($response, TRUE);

			if ($arr['success']) {
				//------------------------------------------------------------
				//ahora ciframos la contraseña para guardarla en la BD
				//para ello usamos el método hashPaswword
				$pass_hash = hashPassword($password) ;
				//y generamos un token para que lo devuelva el usuario
				$token = generateToken();
				//registramos al usuario, y nos devuelve el id autogenerado
				$registro = registraUsuario($usuario, $pass_hash, $nombre, $email,
											$activo, $token, $tipo_usuario);

				if ($registro > 0) {
					//si el registro es correcto enviamos un email al correo
					//del usuario, para ello creamos una url que es la que
					//enviamos por correo: va dirigida al servidor, al script
					//activar.php al que enviamos las variables id del registro y
					//el valor del token para que pueda registrarse
					$url = 'http://'.$_SERVER["SERVER_NAME"].
					'/login/activar.php?id='.$registro.'&val='.$token;
					//agregamos el asunto y el cuerpo para el correo electrónico
					$asunto = 'Activar Cuenta - Sistema de Usuarios';
					$cuerpo = "Estimado $nombre: <br /><br />Para continuar el
					proceso de registro, es indispensable que haga click en el
					siguiente enlace <a href='$url'>Activar cuenta</a>";
					//comprobamos si se envió correctamente
					if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {
						//mostramos un mensaje avisando que hemos enviado un mail
						//para que pueda activar su Cuenta
						echo "Para terminar el proceso de registro siga las
						instrucciones que le hemos enviado a la dirección de
						correo electrónico: $email";
						//y un enlace para el inicio de sesión
						echo "<br /><a href='index.php'>Iniciar Sesion</a>";
						//hacemos un exit para que no nos vuelva a mostrar el
						//formulario
						exit;
					}else {
						$errors[] = 'Error al enviar email';
					}
				}else {
					$errors[] = 'Error al registrar';
				}
			}else {
				$errors[] = 'Error al comprobar el Captcha';
			}

		}

	}
?>
<html>
	<head>
		<title>Registro</title>
		<!--hojas de estilo vinculadas-->
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<!--scripts de bootstrap, y reCaptcha-->
		<script src="js/bootstrap.min.js" ></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>

	<body>
		<div class="container">
			<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Reg&iacute;strate</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>

					<div class="panel-body" >

						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>

							<div class="form-group">
								<label for="nombre" class="col-md-3 control-label">Nombre:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
								</div>
							</div>

							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Usuario</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
								</div>
							</div>

							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>

							<div class="form-group">
								<label for="con_password" class="col-md-3 control-label">Confirmar Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>

							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
								</div>
							</div>

							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label"></label>
								<div class="g-recaptcha col-md-9" data-sitekey="6LfAztAUAAAAABNgaXwi8zp7HXXMlV8wvrg4mh3M"></div>
							</div>

							<div class="form-group">
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button>
								</div>
							</div>
						</form>
						<?php
							//implementamos la función resultBlock
							echo resultBlock($errors);
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
