<?php
	require 'funcs/conexion.php';
	require 'funcs/funcs.php';
	//declaramos la variable errors para almacenar los errores
	$errors = array();
	//validamos el post
	if(!empty ($_POST))
	{
		//recibimos el campo
		global $mysqli;
		$email = $mysqli->real_escape_string($_POST['email']);
		//si el correo no es valido
		if(!isEmail($email)) {
			//mandamos el error
			$errors[] = 'Debe introducir un correo electrónico válido.';

		}else {
			//validamos si existe el correo electrónico
			if(emailExiste($email)){
				//obtenemos los datos del usuario
				$user_id = getValor('id', 'correo', $email);
				$nombre = getValor('nombre', 'correo', $email);
				//enviamos un token al correo electrónico
				//creamos el token
				$token = generaTokenPass($user_id);
				//lo enviamos por mailer
				$url = 'http://'.$_SERVER["SERVER_NAME"].
				'/login/cambia_pass.php?id='.$user_id.'&token='.$token;
				//agregamos el asunto y el cuerpo para el correo electrónico
				$asunto = 'Activar Cuenta - Sistema de Usuarios';
				$cuerpo = "Estimado $nombre: <br /><br />Para restaurar la contraseña,
				 es indispensable que haga click en el
				siguiente enlace <a href='$url'>Restaurar contraseña</a>";
				//comprobamos si se envió correctamente
				if(enviarEmail($email, $nombre, $asunto, $cuerpo)) {
					//mostramos un mensaje avisando que hemos enviado un mail
					//para que pueda activar su Cuenta
					echo "Para terminar el proceso de recuperación siga las
					instrucciones que le hemos enviado a la dirección de
					correo electrónico: $email";
					//y un enlace para el inicio de sesión
					echo "<br /><a href='index.php'>Iniciar Sesion</a>";
					//hacemos un exit para que no nos vuelva a mostrar el
					//formulario
					exit;
				}else {
					$errors[] = 'Error al enviar email.';
				}

			}else {
				$errors[] = 'Debe introducir un correo electrónico válido.';
			}
		}
	}
 ?>
<html>
	<head>
		<title>Recuperar Password</title>

		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>

	</head>

	<body>

		<div class="container">
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>

					<div style="padding-top:30px" class="panel-body" >

						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="email" required>
							</div>

							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Enviar</a>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12 control">
									<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
										No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
									</div>
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
