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
#var_dump($pass_admin,
        // $pass_gestor1,
        // $pass_gestor2,
        // $pass_usu1,
        // $pass_usu2,
        // $pass_usu3,
        // $pass_usu4,
        // $pass_usu5,
        // $pass_usu6,
        // $pass_usu7,
        // $pass_usu8,
        // $pass_usu9,
        // $pass_usu10
        // );
//cada vez que se ejecuta password_hash, el token es diferente pero siempre verificable
$pass_usu1_origin = '$2y$10$AV799ZMj8ACGPh3./8IX8un6GBlNAtRgiqeqk/t.jW4kb.wV37xhO';
if (password_verify('pass-usu1', $pass_usu1_origin)){
        var_dump('El hash cambia, pero la password pemanece!');
}
$token_usu1 = md5(uniqid(mt_rand(), false));
$token_usu2 = md5(uniqid(mt_rand(), false));
$token_usu3 = md5(uniqid(mt_rand(), false));
$token_usu4 = md5(uniqid(mt_rand(), false));
$token_usu5 = md5(uniqid(mt_rand(), false));
$token_usu6 = md5(uniqid(mt_rand(), false));
$token_usu7 = md5(uniqid(mt_rand(), false));
$token_usu8 = md5(uniqid(mt_rand(), false));
$token_usu9 = md5(uniqid(mt_rand(), false));
$token_usu10 = md5(uniqid(mt_rand(), false));
var_dump($token_usu1,
        $token_usu2,
        $token_usu3,
        $token_usu4,
        $token_usu5,
        $token_usu6,
        $token_usu7,
        $token_usu8,
        $token_usu9,
        $token_usu10
        );
?>
