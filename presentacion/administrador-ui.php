<?php
//iniciamos sesión
if(isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    session_start();
    $_SESSION['usuario']['usuario'] = $usuario;
    $_SESSION['usuario']['password'] = $password;
    $_SESSION['usuario']['hora'] = time();//current timestamp
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>administrador-ui</title>
    </head>
    <body>
        <h1>Aquí gestiona el administrador</h1>
        <form class="" action="cerrar-sesion.php" method="post">
            <input type="submit" name="cerrar" value="Cerrar Sesión">
        </form>
    </body>
</html>
