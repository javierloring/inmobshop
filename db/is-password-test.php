<?php
//encriptado de contrseñas de gestores y usuarios usadas como carga de datos
//inicial
$user_admin = 'user-inmobshop';
$pass_admin = 'pass-inmobshop
';
$passgestor1 = password_hash('passgestor1', PASSWORD_DEFAULT);
$passgestor2 = password_hash('passgestor2', PASSWORD_DEFAULT);
$passusu1 = password_hash('passusu1', PASSWORD_DEFAULT);
$passusu2 = password_hash('passusu2', PASSWORD_DEFAULT);
$passusu3 = password_hash('passusu3', PASSWORD_DEFAULT);
$passusu4 = password_hash('passusu4', PASSWORD_DEFAULT);
$passusu5 = password_hash('passusu5', PASSWORD_DEFAULT);
$passusu6 = password_hash('passusu6', PASSWORD_DEFAULT);
var_dump($passgestor1, $passgestor2, $passusu1, $passusu2, $passusu3, $passusu4, $passusu5, $passusu6);
?>
