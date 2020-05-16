<?php
session_start();
//requires
//--------------
//comprobamos que el aceso se ha realizado mediante inicio de sesión
//si no, volvemos al index.php
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../index.php');
}
//tomamos los parametros del usuario guardados en la session
$id_usuario = $_SESSION['id_usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];
//obtenemos el usuario de la base de datos
$usuario_row = Usuario::obtenUsuarioId($id_usuario);
$usuario = $usuario_row['usuario'];
//funcion utf8_decode(string), corrige las salidas erróneas
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>administrador-inmobshop</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>
        <h1>Aquí gestiona el administrador</h1>
        <form class="" action="..\negocio\cerrar-sesion.php" method="post">
            <input type="submit" name="cerrar" value="Cerrar Sesión">
        </form>
    </body>
</html>
