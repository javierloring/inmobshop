<?php
//encriptado de contrseñas de gestores y usuarios usadas como carga de datos
//inicial
$user_admin = 'admin-inmobshop';
$pass_admin = password_hash('pass-inmobshop', PASSWORD_DEFAULT);
$pass_gestor1 = password_hash('pass-gestor1', PASSWORD_DEFAULT);
$pass_gestor2 = password_hash('pass-gestor2', PASSWORD_DEFAULT);
$pass_usu1 = password_hash('pass-usu1', PASSWORD_DEFAULT);
$pass_usu2 = password_hash('pass-usu2', PASSWORD_DEFAULT);
$pass_usu3 = password_hash('pass-usu3', PASSWORD_DEFAULT);
$pass_usu4 = password_hash('pass-usu4', PASSWORD_DEFAULT);
$pass_usu5 = password_hash('pass-usu5', PASSWORD_DEFAULT);
$pass_usu6 = password_hash('pass-usu6', PASSWORD_DEFAULT);
$pass_usu7= password_hash('pass-usu7', PASSWORD_DEFAULT);
$pass_usu8 = password_hash('pass-usu8', PASSWORD_DEFAULT);
$pass_usu9 = password_hash('pass-usu9', PASSWORD_DEFAULT);
$pass_usu10 = password_hash('pass-usu10', PASSWORD_DEFAULT);
var_dump($pass_admin,
        $pass_gestor1,
        $pass_gestor2,
        $pass_usu1,
        $pass_usu2,
        $pass_usu3,
        $pass_usu4,
        $pass_usu5,
        $pass_usu6,
        $pass_usu7,
        $pass_usu8,
        $pass_usu9,
        $pass_usu10
        );
?>
