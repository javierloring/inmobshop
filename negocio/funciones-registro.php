<?php
//comprobamos que las variables introducidas en el formulario no son nulas
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
function generateToken() {
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
