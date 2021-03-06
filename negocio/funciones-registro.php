<?php
//comprobamos que las variables introducidas en el formulario de registro no son nulas
function isNull($usuario, $email, $password, $password_repeat, $tipo_usuario){
	if(strlen(trim($usuario)) < 1 || strlen(trim($email)) < 1 ||
	 	strlen(trim($password)) < 1 || strlen(trim($password_repeat)) < 1 ||
		 strlen(trim($tipo_usuario)) < 1)
	{
		return true;
		} else {
		return false;
	}
}

//comprobamos que las contraseñas son iguales
function validaPassword($var1, $var2) {
	if (strcmp($var1, $var2) !== 0){
		return false;
		} else {
		return true;
	}
}

//ciframos la contraseña
function hashPassword($password) {
	$hash = password_hash($password, PASSWORD_DEFAULT);
	return $hash;
}

//generamos un token aleatorio para enviar al usuario cuando se registre
function generaToken() {
	$gen = md5(uniqid(mt_rand(), false));
	return $gen;
}

//validamos el nif, dni o dnie
function validaNif ($nif) {
  $nif = strtoupper($nif);
  if (preg_match('~(^[XYZ\d]\d{7})([TRWAGMYFPDXBNJZSQVHLCKE]$)~', $nif, $parts)) {
    $control = 'TRWAGMYFPDXBNJZSQVHLCKE';
    $nie = array('X', 'Y', 'Z');
    $parts[1] = str_replace(array_values($nie), array_keys($nie), $parts[1]);
    $cheksum = substr($control, $parts[1] % 23, 1);
    return ($parts[2] == $cheksum);
  } elseif (preg_match('~(^[ABCDEFGHIJKLMUV])(\d{7})(\d$)~', $nif, $parts)) {
    $checksum = 0;
    foreach (str_split($parts[2]) as $pos => $val) {
      $checksum += array_sum(str_split($val * (2 - ($pos % 2))));
    }
    $checksum = ((10 - ($checksum % 10)) % 10);
    return ($parts[3] == $checksum);
  } elseif (preg_match('~(^[KLMNPQRSW])(\d{7})([JABCDEFGHI]$)~', $nif, $parts)) {
    $control = 'JABCDEFGHI';
    $checksum = 0;
    foreach (str_split($parts[2]) as $pos => $val) {
      $checksum += array_sum(str_split($val * (2 - ($pos % 2))));
    }
    $checksum = substr($control, ((10 - ($checksum % 10)) % 10), 1);
    return ($parts[3] == $checksum);
  }
  return false;
}

//Enviamos el email
//usamos la libreria PHPMailer
function enviarEmail($email, $nombre, $asunto, $cuerpo){
	//importamos la libreria
	//creo que la importa el vendor autoload voy a probar--------------
	// require_once 'PHPMailer/PHPMailerAutoload.php';-----------------

	//aquí debemos agregar nuestros datos
	//ver ayuda emergente
	$mail = new PHPMailer();
	//enviamos el mensaje usando SMTP
	$mail->isSMTP();
	//si usamos autenticación SMTP
	$mail->SMTPAuth = true;
	//tipo de encriptacion en la conexión SMTP '', 'ssl' o 'tls'
	$mail->SMTPSecure = 'tls';
	//cadena con el SMPT hosts.('localhost') - ahora usamos el smtp de gmail
	$mail->Host = 'smtp.gmail.com';
	//number con el puerto por defecto del servidor SMTP. (25)
	$mail->Port = '587';
	//nombre de usuario SMTP
	$mail->Username = 'inmobshop@gmail.com';
	//contraseña SMTP
	$mail->Password = 'Karayjim0GMAIL';
	//asignamos los valores de dirección y nombre del remitente
	$mail->setFrom('inmobshop@gmail.com', 'Inmobshop');
	//añadimos una dirección y un [nombre (opcional)] del destinatario
	$mail->addAddress($email, $nombre);
	//asignamos los valores de asunto y cuerpo del mensaje
	$mail->Subject = $asunto;
	$mail->Body    = $cuerpo;
	//asigna al mensaje el tipo HTML plano
	$mail->IsHTML(true);
	//se comprueba si el envío fue correcto o no
	if($mail->send())
	return true;
	else
	return false;
}

/**
 * comprueba el si el usuario con id y token pasado está activado y devuelve un
 * mensaje indicando la situación del usuario
 * @param  int    $id_usuario el id del usuario
 * @param  string $token      el token de comprobación de email
 * @return string $msg        el mensaje indicativo
 */
function validaIdToken($id_usuario, $token){
	if($registro = Usuario::obtenActivado($id_usuario, $token)){
		$activado = $registro['activado'];
		if($activado == 1){
			$msg = "La cuenta ya se activo anteriormente.";
		} else {
			if(Usuario::activaUsuario($id_usuario) == 1){
				$msg = 'Cuenta activada.';
			} else {
				$msg = 'Error al Activar Cuenta';
			}
		}
	} else {
		$msg = 'No existe el registro para activar.';
	}
	return $msg;
}

//verificamos que el id de usuario y el token_password sean de un registro
//válido y que el usuario haya solicitado su password
function verificaTokenPassword($id_usuario, $token_password){
	if($solicitado = Usuario::obtenPasswordRequest($id_usuario, $token_password)){
		if($solicitado == 1){
			return true;
		}else {
			return false;
		}
	}
}

//comprobamos que las variables introducidas en el formulario de login no son nulas
function isNullLogin($usuario, $password){
	if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
		return true;
	} else {
		return false;
	}
}
